<?php

Yii::import('application.models._base.BaseMessageTypes');

class MessageTypes extends BaseMessageTypes
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}