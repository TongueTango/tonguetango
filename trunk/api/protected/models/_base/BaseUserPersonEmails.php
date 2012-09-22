<?php

/**
 * This is the model base class for the table "user_person_emails".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "UserPersonEmails".
 *
 * Columns in table "user_person_emails" available as properties of the model,
 * followed by relations of table "user_person_emails" available as properties of the model.
 *
 * @property string $id
 * @property string $user_id
 * @property string $person_email_id
 * @property string $create_date
 * @property string $update_date
 * @property string $delete_date
 *
 * @property PersonEmails $personEmail
 * @property Users $user
 */
abstract class BaseUserPersonEmails extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'user_person_emails';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'UserPersonEmails|UserPersonEmails', $n);
	}

	public static function representingColumn() {
		return 'create_date';
	}

	public function rules() {
		return array(
			array('user_id, person_email_id, create_date, update_date', 'required'),
			array('user_id, person_email_id', 'length', 'max'=>10),
			array('delete_date', 'safe'),
			array('delete_date', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, user_id, person_email_id, create_date, update_date, delete_date', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'personEmail' => array(self::BELONGS_TO, 'PersonEmails', 'person_email_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'user_id' => null,
			'person_email_id' => null,
			'create_date' => Yii::t('app', 'Create Date'),
			'update_date' => Yii::t('app', 'Update Date'),
			'delete_date' => Yii::t('app', 'Delete Date'),
			'personEmail' => null,
			'user' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('person_email_id', $this->person_email_id);
		$criteria->compare('create_date', $this->create_date, true);
		$criteria->compare('update_date', $this->update_date, true);
		$criteria->compare('delete_date', $this->delete_date, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}