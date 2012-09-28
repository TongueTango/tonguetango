<?php

Yii::import('application.models._base.BaseDevices');

class Devices extends BaseDevices
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function beforeSave()
	{
		if(parent::beforeSave()) {
            if( empty($this->auth_token) ) {
                $this->auth_token	= $this->_generate_token();
            }
            
            if($this->isNewrecord) { 
                $this->create_date = date('Y-m-d H:i:s');
            }
            $this->update_date = date('Y-m-d H:i:s');
            return true;
        }
	}

	/**
	 * Generate random authorization token
	 */
	private function _generate_token()
	{
		return hash_hmac('sha256', uniqid('TT_DEVICE', true), uniqid('SALT', true));
	}

}