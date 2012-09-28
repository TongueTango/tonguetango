<?php

Yii::import('ext.logger.CPSLiveLogRoute');

class MessageController extends Controller
{
    
    public function actionIndex()
    {
        $data = $this->getInputs();
        
        $id = intval($_REQUEST['id']);   
		if( is_null($id) ) {
			$this->_sendResponse(400, array("code"=>0, 'message'=>"Invalid message specified"));
		}
        
		$message = Messages::model()->findByPk($id);
        if(!$message) {
            $this->_sendResponse(400, array("code"=>0, 'message'=>"Invalid message specified"));
        }
        
        if($data['favorite'] == 1) {
            $fav = MessageFavorites::model()->findByAttributes(array('message_id'=>$id,'user_id'=>self::$user->id)); 
            if($fav) {
                $this->_sendResponse(200, array("code"=>0, 'message'=>"This message is already in your favorite list"));
            }
            $fav = new MessageFavorites;
            $fav->message_id = $id;
            $fav->user_id    = self::$user->id;
            $fav->create_date = date("Y:m:d H:i:s");
            $fav->update_date = date("Y:m:d H:i:s");
            if($fav->save()) {
                $this->setOutput('message', 'success');
            } else {
                $this->_sendResponse(200, array("code"=>0, 'message'=>"failure"));
            }
        } elseif($data['favorite'] == 0) {
            $fav = MessageFavorites::model()->findByAttributes(array('message_id'=>$id,'user_id'=>self::$user->id)); 
            if(!$fav) {
                $this->_sendResponse(200, array("code"=>0, 'message'=>"This message is not in your favorite list"));
            }
            if($fav->delete()) {
                $this->setOutput('message', 'success');
            } else {
                $this->_sendResponse(200, array("code"=>0, 'message'=>"failure"));
            }
        }
        
    }
    
    public function actionCreate() 
    {
        if(isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        } else {
            $id = 'regular';
        }
        
        if( $id == 'facebook' ) 
        {   
            ini_set('max_execution_time', 0);
            $file   = $this->getInput('file');
            
            $fileName = md5(microtime(true)).$file['name'];
            $uploadPath = Yii::app()->basePath.'/cache/';
            
            move_uploaded_file($file['tmp_name'], $uploadPath.$fileName);
            $audio  = Converter::convert_to_audio_mp3($uploadPath.$fileName);
            $video  = Converter::convert_to_avi($audio);
            
            if( !$video || empty($video) ) {
                $this->_sendResponse(400, array("code"=>0, 'message'=>"Unable to encode video!"));
            }
            
            $cloudFile = explode('.',$fileName);
            $bucketName = 'tangofiles';
            
            
            if( Yii::app()->s3->upload($video ,$cloudFile[0].".avi", $bucketName ) ) {
                    $public_uri = "http://".$bucketName.".s3.amazonaws.com/".$cloudFile[0].".avi";
            
            } else {
                $this->_sendResponse(400, array("code"=>0, 'message'=>"Failed to host file!"));
            }
          
            $this->setOutput('public_url', $public_uri);
            $this->_sendResponse();
        } elseif( $id == 'twitter' ) {
            
            $file   = $this->getInput('file');
            $fileName = md5(microtime(true)).$file['name'];
            $uploadPath = Yii::app()->basePath.'/cache/';
            
            move_uploaded_file($file['tmp_name'], $uploadPath.$fileName);
            $audio  = Converter::convert_to_audio_mp3($uploadPath.$fileName);
            
            if( !$audio || empty($audio) ) {
                $this->_sendResponse(400, array("code"=>0, 'message'=>"Unable to encode audio!"));
            }
            
            $cloudFile = explode('.',$fileName);
            $bucketName = 'tangofiles';
            
            
            if( Yii::app()->s3->upload($audio ,$cloudFile[0].".mp3", $bucketName ) ) {
                    $public_uri = "http://".$bucketName.".s3.amazonaws.com/".$cloudFile[0].".mp3";
            
            } else {
                $this->_sendResponse(400, array("code"=>0, 'message'=>"Failed to host file!"));
            }
          
            $this->setOutput('public_url', $public_uri);
            $this->_sendResponse();
            
            
        } else {
            $data       = $this->getInputs();
            $message    = $this->_create_message(array_merge($data,array(
                'user_id'   => self::$user->id,
            )));
            $this->setOutput('message', $message->attributes);
        }
    }
    
    public function actionApns(){//for test
        $device = new Devices;
        $device->push_token = "EA0B6D5A2E4C172B5930A6236C532D532D34F64FFC593925F8D28F57E3DA9088";
        $device->device_type = "iOS";
        $alert = 'Sweet...A New Tt Message';
        $extra = array();
        PUSH::send(array($device), $alert, $extra);
    }
    
    public function actionUpdate() {
        
        if(!isset($_REQUEST['type']))$this->_sendResponse(400, array("code"=>0, 'message'=>"type is not specified"));
            
        $type = $_REQUEST['type'];
        $id   = $_REQUEST['id'];
        $connection = Yii::app()->db;
        
        $read =  $this->getInput('read');
        
        
        if($type == 'group') {
            $group = Groups::model()->findByPk($id);
            if(!$group) {
                $this->_sendResponse(400, array("code"=>0, 'message'=>"Invalid group specified"));
            }
            $sql = "update message_recipients SET `read`=".$read." WHERE delete_date IS NULL AND group_id =".$id."";
            
            $result = $connection->createCommand($sql)->execute();
            if($result) 
                $this->setOutput('message', 'success');
            else 
                $this->setOutput('message', 'No unread messages for this group');
            
            
        } elseif($type=='message') {
            
            
        } elseif($type=='friend') {
            $target_id	= $id;
			$status		= $read;
			$result		= Messages::mark_conversation($target_id, $status );
            
            if($result)
                $this->setOutput('message', 'success');
            else
                $this->setOutput('message', 'No messages to mark as read');
        }
        
    }
    
