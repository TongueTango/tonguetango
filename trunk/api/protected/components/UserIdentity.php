<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$users = $this->getUserList(); 
                
                if(empty($users)) 
                {
                    $this->errorCode = self::ERROR_USERNAME_INVALID;
                    return !$this->errorCode;
                }
                
		if(!isset($users[$this->username]))
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if($users[$this->username] !== md5($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode = self::ERROR_NONE;
		return !$this->errorCode;
	}
        
        private function getUserList()
        {
            $users = Yii::app()->db->createCommand()
                              ->select('mu.id,mu.email, mu.password')
                              ->from('master_user mu')
                              ->queryAll();
            
            $retArrayUsers    = array();
            foreach($users as $user)
            {
                $retArrayUsers[$user['email']] = $user['password'];
            }
            
            return $retArrayUsers;
        }
        
        public function getUserInfo($email)
        {
            $user = Yii::app()->db->createCommand()
                              ->select('mu.role_id, mo.org_code')
                              ->from('master_user mu')
                              ->join('master_organisation mo', 'mu.organisation_id = mo.id')
                              ->where('email=:email', array(':email'=>$email))
                              ->queryRow();
            
            
            
            return $user;
        }
}