<?php
Yii::import('ext.logger.CPSLiveLogRoute');
class ContactController extends Controller
{
    public function actionIndex() 
    {
        $friends = self::$user->get_facebook_friends();
        self::$user->save_facebook_friends($friends);
        $friends = self::$user->get_tongue_tango_friends($friends);
        $this->setOutput('fb_friends',      $friends['fb_friends']);
        $this->setOutput('tt_friends',      $friends['tt_friends']);
        $this->setOutput('pending_friends', $friends['pending_friends']);
        $this->_sendResponse();
    }
    


    public function actionCreate() {
        $inputs = $this->getInputs();
        $contact_user = $this->get_contact_user($inputs);

        if( !isset( $contact_user ) ) {
            $this->_sendResponse(200, array("code"=>'0','message'=>'Person not found.'));
        }
        
        if(!$contact_user->id){ //not a TT user
           $this->invite_contact($inputs);
           $this->setOutput("status","invited");
           $this->_sendResponse();
           return;
        }
        
        if(self::$user->id == $contact_user->id){
            $this->_sendResponse(200, array("code"=>'0','message'=>"You, adding you, who's adding you. You can't add yourself sillygoose."));
        }

        $inputs = array_merge( array(
            "user_id"=>self::$user->id,
            "contact_user_id"=>$contact_user->id
        ), $inputs);
        
        $this->already_contacts($inputs);
        
        $contact = Contacts::model()->findByAttributes( array( "user_id" => $contact_user->id, "contact_user_id" => self::$user->id ) );
        
        if(isset($contact->id)){ //if they requested you first
            
            $data = array(
                "user_contact_id"=>self::$user->id,
                "contact_id"=>$contact->id,
                "user_id"=>$contact_user->id,
                "accepted"=>1
            );

            $this->confirm_contact($data); //confirm you for them
            $this->confirm_contact($inputs); //confirm them for you
            $this->setOutput("status","confirmed");
            $this->_sendResponse();
        }
        else { //if they haven't requested you then request them
            $this->request_contact($inputs);
            $this->setOutput("status","requested");
            $this->_sendResponse();
        }
    }

    public function actionBlock( $id = 0 ) {
        if( $id != 0 ) {
            $block = Blocks::model()->find('user_id=:user_id AND blocked_user_id=:blocked_user_id', array( ':user_id' => self::$user->id, ':blocked_user_id' => intval( $id ) ) );

            if( $block && $block->create_date != NULL && $block->blocked == 1 ) {
                $this->_sendResponse(200, array("code"=>'0','message'=>"Already blocked"));
            }

			if ($block && $block->update_date != NULL && $block->blocked == 0) {
				$block->blocked = 1;
				$block->update_date = date('Y-m-d H:i:s');
			} else {
				$block = new Blocks;
				$block->user_id = self::$user->id;
				$block->blocked_user_id = $id;
				$block->blocked = 1;
			}
            if( $block->save() ) {
                $this->setOutput("status", "blocked");
            } else {
                $this->_sendResponse(200, array("code"=>'0','message'=>"Database error, please try it later"));
            }
        } else {
            $block_list = Blocks::model()->findAllByAttributes( array( 'user_id' => self::$user->id, 'blocked' => 1 ) );

            $full_block_list = array();
            foreach ($block_list as$key=> $item) {                
                $full_block_list[$key] = $item->attributes;
                $full_block_list[$key]['username'] = $item->contactUser->username;
            } 

			$block_group_list = GroupBlocks::model()->findAllByAttributes(array('user_id' => self::$user->id, 'blocked' => 1));
			
			$full_group_block_list = array();
			foreach($block_group_list as $key => $item) {
				$full_group_block_list[$key] = $item->attributes;
                $full_group_block_list[$key]['name'] = $item->group->name;
			}
            
			$this->setOutput('block_list', $full_block_list);
            $this->setOutput('block_group_list', $full_group_block_list);
        }
    }

    public function actionUnblock( $id = 0 ) {
        if( $id != 0 ) {
            $block = Blocks::model()->find('user_id=:user_id AND blocked_user_id=:blocked_user_id', array( ':user_id' => self::$user->id, ':blocked_user_id' => intval( $id ) ) );

            if( !$block ) {
                $this->_sendResponse(200, array("code"=>'0','message'=>"This user not blocked for you"));
            }

            if( $block->blocked == 0 ) {
                $this->_sendResponse(200, array("code"=>'0','message'=>"Already unblocked"));
            }

            $block->blocked = 0;
            if( $block->save() ) {
                $this->setOutput("status", "unblocked");
            } else {
                $this->_sendResponse(200, array("code"=>'0','message'=>"Database error, please try it later"));
            }
        }
    }

