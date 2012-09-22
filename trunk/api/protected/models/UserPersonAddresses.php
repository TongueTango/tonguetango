<?php

Yii::import('application.models._base.BaseUserPersonAddresses');

class UserPersonAddresses extends BaseUserPersonAddresses
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}