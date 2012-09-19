<?php
Yii::import('ext.logger.CPSLiveLogRoute');
class UserController extends Controller
{
    
    public function actionLogin()
    {
        $data = $this->_request_data;
        
        Yii::log("User login", 'info', 'system.web.CController'); 
        
        
		if( array_key_exists('facebook_access_token', $data) && $data['facebook_access_token'] != '' ) {
			$user = Users::model()->find("facebook_access_token='" . $data["facebook_access_token"]."'");
			// we may have a new access_token.  if no match search by facebook UID and update the token
			if (!$user && isset($data['facebook_id'])) {
                
                $command = Yii::app()->db->createCommand()
                        ->select('users.id')
                        ->from('users')
                        ->join('people', 'users.person_id=people.id')
                        ->where('people.facebook_id=:fId', array(':fId'=>$data['facebook_id']));
                
                $userId = $command->queryRow();
                
				if ($userId) {
                    
                    $user = Users::model()->findByPk($userId['id']);
					$user->facebook_access_token = $data["facebook_access_token"];
					$user->save();
				}
                
			}
		// Twitter login
		} elseif( array_key_exists('twitter_auth_token', $data) && $data['twitter_auth_token'] != '' ) {
			$twittah = array();
			
			parse_str($data['twitter_auth_token'], $twittah);
			if (is_array($twittah)) {
				array_pop($twittah);
				$data['twitter_auth_token'] = http_build_query($twittah);
			}
            
			$user = Users::model()->find("twitter_auth_token= '" . $data["twitter_auth_token"] . "'");
            
		} elseif((array_key_exists('username', $data) && !empty($data['username']))
				&& (array_key_exists('passwd', $data) && !empty($data['passwd'])) ) {
            
			$user = Users::model()->find('username= "' . $data['username'] . '" AND passwd="' . $data['passwd'] . '"');
            
		} else {
			$this->_sendResponse(200, array("code"=>'0','message'=>'No usable account identification available, please pass facebook token or username and password!'));
        }
        if( !$user){
            $this->_sendResponse(200, array("code"=>'0','message'=>'Incorrect username / password combination'));
        }
        
        self::$user = $user;
        Yii::log("User:" ."User: " . print_r(self::$user->attributes,true), 'info', 'system.web.CController'); 
		
        
        $data = array_merge($data,array(
        	"user_id"	=> self::$user->id
        ));
        
        //check if auth token is already generated
        if (!isset($data['unique_id'])) {
			$this->_sendResponse(200, array("code"=>'0','message'=>'Device unique_id is required.'));
		}
        
		$device = Devices::model()->find("user_id=" . self::$user->id . " AND unique_id= '" . $data["unique_id"] . "'");
        
        if($device && $device instanceof CActiveRecord) {
            $device->setAttributes($data);
            //Yii::log("Device selected: ".print_r($device->attributes), 'info', 'system.web.CController');
            try {
                $device->save();
            } catch( Exception $e ) {
                $this->_sendResponse(200, array("code"=>'0','message'=>$e->getMessage()));
            }
        }
		
		self::$device = $device;
        
		// Collect friend data
		$friends = self::$user->get_facebook_friends($data);
		self::$user->save_facebook_friends($friends);
		$friends = self::$user->get_tongue_tango_friends($friends);
        
		if(self::$device && self::$device instanceof CActiveRecord)
            $this->setOutput("token",			self::$device->auth_token);
		$this->setOutput("user_id",			self::$user->id);
		$this->setOutput("photo",			self::$user->person->photo);
        
		foreach(self::$user as $key=>$value) $this->setOutput($key,$value);
		foreach(self::$user->person as $key=>$value) {
            if( !in_array($key, array('id', 'email_id', 'phone_id', 'address_id')) && !is_array($value) ) {
    			$this->setOutput($key, $value);
    		}
        }
        $this->setOutput('fb_friends',		$friends['fb_friends']);
		$this->setOutput('tt_friends',		$friends['tt_friends']);
		$this->setOutput('pending_friends',	$friends['pending_friends']);
        
        $person = self::$user->person;
        if( $person->email ) {
    		$this->setOutput('email_type',		$person->email->email_type);
    		$this->setOutput('email_address',	$person->email->email_address);
    	}
    	if( $person->phone ) {
    		$this->setOutput('phone_type',		$person->phone->phone_type);
    		$this->setOutput('phone_number',	$person->phone->phone_number);
    	}
        
    	$this->setOutput('user_id',		self::$user->id);

        //$this->_sendResponse();
    }

