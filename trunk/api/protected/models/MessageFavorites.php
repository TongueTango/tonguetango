<?php

Yii::import('application.models._base.BaseMessageFavorites');

class MessageFavorites extends BaseMessageFavorites
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}