<?php

Yii::import('application.models._base.BaseDevices');

class Devices extends BaseDevices
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}