    public function actionCreate()
    {   
        if( !is_null(self::$user) ) {
            $this->actionUpdate();
            return;
        }

        $inputs = $this->getInputs();
        Yii::log("\n\n/api/user/create: ".print_r( $inputs, true), 'info', 'system.web.CController');
        
        $isUsingSocialNetworking = (isset($inputs["facebook_access_token"]) && $inputs["facebook_access_token"] != '') || 
                                   (isset($inputs["twitter_auth_token"]) && $inputs["twitter_auth_token"] != '');
        
        if($isUsingSocialNetworking ) {
        
            if( isset($inputs["facebook_access_token"]) && $inputs["facebook_access_token"] != ''
                && $this->does_user_exist($inputs["facebook_access_token"], null)){
                Yii::log("Retrieving existing user details with FB access token", 'info', 'system.web.CController');
                $this->actionLogin();
                //foreach($login as $key=>$val) $this->setOutput($key,$val);
                
                Yii::log("OUTPUT: ".print_r( $this->_response_data, true), 'info', 'system.web.CController');
                return;
            }

            if( isset($inputs["twitter_auth_token"]) && $inputs["twitter_auth_token"] != ''
                && $this->does_user_exist(null, $inputs["twitter_auth_token"])){
                Yii::log("Retrieving existing user details with Twitter auth token", 'info', 'system.web.CController');
                $this->actionLogin();
                //foreach($login as $key=>$val) $this->setOutput($key,$val);
                
                Yii::log("OUTPUT: ".print_r( $this->_response_data, true), 'info', 'system.web.CController');
                return;
            }
        }
        else { //regular Tt account
            // Check for an existing person record by user name
            $username   = $this->getInput('username', false);

            Yii::log("Searching for existing username", 'info', 'system.web.CController');
            $user   = Users::model()->findByAttributes(array( 'username' => $username ));
            Yii::log("Username search result: ".print_r($user, true), 'info', 'system.web.CController');
            if($user) {
                $this->_sendResponse(200, array("code"=>'0','message'=>'Username already taken. Please select another one.'));
            }
        }
                
        Yii::log( "Generating person record", 'info', 'system.web.CController');
        $person = $this->create_person($inputs);
        if(!$person) return;
        Yii::log("Person generated", 'info', 'system.web.CController');

        $inputs = array_merge(array("person_id"=>$person->id),$inputs);
        $inputs = array_merge(array("isUsingSocialNetworking"=>$isUsingSocialNetworking),$inputs);
        // Process email but do not require it.
        if( $this->getInput('email_address') ) {
            Yii::log( "Generating e-mail record", 'info', 'system.web.CController');
            $person_email = $this->create_person_email($inputs);
            if(!$person_email){
                $person->delete();
                $this->_sendResponse(200, array("code"=>'0','message'=>'Email already taken. Please select another one'));
                //return;
            }
            $person->email_id   = $person_email->id;
            $person->save();
            Yii::log("E-mail generated", 'info', 'system.web.CController');
        }
        // Process phone but do not require it.
        if( $this->getInput('phone') ) {
            Yii::log("Generating phone record", 'info', 'system.web.CController');
            $person_phone = $this->create_person_phone($inputs);
            
            $person->phone_id   = $person_phone->id;
            $person->save();
            Yii::log("Phone generated", 'info', 'system.web.CController');
        }
        

        $inputs = array_merge($inputs, array('person_id' => $person->id));
        Yii::log("Generating user account", 'info', 'system.web.CController');
        $user = $this->create_user($inputs);

        if(!$user){
            $person_email->delete();
            $person->delete();
            return;
        }
        if (!empty($inputs['email_address'])) {
            $body = $this->render( 'email/welcome', array(
                'content' => '',
                'email' => $inputs['email_adress'],
            ), true );

            $email = Yii::app()->email;
            $email->to = $inputs['email_address']; //, $inputs['first_name'].' '.$inputs['last_name'];
            $email->from = 'no-reply@tonguetango.com'; //, 'Tongue Tango';
            $email->subject = 'Welcome to Tongue Tango';
            $email->message = $body;
            $email->send();
        }
        
        Yii::log("User account generated.  Email sent.", 'info', 'system.web.CController');

        Yii::log("Performing HMVC login", 'info', 'system.web.CController');
        $this->actionLogin();

        Yii::log("Generating output", 'info', 'system.web.CController');
        
        
        //var_dump();die;
        /*foreach( $login as $key=>$val ) {
            $this->setOutput($key, $val);
        }*/
        Yii::log("OUTPUT: ".print_r( $this->_response_data, true), 'info', 'system.web.CController');
        
        $this->setOutput("user_id",         $user->id);      
        //$this->_sendResponse();
    }