    public function actionDelete( $id = 0 ) {
        if( $id != 0 ) {
            $friendship = Contacts::model()->find('user_id=:user_id AND contact_user_id=:contact_user_id', array( ':user_id' => self::$user->id, ':contact_user_id' => intval( $id ) ) );

            if( !$friendship ) {
                $this->_sendResponse(200, array("code"=>'0','message'=>"Friendship not found"));
            }

            if( $friendship->delete_date != NULL ) {
                $this->_sendResponse(200, array("code"=>'0','message'=>"Already removed from friends"));
            }

            $friendship->delete_date = date('Y-m-d H:i:s');

            if( $friendship->save() ) {
                $this->setOutput("status", "deleted");
            } else {
                $this->_sendResponse(200, array("code"=>'0','message'=>"Database error, please try it later"));
            }            

        } else {
            //$this->_sendResponse(200, array("code"=>'0','message'=>"Please select a user to delete."));
            $deleted_friendships = Contacts::model()->findAll('user_id=:user_id AND delete_date!="" AND delete_date IS NOT NULL AND accepted=1 ', array( ':user_id' => self::$user->id ) );

            if( !$deleted_friendships ) {
                $this->_sendResponse(200, array("code"=>'0','message'=>"Deleted friends not found"));
            }

            $full_deleted_list = array();
            foreach ($deleted_friendships as$key=> $item) {
                $full_deleted_list[$key] = $item->attributes;
                $full_deleted_list[$key]['username'] = $item->user->username;
            }

            $this->setOutput('deleted_friend_list', $full_deleted_list);
            $this->_sendResponse();
        }
    }

    public function actionUndelete( $id = 0 ) {
        if( $id != 0 ) {
            $contact = Contacts::model()->find('user_id=:user_id AND contact_user_id=:contact_user_id AND delete_date IS NOT NULL', array( ':user_id' => self::$user->id, ':contact_user_id' => intval( $id ) ) );

            if( !$contact ) {
                $this->setOutput("status", "failure");
                $this->_sendResponse();
            }

            $contact->delete_date = null;
            if( $contact->save() ) {
                $this->setOutput("status", "success");
                $this->_sendResponse();
            } else {
                $this->_sendResponse(200, array("code"=>'0','message'=>"Database error, please try it later"));
            }
        } else {
            $this->_sendResponse(200, array("code"=>'0','message'=>"Please set variable ID"));
        }
    }

    public function actionSearch() {
        $contacts   = $this->getInputs();
        $result   = $this->_find_contacts($contacts);
        foreach( $result as $key=>$val ) {
            $this->setOutput($key, $val);
        }

        $this->_sendResponse();
    }

    public function get_contact_user( $data ) {
        if( isset( $data["person_id"] ) ) {
            return Users::model()->findByAttributes( array( "person_id" => $data["person_id"] ) );
        } else if( isset( $data["facebook_id"] ) ) {
            $contact_person = People::model()->findByAttributes( array( "facebook_id" => $data["facebook_id"] ) );
            return Users::model()->findByAttributes( array( "person_id" => $contact_person->id ) );
        } else {
            $this->_sendResponse(200, array("code"=>'0','message'=>"Please select a person to add or invite."));
        }
    }

    public function already_contacts( $data ) {
        $contact = Contacts::model()->findByAttributes( array( "user_id" => $data["user_id"], "contact_user_id" => $data["contact_user_id"] ) );
        if( isset($contact->id) && !is_null($contact->id) ) {
            if( $contact->accepted == 1 ) {
                $this->_sendResponse(200, array("code"=>'0','message'=>'You are already contacts with this person.'));
            } else if( $contact->accepted == 0 ) {
                $this->_sendResponse(200, array("code"=>'0','message'=>"You've already requested to add this person."));
            }
        }
        
        return false;
    }

    public function confirm_contact( $data ){
        if( isset( $data["contact_id"] ) ) {
            $contact = Contacts::model()->findByPk( $data["contact_id"] );
            $contact->accepted = 1;
            $contact->save();

            
            // get the requestee info
            $requestee = Users::model()->findByPk( $contact->contact_user_id )->person;
            
            // send a push notification
            $requestor  = $contact->user;
            
            $devices = Devices::model()->findAll( array( 'condition' => 'push_token!="" AND push_token IS NOT NULL AND user_id=' . $requestor->id ) );
            $message = 'You are now connected with '.$requestee->first_name.' '.$requestee->last_name;
            $extra = array(
                        "action"    => "requestAccepted",
                        "user_id"   => ''.$contact->contact_user_id,
                        "message"   => $requestee->first_name.' '.$requestee->last_name.' accepted your invite!'
                    );
            
            PUSH::send($devices, $message, $extra);
            
            return $contact;
        }

        $contact = new Contacts;
        $contact->attributes = $data;
        $contact->accepted = 1;
        $contact->save();

        return $contact;
    }

