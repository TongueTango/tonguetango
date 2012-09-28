<?php
Yii::import('ext.logger.CPSLiveLogRoute');
class GroupController extends Controller
{
    
    public function actionList()
	{   
		$groups = array();
        
        $sql = "SELECT `group`.* FROM `groups` AS `group` 
                JOIN `group_members` ON (`group_members`.`group_id` = `group`.`id`) 
                WHERE `group_members`.`user_id` = " . self::$user->id . " AND `group`.`delete_date` IS NULL AND `group_members`.`removed` = 0
				AND `group`.`id` NOT IN (SELECT group_id FROM group_blocks WHERE(user_id = " . self::$user->id . " AND blocked = 1))";
        
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
       
		$this->setOutput('groups',$groups);
	}
    
    public function actionCreate()
    {	
		$group 			= new Groups;
		$group->user_id = self::$user->id;
        /*if(is_null($group->name)) {
            
        }*/
		$group->name 	= $this->getInput('name');
        if($group->save()) {
		
            $groupMember = new GroupMembers;
            $groupMember->group_id = $group->id;
            $groupMember->user_id = self::$user->id;
			$groupMember->accepted = 1;
            $groupMember->save();
        } else {
            $this->_sendResponse(404, array("code"=>0, 'message'=>$group->errors));
        }
		
		$this->setOutput('group', $group->attributes);
    }
    
    public function actionUpdate($id)
	{
        $id = intval($id);   
		if( is_null($id) ) {
			$this->_sendResponse(400, array("code"=>0, 'message'=>"Invalid group specified"));
		}
		$group = Groups::model()->with(array('groupMembers'=>array('select'=>'id,user_id')))->findByPk($id);
        if(!$group) {
            $this->_sendResponse(400, array("code"=>0, 'message'=>"Invalid group specified"));
        }
        
		$group->attributes = $this->getInputs();
        
		$group->save();
        $file = $this->getInput('file');
        if( is_array($file) && array_key_exists('name', $file) ) { 
            $bucketName = 'tangofiles';
            $fileName = md5(microtime(true)).$file['name'];
            if( Yii::app()->s3->upload($file['tmp_name']  , $fileName, $bucketName ) ) {
                    $public_uri = "http://".$bucketName.".s3.amazonaws.com/".$fileName;
                    $group->photo	= $public_uri;
                    $group->save();
            
            }
        }
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
                $removedUserDevices = $removed->user->devices;
                $alert = "You've been removed from the group: " .$group->name;
                $extra = array(
                            "action"		=> 'group',
                        );

                PUSH::send($removedUserDevices, $alert, $extra);
				$removed->delete();
			}
            
			if (is_array($members) && count($members) > 0) {
				$existing_members = $group->groupMembers;
                $existing_members = CHtml::listData($existing_members,'id','user_id');
                
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
		} else {
            $criteria = new CDbCriteria;
            $criteria->condition = 'group_id='.$id . ' AND ' .
                                   'user_id !='.self::$user->id  . ' ';
            
            $removed_members = GroupMembers::model()->findAll($criteria);
            
			// remove all users
			foreach ($removed_members as $removed) {
                $removedUserDevices = $removed->user->devices;
                $alert = "You've been removed from the group: " .$group->name;
                $extra = array(
                            "action"		=> 'group',
                        );

                PUSH::send($removedUserDevices, $alert, $extra);
				$removed->delete();
			}
            
        }
        
		$members = array();
        $group = Groups::model()->findByPk($id);
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
    
    public function actionAccept($id)
    {
        $id = intval($id);   
		if( is_null($id) ) {
			$this->_sendResponse(400, array("code"=>0, 'message'=>"Invalid group specified"));
		}
		$group = Groups::model()->with(array('groupMembers'=>array('condition'=>'groupMembers.user_id='.self::$user->id)))
                                ->findByPk($id);
        if(!$group) {
            $this->_sendResponse(400, array("code"=>0, 'message'=>"Invalid group specified"));
        }
        foreach($group->groupMembers as $mem) {
            $membership = $mem;
        }
        $membership->accepted = 1;
        if($membership->save()) {
            $this->_sendResponse(400, array('message'=>"success"));
        } else {
            $this->_sendResponse(400, array('message'=>"failure"));
        }
    }
    
    public function actionReject($id)
    {
        $id = intval($id);   
		if( is_null($id) ) {
			$this->_sendResponse(400, array("code"=>0, 'message'=>"Invalid group specified"));
		}
        $group = Groups::model()->with(array('groupMembers'=>array('condition'=>'groupMembers.user_id='.self::$user->id)))
                                ->findByPk($id);
        if(!$group) {
            $this->_sendResponse(400, array("code"=>0, 'message'=>"Invalid group specified"));
        }
        foreach($group->groupMembers as $mem) {
            $membership = $mem;
        }
        $membership->removed = 1;
        if($membership->save()) {
            $this->setOutput('status', 'success');
        } else {
            $this->setOutput('status', 'failure');
        }
    }
    
    public function actionBlock( $id = 0 ) {
		if( $id != 0 ) {
			$member = GroupMembers::model()->findByAttributes( array( 'group_id' => intval( $id ), 'user_id' => self::$user->id, 'accepted' => 1 ) );

			if( !$member ) {
				$this->_sendResponse(400, array("code"=>0, 'message'=>"You are not joined to group"));
			}

			$block_group = GroupBlocks::model()->findByAttributes( array( 'user_id' => self::$user->id, 'group_id' => $member->group_id ) );
			
			if( $block_group && $block_group->blocked == 1) {
				$this->_sendResponse(400, array("code"=>0, 'message'=>"You have already blocked group"));
			}

			if ($block_group && $block_group->update_date != NULL && $block_group->blocked == 0) {
				$block_group->blocked = 1;
			} else {
				$block_group = new GroupBlocks;
				$block_group->user_id = self::$user->id;
				$block_group->group_id = $member->group_id;
				$block_group->blocked = 1;
			}
			if( $block_group->save() ) {
				$this->setOutput('status', 'success');
				$this->_sendResponse();
			} else {
				$this->setOutput('status', 'failure');
				$this->_sendResponse();
			}

		} else { $this->_sendResponse(400, array("code"=>0, 'message'=>"Please enter group id")); }
	}
	
	public function actionUnblock( $id = 0 ) {
        if( $id != 0 ) {
			$member = GroupMembers::model()->findByAttributes( array( 'group_id' => intval( $id ), 'user_id' => self::$user->id, 'accepted' => 1 ) );

			if( !$member ) {
				$this->_sendResponse(400, array("code"=>0, 'message'=>"You are not joined to group"));
			}
			
            $block_group = GroupBlocks::model()->findByAttributes( array( 'user_id' => self::$user->id, 'group_id' => $member->group_id ) );

            if( !$block_group ) {
                $this->_sendResponse(200, array("code"=>'0','message'=>"This group is not blocked for you"));
            }

            if( $block_group->blocked == 0 ) {
                $this->_sendResponse(200, array("code"=>'0','message'=>"Already unblocked"));
            }

            $block_group->blocked = 0;
            if( $block_group->save() ) {
                $this->setOutput("status", "unblocked");
            } else {
                $this->_sendResponse(200, array("code"=>'0','message'=>"Database error, please try it later"));
            }
        }
	}
    
}