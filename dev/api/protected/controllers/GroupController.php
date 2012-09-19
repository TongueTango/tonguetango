<?php
Yii::import('ext.logger.CPSLiveLogRoute');
class GroupController extends Controller
{
    
    public function actionList()
	{   $time = microtime(true);
		$groups = array();
        
        $sql = "SELECT `group`.* FROM `groups` AS `group` 
                JOIN `group_members` ON (`group_members`.`group_id` = `group`.`id`) 
                WHERE `group_members`.`user_id` = " . self::$user->id . " AND `group`.`delete_date` IS NULL";
        
        $groupModels = Groups::model()->with(array('groupMembers'=>array(
                                            'joinType'=>'JOIN',
                                        )))->findAllBySql($sql);
        
		foreach($groupModels  as $group) {
			$members = array();
			foreach( $group->groupMembers as $member) {
				$members[] = array(
					'user'	=> $member->user->id,
					'photo'	=> $member->user->person->photo,
				);
			}
			$groups[] = array_merge($group->attributes, array('members' => $members) );
		}
        $timeafter = microtime(true);
        
        var_dumP($timeafter - $time);die;
		$this->setOutput('groups',$groups);
	}
    
    public function actionCreate()
    {
        $group_id 		= $this->getInput('id', null);
		if( !is_null($group_id) ) {
    		$this->action_update();
    		return;
    	}
		
		$group 			= new Groups;
		$group->user_id = self::$user->id;
        if(is_null($group->name)) {
            
        }
		$group->name 	= $this->getInput('name');
        if($group->save()) {
		
            $groupMember = new GroupMembers;
            $groupMember->group_id = $group->id;
            $groupMember->user_id = self::$user->id;
            $groupMember->save();
        } else {
            $this->_sendResponse(404, array("code"=>0, 'message'=>$group->errors));
        }
		
		$this->setOutput('group', $group->attributes);
    }
    
    public function actionUpdate()
	{
        $id = Yii::app()->request->getParam('id');
		if( is_null($id) ) {
			$this->_sendResponse(400, array("code"=>0, 'message'=>"Invalid group specified"));
		}
		$group = Groups::model()->findByPk($id);
        if(!$group) {
            $this->_sendResponse(400, array("code"=>0, 'message'=>"Invalid group specified"));
        }
        
		$group->attributes = $this->getInputs();
        
		$group->save();
		// handle image uploads
//		$file	= $this->getInput('file');
//    	if( is_array($file) && array_key_exists('name', $file) ) {
//    		$name		= microtime(true).'-'.$file['name'];
//    		$photo		= Upload::save($file, $name, APPPATH.'cache');
//    		$public_uri	= Model_Cloudfile::upload_file($photo, 'group-image');
//    		$group->photo	= $public_uri;
//    		$group->save();
//    	}
//		
		$members = $this->getInput('members', '');
		
		if ($members != '') {

			$members = explode(",", $this->getInput('members'));
            
            $criteria = new CDbCriteria;
            $criteria->condition = 'group_id='.$id . ' AND ' .
                                       'user_id !='.self::$user->id  . ' AND ' .
                                       'user_id NOT IN ('.implode(',', $members).')';
            
            
            $removed_members = GroupMembers::model()->findAll($criteria);
            
			// remove folks as necessary
			
			foreach ($removed_members as $removed) {
				$removed->delete();
			}
			if (is_array($members) && count($members) > 0) {
				$existing_members = $group->groupMembers;
                
				foreach($members as $member) {
					if ($member != self::$user->id && $member > 0 && !in_array($member, $existing_members)) {
						
                        $newMember = new GroupMembers;
                        $newMember->user_id  = $member;
                        $newMember->group_id = $group->id;
                        
                        $newMember->save();
                        
						$member_user = Users::model()->with(array('devices'=>array(   // skip results with empty push token
                                            'condition'=>'devices.push_token != "" AND devices.push_token IS NOT NULL',
                                        )))->findByPk($member);
                        
                        if(!$member_user) continue;
                        
						$devices = $member_user->devices;
                        
                        
						$alert = "You've been added to the group: " .$group->name;
						$extra = array(
									"action"		=> 'group',
								);
                        
						PUSH::send($devices, $alert, $extra);
                        Yii::log("Pushes sent to group!", 'info', 'system.web.CController');
					}
				}
			}
		}
        
		$members = array();
		foreach( $group->groupMembers as $member ) {
			$members[]	= array(
				'user_id'	=> $member->user->id,
				'photo'		=> $member->user->person->photo,
			);
		}
		$this->setOutput('group', array_merge($group->attributes, array(
			'members'	=> $members,
		)));
	}
    
    public function actionDelete($id)
	{ 
		$group 	= Groups::model()->findbyPk($id);
		
		if ( $group) {
			$group->delete_date = date('Y-m-d H:i:s');
			$group->save();
			$this->setOutput('deleted', 1);
		} else {
            $this->_sendResponse(400, array("code"=>0, 'message'=>"Invalid group specified"));
        }
		
	}
    
}