    /**
     * Updates user and person information
     *
     * @return void
     */
    public function actionUpdate()
    {
    	$person	= self::$user->person;
    	$file	= $this->getInput('file');
    	if( is_array($file) && array_key_exists('name', $file) ) {  		
            // OLD: Kohana upload code
            //$photo		= Upload::save($file, $name, APPPATH.'cache');
    		//$public_uri	= Model_Cloudfile::upload_file($photo, 'user-image');
    		
            // Yii upload code
            /*$photo = new Photo;
            $photo->image = $file;
            $photo->image = CUploadedFile::getInstance($photo,'image');
            $photo->savePath = APPPATH . 'cache';

            if( $photo->save() ) {
                if( Yii::app()->s3->upload( $photo->fullPath  , 'uploadedfile', 's3_BucketName' ) ) {
                    $person->photo  = $public_uri;
                    $person->save();
                }
            }*/
    	}
    	$inputs	= $this->getInputs();
		Yii::log("Updating User: \n".print_r( $inputs, true), 'info', 'system.web.CController');
			
		// Handle the situation where a person creates an account without FB,
		// subsequently was added by someone else as a contact,
		// then attempts to connect to FB.

		if ( $person->facebook_id == null 
			&& isset($inputs['facebook_id']) 
			&& $inputs['facebook_id'] != '' ) {
			Yii::log("Attempting to connect existing Tt account to FB: \n".print_r( $inputs, true), 'info', 'system.web.CController');

                        
			// try to find an existing person record
            $criteria = new CDbCriteria;
            $criteria->condition=array('facebook_id='.$inputs['facebook_id'],"id!=".self::$user->id);
            $other_person = Person::model()->find($criteria);

			if ( count( $other_person ) ) {
				// if we found a person with a user record, throw the error
				$other_user = Users::model()->findByAttributes( array( 'person_id' => $other_person->id ) );
				if ( count( $other_user ) ) {
                    Yii::log( "Problem connecting existing Tt account to FB: \n".print_r( $inputs, true), 'info', 'system.web.CController');
					$this->_sendResponse(200, array("code"=>'0','message'=>'Facebook Error: This FB account belongs to another person/user'));
				} else {
					// otherwise, update the pre-existing person record
					Yii::log("Updating user_id '. API::$user->id .' with provided new FB info ", 'info', 'system.web.CController');
					
					$other_person->facebook_id = null;
					$other_person->save();
					// then update the current person record
					$person->facebook_id = $inputs['facebook_id'];
					$person->save();
					// then update the current user record with the FB access token
					self::$user->facebook_access_token = $inputs['facebook_access_token'];
					self::$user->save();
				}
			}
		}
		
    	$person->attributes = $inputs;
        $person->save();

    	self::$user->attributes = $inputs;
        self::$user->save();

        Yii::log("Updated user: \n " . print_r(self::$user->attributes, true), 'info', 'system.web.CController');
    	if( isset( $inputs['email_address'] ) ) {
                $email= PersonEmails::model()->findByAttributes( array( 'email_address' => $inputs['email_address'] ) );
    		  
    		if( !count( $email ) ) {
                $email = new PersonEmails;
	    		$email->email_address	= $inputs['email_address'];
	    		$email->email_type		= ( isset( $inputs['email_type'] ) ) ? $inputs['email_type'] : 'home';
	    		$email->person_id		= $person->id;
	    		$email->save();

    		}

    		$person->email_id		= $email->id;
    		$person->save();//print_r( $person->getErrors() );die();
            $person->refresh();

    	}
    	if( isset( $inputs['phone'] ) ) {
    		// $phone	= ORM::factory('person_phone', array('phone_number' => Arr::get($inputs, 'phone')));
			$phone = $person->phone;
    		if( count( $phone ) ) {
	    		$phone->phone_number	= $inputs['phone'];
	    		$phone->phone_type		= ( isset( $inputs['phone_type'] ) ) ? $inputs['phone_type'] : 'home';
	    		$phone->person_id		= $person->id;
	    		$phone->save();
    		}
    		$person->phone_id		= $phone->id;
    		$person->save();
            $person->refresh();
    	}
    	foreach( self::$user->attributes as $key => $value ) {
    		if( !in_array($key, array('passwd', 'id', 'person_id')) && !is_array($value) ) {
    			$this->setOutput($key, $value);
    		}
    	}
    	foreach( $person->attributes as $key => $value ) {
    		if( !in_array($key, array('id', 'email_id', 'phone_id', 'address_id')) && !is_array($value) ) {
    			$this->setOutput($key, $value);
    		}
    	}
    	if( count( $person->email ) ) {
    		$this->setOutput('email_type',		$person->email->email_type);
    		$this->setOutput('email_address',	$person->email->email_address);
    	}
    	if( count( $person->phone ) ) {
    		$this->setOutput('phone_type',		$person->phone->phone_type);
    		$this->setOutput('phone_number',	$person->phone->phone_number);
    	}
    	$this->setOutput('user_id',		self::$user->id);
       
        //$this->_sendResponse();
    }

