<?php

Yii::import('application.models._base.BaseProducts');

class Products extends BaseProducts
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}