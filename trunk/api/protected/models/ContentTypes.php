<?php

Yii::import('application.models._base.BaseContentTypes');

class ContentTypes extends BaseContentTypes
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}