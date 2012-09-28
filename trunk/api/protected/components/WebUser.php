<?php


/**
 * Description of WebUser
 *
 * @author Alexander
 */
class WebUser extends CWebUser {
 
  private $_model;
 
  function getFirst_Name(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->first_name;
  }
  // in the User model to be equal to 1, that means it's admin
  // access it by Yii::app()->user->isAdmin()
  function isAdmin(){
    $user = $this->loadUser(Yii::app()->user->id);
    return intval($user->role_id) == 1;
  }
  
  function isPublic(){
    $user = $this->loadUser(Yii::app()->user->id);
    return intval($user->role_id) == 2;
  }
  
//  function isAdmin(){
//    $user = $this->loadUser(Yii::app()->user->id);
//    return intval($user->role) == 1;
//  }
//  
//  function isAdmin(){
//    $user = $this->loadUser(Yii::app()->user->id);
//    return intval($user->role) == 1;
//  }
 
  // Load user model.
  protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
            {
                $criteria            = new CDbCriteria;
                $criteria->condition = 'LOWER(email)=:email';
                $criteria->params    = array(':email'=>strtolower($id));
                $this->_model=User::model()->find($criteria);
            }
        }
        return $this->_model;
    }
}

?>