    public function request_contact( $data ) {
        $contact = new Contacts;
        $contact->attributes = $data;
        $contact->accepted = 0;
        $contact->save();

        $user   = $contact->contactUser;
        $requestor  = $contact->user->person;
        $the_photo = $requestor->photo; // Bitly::instance()->shorten($requestor->photo); 

        $devices = Devices::model()->findAll( array( 'condition' => 'push_token!="" AND push_token IS NOT NULL AND user_id=' . $user->id ) );
        $message = $requestor->first_name.' '.$requestor->last_name.' has requested to add you on Tongue Tango!';
        $extra = array(
                    "action"    => "request",
                    "user_id"   => ''.$contact->user_id,
                    "message"   => $requestor->first_name.' '.$requestor->last_name.' added you.',
                    "photo"     => $the_photo
                );
        
        PUSH::send($devices, $message, $extra);
        
        return $contact;
    }

    //TODO: make this actually send something
    //need to know what we're doing with FB people
    public function invite_contact( $data ) {

        if( isset( $data["person_id"] ) )
            $person = People::model()->findByPk( $data["person_id"] );
        else if( isset( $data["facebook_id"] ) )
            $person = People::model()->findByPk( array( "facebook_id" => $data["facebook_id"] ) );
        else if( isset( $data["emails"] ) ) {
            //send email
            //create person record
            //create contact request record (?)
        }
        if( !$person->id ) 
            $this->_sendResponse(200, array("code"=>'0','message'=>"That person does not exist."));

        
        return;
        $this->request_contact( $data );
    }

    public function send_invite($data){
        $this->_sendResponse(200, array("code"=>'0','message'=>"This functionality is not yet implemented."));
    }

    /**
     * Search by phone number and email address for
     * existing people and users.
     * @param array $data
     * @throws Exception
     * @return array
     */
    protected function _find_contacts( $data )
    {   
        if( !is_array($data) ) {
            $this->_sendResponse(200, array("code"=>'0','data'=>$data,'message'=>"This functionality is not yet implemented."));
        }

        //Yii::log( "Search known contacts", 'info', 'system.web.CController' );
        $friends    = array();
        $tt_friends = array();
        foreach( $data as $contact ) {
            //Yii::log( "Searching for contact: ".print_r($contact, true), 'info', 'system.web.CController' );
            
            $unique_id      = $contact['unique_id'];
            $emails         = $contact['emails'];
            $phones         = $contact['phones'];
            $result         = array(
                'unique_id' => $unique_id,
                'person_id' => null,
                'user_id'   => null,
            );
            if( count($emails) > 0 ) {
                $email_result   = Users::find_by_emails( $emails );
                if( $email_result ) {
                    //Yii::log( "Email match found!", 'info', 'system.web.CController' );
                    if( isset( $email_result['person_id'] ) ) {
                        $result['person_id']    = intval( $email_result['person_id'] );
                    }
                    if( isset( $email_result['user_id'] ) ) {
                        $result['user_id']      = intval( $email_result['user_id'] );
                    }
                }
            }
            if( count( $phones ) > 0 ) {
                $phone_result   = Users::find_by_phones( $phones );
                if( $phone_result ) {
                    //Yii::log( "Phone match found!", 'info', 'system.web.CController' );
                    if( isset( $phone_result['person_id'] ) ) {
                        $result['person_id']    = intval( $phone_result['person_id'] );
                    }
                    if( isset( $phone_result['user_id'] ) ) {
                        $result['user_id']      = intval( $phone_result['user_id'] );
                    }
                }
            }
            //Yii::log( "Final contact result: ".print_r($result, true), 'info', 'system.web.CController' );
            if( !is_null( $result['user_id'] ) ) 
            {
            	$result["added_as_friend"] = self::$user->checkAndCreateContact($result["user_id"]);                
                $tt_friends[]   = $result;                
            } else {
                $friends[]      = $result;
            }
        }
        return array(
            'friends'       => $friends,
            'tt_friends'    => $tt_friends,
        );
    }
}