    /**
	 * DELETE
	 * Marks a message as deleted.
	 */
	public function actionDelete()
	{
        if(!isset($_REQUEST['id'])) {
            $this->_sendResponse(400, array("code"=>'0','message'=>"Message id is not specified"));
        }
		$id			= $_REQUEST['id'];
		$message	= Messages::model()->findByPk($id);
		if( !$message) {
            $this->_sendResponse(400, array("code"=>'0','message'=>"Invalid message specified!"));
		}
		$message->delete_date	= date('Y-m-d H:i:s');
		$message->save();
		$this->setOutput('deleted', 1);
	}

    public function actionUser( $user_id = 0, $since = 0 ) {
        
        $date       = $since;
        $messages   = $this->_get_user_messages( $user_id, $date );
        $this->setOutput( 'messages', array_values( $messages ) );
        
    }

    public function actionConversations( $since = 0 ) 
    {    
        $date       = $since;
        $threads    = $this->_get_conversations($date);
        $membership = GroupMembers::model()->with(array('group'=>array('select'=>'group.id,group.name,group.photo',
                                            'condition'=>'group.delete_date IS NULL',
                                        )))->findAllByAttributes( array('user_id' => self::$user->id, 'accepted'=> 0,'removed'=>0) );
        
        $groups = array();
        foreach($membership as$key=> $mem) {
            $groups[$key]['id'] = $mem->group->id; 
            $groups[$key]['name'] = $mem->group->name; 
            $groups[$key]['photo'] = $mem->group->photo; 
            
        }

        $friends = self::$user->get_facebook_friends();
        $friends = self::$user->get_tongue_tango_friends($friends);
        $this->setOutput('pending_friends', $friends['pending_friends']);        
        $this->setOutput('threads', array_values($threads));
        $this->setOutput('group_invitations', array_values($groups));
        $this->_sendResponse();
    }
    
//    public function actionFavorite()
//    {
//        $messages	= array();
////		foreach( self::$user->favoritemessages as $message ) {
////			$messages[$message->id]	= $message->as_array();
////		}
//        
//        var_dump(self::$user->favoritemessages);die;
//        
//		return $messages;
//    }
    
    public function actionGroup($id)
	{
		$group		= Groups::model()->with(array('messages'=>array('condition' => 'messages.delete_date IS NULL')))->findByPk($id);
        
        
		if( !$group) {
            $this->_sendResponse(400, array("code"=>'0','message'=>"Group not defined!"));
		}

		$messages	= array();
		foreach( $group->messages as $message ) {
			$messages[$message->id]	= $message->attributes;
		}
        
		$this->setOutput('messages', array_values($messages));
        
	}

    public function _create_message( $data ) 
    {
        $recipients = $data['recipients'];
        
        if( count($recipients) < 1 ) {
            $this->_sendResponse(400, array("code"=>'0','message'=>'No recipients specified!'));
        }
        unset($data['recipients']);
        
        $message    = new Messages;
        $message->attributes = $data;
        $message->validate();
        $message->save();

        
        foreach( $recipients as $recipient ) {
            // individual recipient
            if( isset($recipient['user_id']) ) {
                $target = new MessageRecipients;
                $target->attributes = $recipient;
                $target->message_id = $message->id;
                $target->save();

                $user = Users::model()->findByPk( $recipient['user_id'] );
                
                $devices = Devices::model()->findAll( array( 'condition' => 'push_token!="" AND push_token IS NOT NULL AND user_id=' . $user->id ) );
                $alert = $message->message_body;
                $extra = array(
                            "action"        => 'message',
                            "message_id"    => $message->id,
                            "user_id"       => self::$user->id,
                            "group_id"      => 0
                        );
                
               
                PUSH::send($devices, $alert, $extra);
                
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
                            if($message->message_header == "Audio Message") {
                                $alert = "You've got a new audio message";
                            } else {
                                $alert = $message->message_body;
                            }
                            
                            $extra = array(
                                        "action"        => 'message',
                                        "message_id"    => $message->id,
                                        "user_id"       => 0,
                                        "group_id"      => $recipient['group_id'],
                                    );
                             
                            PUSH::send($devices, $alert, $extra);
                            
                        }
                    }
                }
            }
        }
        if( array_key_exists('file', $data) && is_array($data['file']) ) {
            
            $public_url = $this->_save_attachment($data['file']);
            //$public_url = Yii::app()->bitly->shorten($public_url)->getResponseData();
            
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
    
    protected function _save_attachment($upload)
    {
        $file   = $upload;
            
        $fileName = md5(microtime(true)).$file['name'];
        $uploadPath = Yii::app()->basePath.'/cache/';

        move_uploaded_file($file['tmp_name'], $uploadPath.$fileName);

        $bucketName = 'tangofiles';
        if( Yii::app()->s3->upload($uploadPath.$fileName  , $fileName, $bucketName ) ) {
                $public_uri = "http://".$bucketName.".s3.amazonaws.com/".$fileName;

        }
        
        return $public_uri;
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