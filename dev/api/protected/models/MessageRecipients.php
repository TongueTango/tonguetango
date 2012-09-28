<?php

Yii::import('application.models._base.BaseMessageRecipients');

class MessageRecipients extends BaseMessageRecipients
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}