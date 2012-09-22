<?php

Yii::import('application.models._base.BasePreferences');

class Preferences extends BasePreferences
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}