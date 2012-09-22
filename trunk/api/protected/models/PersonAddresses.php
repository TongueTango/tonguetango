<?php

Yii::import('application.models._base.BasePersonAddresses');

class PersonAddresses extends BasePersonAddresses
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}