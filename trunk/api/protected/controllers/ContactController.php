<?php
Yii::import('ext.logger.CPSLiveLogRoute');
class ContactController extends Controller
{
    public function actionIndex() {
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

    public function actionSearch() {
        $contacts   = $this->getInput('contacts');
        $result     = $this->_find_contacts($contacts);
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
            
            //PUSH::send($devices, $message, $extra);
            
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
        
        //PUSH::send($devices, $message, $extra);
        
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

        //TODO: actually invite people
        //make sure we have contact info
        //else throw error

        //record and send invite
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
            $this->_sendResponse(200, array("code"=>'0','message'=>"This functionality is not yet implemented."));
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
            if( !is_null( $result['user_id'] ) ) {
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