    /**
     * Deletes a user and all associated records
     */
    public function actionDelete()
    {
    	$id		= $this->getInput('id');
        $user = User::model()->findByPk($id);
    	if( !$user->loaded() ) {
    		$this->_sendResponse(200, array("code"=>'0','message'=>'Invalid user specified or user does not exist!'));
    	}
    	$queries	= array(
    		'DELETE FROM devices WHERE user_id = %1$s',
			'DELETE FROM message_recipients WHERE message_id IN (SELECT id FROM messages WHERE user_id = %1$s)',
			'DELETE FROM message_recipients WHERE user_id = %1$s',
			'DELETE FROM message_favorites WHERE user_id = %1$s OR message_id IN (SELECT id FROM messages WHERE user_id = %1$s)',
			'DELETE FROM messages WHERE user_id = %1$s',
			'DELETE FROM contacts WHERE user_id = %1$s',
			'DELETE FROM contacts WHERE contact_user_id = %1$s',
			'UPDATE people SET email_id = null WHERE id = %1$s',
    		'DELETE FROM person_emails WHERE person_id IN ( SELECT person_id FROM users WHERE id = %1$s)',
    		'DELETE FROM person_phones WHERE person_id IN ( SELECT person_id FROM users WHERE id = %1$s)',
    		'DELETE FROM person_addresses WHERE person_id IN ( SELECT person_id FROM users WHERE id = %1$s)',
    		'DELETE FROM users WHERE id = %1$s',
    		'DELETE FROM people WHERE id = ( SELECT person_id FROM users WHERE id = %1$s)',
    	);
    	foreach( $queries as $query ) {
    		Database::instance()->query(Database::DELETE, sprintf($query, $id));
    	}
    	$this->setOutput('deleted',1);
    }

    public function does_user_exist($fb_access_token=null, $twitter_auth_token=null){
        if ( !is_null($fb_access_token) ) {
            $user = Users::model()->findByAttributes( array( "facebook_access_token" => $fb_access_token ) );
            // we may have a new access_token.  if no match search by facebook UID and update the token
            $facebook_id = $this->getInput('facebook_id');
            if (!$user && isset($facebook_id)) {

                $user = Users::model()->with(array(
                    'people' => array(
                        'join' => 'people',
                        'on' => 'user.person_id=people.id',
                        'condition' => 'facebook_id=' . $this->getInput('facebook_id'),
                    )
                ));

                if ( count( $user ) ) {
                    $user = Users::model()->findByPk( $user->id );
                    $user->facebook_access_token = $fb_access_token;
                    $user->save();
                }
            }
        }
        if (!is_null($twitter_auth_token) ) {
            $user = Users::model()->findByAttributes( array( "twitter_auth_token" => $twitter_auth_token ) );
        }
        return $user->id;
    }

