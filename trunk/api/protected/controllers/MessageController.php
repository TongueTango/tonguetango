<?php
Yii::import('ext.logger.CPSLiveLogRoute');
class MessageController extends Controller
{
    public function actionCreate() {
        $id     = $this->getInput('id');
        if( $id == 'facebook' ) {
            ini_set('max_execution_time', 0);
            $file   = $this->getInput('file');

            $videoModel = new Video;
            $videoModel->file = $file;
            $videoModel->file = CUploadedFile::getInstance($videoModel,'file');
            $videoModel->savePath = APPPATH . 'cache';
            if( !$videoModel->save() ) {
                throw new Exception("Incorrect video file format", 400);                
            }

            $video  = Converter::convert_to_avi($videoModel->fullPath);
            if( !$video || empty($video) ) {
                throw new Exception('Unable to encode video!', 400);
            }
            
            $public_uri = Yii::app()->s3->upload( $video  , 'uploadedfile', 's3_BucketName' );
            if( !$public_uri || empty($public_uri) ) {
                throw new Exception('Failed to host file!', 400);
            }
            $this->setOutput('public_url', $public_uri);
            unlink($videoModel->fullPath);
        } elseif( $id == 'twitter' ) {
            $file   = $this->getInput('file');
            $public_uri = $this->_save_attachment($file);
            /*
            $name   = $this->_generate_upload_filename($file['name']);
            $path   = Upload::save($file, $name, APPPATH.'cache');
            $public_uri = Model_Cloudfile::upload_file($path);
            */
            if( !$public_uri || empty($public_uri) ) {
                throw new Exception('Failed to host file!', 400);
            }
            $public_url = Yii::app()->bitly->shorten('http://prod.tonguetango.com/message?uri='.$public_uri)->getResponseData();
            $public_url = $public_url['data']['url'];
            $this->setOutput('public_url', $public_uri);
        } else {
            $data       = $this->_request_data;
            $message    = $this->_create_message(array_merge($data,array(
                'user_id'   => self::$user->id,
            )));
            $this->setOutput('message', $message->attributes);
        }
        $this->_sendResponse();
    }

    public function actionUser( $user_id = 0, $since = 0 ) {
        $date       = $since;
        $messages   = $this->_get_user_messages( $user_id, $date );
        $this->setOutput( 'messages', array_values( $messages ) );
        $this->_sendResponse();
    }

    public function actionConversations( $since = 0 ) {
        $date       = $since;
        $threads    = $this->_get_conversations($date);

        $friends = self::$user->get_facebook_friends();
        $friends = self::$user->get_tongue_tango_friends($friends);
        $this->setOutput('pending_friends', $friends['pending_friends']);
        
        $this->setOutput('threads', array_values($threads));
        $this->_sendResponse();
    }

    public function _create_message( $data ) 
    {
        $recipients = $data['recipients'];
        if( count($recipients) < 1 ) {
            throw new Exception('No recipients specified!', 400);
        }
        unset($data['recipients']);
        
        $message    = new Messages;
        $message->attributes = $data;
        $message->validate();
        $message->save();

        // DEBUG Mode
        //if( !$message->save() ) { die(var_dump($message->getErrors())); }
        
        foreach( $recipients as $recipient ) {
            // individual recipient
            if( isset($recipient['user_id']) ) {
                $target = new MessageRecipients;
                $target->attributes = $recipient;
                $target->message_id = $message->id;
                $target->save();

                // DEBUG Mode
                //if( !$target->save() ) { die(var_dump($target->getErrors())); }

                $user = Users::model()->findByPk( $recipient['user_id'] );
                
                $devices = Devices::model()->findAll( array( 'condition' => 'push_token!="" AND push_token IS NOT NULL AND user_id=' . $user->id ) );
                $alert = 'Sweet...A New Tt Message';
                $extra = array(
                            "action"        => 'message',
                            "message_id"    => $message->id,
                            "user_id"       => self::$user->id,
                            "group_id"      => 0
                        );
                //PUSH::send($devices, $alert, $extra);
                
                // Add self as recipient for easier organization
                $target = new MessageRecipients;
                
                $target->attributes = array(
                        'user_id'       => self::$user->id,
                        'message_id'    => $message->id,
                        'read'          => 1,
                );
                
                $target->save();
            }
            // handle push notifications to group_members if necessary
            if( isset($recipient['group_id']) ) {
                // check if the group has been deleted
                $group = Groups::model()->findByPk( $recipient['group_id'] );
                
                if ( $group && $group->delete_date != null) {
                    throw new Exception('You cannot post to a deleted group!', 400);
                }else{
                    $members = GroupMembers::model()->findAll('group_id = :group_id', array(':group_id' => $recipient['group_id']));
                    
                    foreach ( $members as $member ) {
                        $target = new MessageRecipients;
                        $target->attributes = array_merge($recipient,array(
                                'user_id'       => $member->user_id,
                                'message_id'    => $message->id,
                                'read'          => ($member->user_id == self::$user->id ? 1 : 0),
                        ));

                        $target->save();

                        if ( $member->user_id != self::$user->id ) {
                            $user = Users::model()->findByPk( $member->user_id );
                            
                            $devices = Devices::model()->findAll( array( 'condition' => 'push_token!="" AND push_token IS NOT NULL AND user_id=' . $user->id ) );

                            $alert = 'Sweet...A New Tt Message';
                            $extra = array(
                                        "action"        => 'message',
                                        "message_id"    => $message->id,
                                        "user_id"       => 0,
                                        "group_id"      => $recipient['group_id'],
                                    );
                            
                            //PUSH::send($devices, $alert, $extra);
                            
                        }
                    }
                }
            }
        }
        if( array_key_exists('file', $data) && is_array($data['file']) ) {
            // COMING SOON...
            $public_url = $this->_save_attachment($data['file']);
            $public_url = Yii::app()->bitly->shorten($public_url)->getResponseData();
            $public_url = $public_url['data']['url'];
            $message->message_path  = $public_url;
            $message->save();
        }
        return $message;
    }

    /**
     * Retrieve all messages for a given user.
     * @param int $id
     * @param int $date
     * @throws Exception
     * @return array
     */
    protected function _get_user_messages($id, $date)
    {
        $messages   = Messages::get_conversation($id, $date);
        return $messages;
    }

    /**
     * Retrieve all conversations for a given user.
     * @param string $date
     * @throws Exception
     * @return array
     */
    protected function _get_conversations($date = null)
    {
        $threads = Messages::get_conversations($date);
        return $threads;
    }


    // Coming soon
    protected function _save_attachment($upload)
    {
        $file_name  = microtime(true).'-'.$upload['name'].'.mp3';
        $path_name  = APPPATH.'cache/'.$file_name;
        move_uploaded_file($upload['tmp_name'], $path_name);
        $source     = Converter::convert_to_audio_mp3($path_name);
        
        // code for upload to Amazon S3...
        // ----
        // if( Yii::app()->s3->upload( $photo->fullPath  , 'uploadedfile', 's3_BucketName' ) ) {
        //      get URL of uploaded file...
        // }
        // ----

        unlink($path_name);
        unlink($source);
        return $address;
    }

    /**
     * Generate a unique filename for use with
     * saving uploads.
     * @param string|null $name
     * @return string
     */
    protected function _generate_upload_filename($name=null)
    {
        $file_name  = microtime(true);
        if( !is_null($name) ) {
            $file_name  .= '-'.$name;
        }
        return $file_name;
    }
}