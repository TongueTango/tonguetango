<?php

Yii::import('application.models._base.BasePersonPhones');

class PersonPhones extends BasePersonPhones
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}