<?php

Yii::import('application.models._base.BaseUserPersonEmails');

class UserPersonEmails extends BaseUserPersonEmails
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}