    /**
     * Get a users friends requires a facebook access_token, does
     * nothing if not supplied a token
     *
     * @param $data
     * @return array|bool an array of FB friends or false
     */
    public function get_facebook_friends($data){

        if(isset($data["facebook_access_token"]) && $data["facebook_access_token"] != ''){
            $url = 'https://graph.facebook.com/me/friends?access_token='.$data["facebook_access_token"];

            $request = Request::factory($url)
                ->method('GET');

            $response = $request->execute();

			$friends_json = $response->body();

            if(strlen($friends_json) <= 0) return false;
            $friends = json_decode($friends_json,true);
            if(isset($friends["error"])){
               $this->_sendResponse(200, array("code"=>'0','message'=>'Facebook Error: ' . $friends["error"]["message"]));
            }

            $friend_data = $friends["data"];

            $friend_arr = array();
            $my_friend = array();
            foreach($friend_data as $friend){
               $name = preg_split("/\s+/",$friend["name"]);
               $my_friend["facebook_id"] = $friend["id"];
               $my_friend["first_name"] = isset($name[0]) ? $name[0] : "";
               $my_friend["last_name"] = isset($name[1]) ? $name[1] : "";
               $my_friend["photo"] = "http://graph.facebook.com/".$friend["id"]."/picture";
               $friend_arr[] = $my_friend;

            }
            return $friend_arr;
        }

        return false;

    }
    
    /**
     * Validates and creates a person record or returns false if invalid
     *
     * @param $data
     * @return bool|ORM
     */
    public function create_person($data)
    {
        Yii::log("create_person", 'info', 'system.web.CController');
        //check if person already exists via facebook id, if so then update that shiz
        if(isset($data["facebook_id"]) && $data["facebook_id"] != '')
        {
            Yii::log("Existing person found, updating instead", 'info', 'system.web.CController');
            if ( isset($data['facebook_id']) && $data['facebook_id'] != '') {
                $data['photo'] = 'http://graph.facebook.com/'.$data["facebook_id"].'/picture';
            }elseif( !isset($data['photo']) ) {
                $data['photo'] = '';
            }

            $person = People::model()->findByAttributes( array( 'facebook_id' => $data['facebook_id'] ) );
            if( count( $person ) ) {
                $person->attributes = $data;
                $person->save();
                return $person;
            }
        }
        Yii::log("No existing person matches data, creating new record", 'info', 'system.web.CController');
        $person = new People;
        $person->attributes = $data;
        $person->save();
        return $person;
    }

    /**
     * Validates and creates a person email record or returns false if invalid
     *
     * @param $data
     * @return bool|ORM
     */
    public function create_person_email($data) {
        Yii::log( "create_person_email", 'info', 'system.web.CController');
        
        /*person_email = ORM::factory("person_email")->values($data);
        $person_email->save();
        return $person_email;*/
        
        $email = $this->getInput('email_address', false);

        if ( $data["isUsingSocialNetworking"] )
        {
            $person_email = new PersonEmails;
            $person_email->attributes = $data;
            $person_email->save();
            return $person_email;
        }
        else 
        {
            $address        = $this->getInput('email_address', false);

            $person  = PersonEmails::model()->findByAttributes( array( 'email_address' => $address ) );
            Yii::log( "Email search result: ".print_r($person, true), 'info', 'system.web.CController');
            if($person) {
                    return;
            } else {
                    $person_email = new PersonEmails;
                    $person_email->attributes = $data;
                    $person_email->save();
                    return $person_email;
            }
        }
    }

    /**
     * Validates and creates a person phone record or returns false if invalid
     *
     * @param $data
     * @return bool|ORM
     */
    public function create_person_phone($data) {
        Yii::log("create_person_phone", 'info', 'system.web.CController');
        $person_phone = new PersonPhones;
        $person_phone->attributes = $data;
        $person_phone->save();
        return $person_phone;
    }

    /**
     * Validates and creates a user record or returns false if invalid
     *
     * @param $data
     * @return bool|ORM
     */
    public function create_user($data)
    {
        Yii::log("create_user: ".print_r($data, true), 'info', 'system.web.CController');
        $user = new Users;
        $user->attributes = $data;
        $user->save();
        return $user;
    }

    /**
     * Perform HMVC
     *
     * @param array $data
     */
    protected function _login($data)
    {
		$login	= json_decode( $this->actionLogin() );
		foreach( $login as $key=>$val) {
			$this->setOutput($key, $val);
		}
    }
    
}