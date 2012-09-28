<?php

Yii::import('application.models._base.BasePersonEmails');

class PersonEmails extends BasePersonEmails
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}