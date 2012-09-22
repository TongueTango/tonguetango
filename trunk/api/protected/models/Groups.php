<?php

Yii::import('application.models._base.BaseGroups');

class Groups extends BaseGroups
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
    
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if($this->isNewRecord)
            {
                $this->create_date  = date("Y-m-d H:i:s");
                $this->update_date = date("Y-m-d H:i:s");
            }
            else
                $this->update_date = date("Y-m-d H:i:s");
            return true;
        }
        else
            return false;
    }
}