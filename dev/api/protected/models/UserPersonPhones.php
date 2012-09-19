<?php

Yii::import('application.models._base.BaseUserPersonPhones');

class UserPersonPhones extends BaseUserPersonPhones
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}