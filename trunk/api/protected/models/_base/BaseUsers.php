<?php

/**
 * This is the model base class for the table "users".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Users".
 *
 * Columns in table "users" available as properties of the model,
 * followed by relations of table "users" available as properties of the model.
 *
 * @property string $id
 * @property string $person_id
 * @property string $username
 * @property string $passwd
 * @property string $facebook_access_token
 * @property string $twitter_auth_token
 * @property string $create_date
 * @property string $update_date
 * @property string $delete_date
 *
 * @property Contacts[] $contacts
 * @property Contacts[] $contacts1
 * @property Devices[] $devices
 * @property GroupMembers[] $groupMembers
 * @property Groups[] $groups
 * @property MessageFavorites[] $messageFavorites
 * @property MessageRecipients[] $messageRecipients
 * @property Messages[] $messages
 * @property Preferences[] $preferences
 * @property Products[] $products
 * @property UserPersonAddresses[] $userPersonAddresses
 * @property UserPersonEmails[] $userPersonEmails
 * @property UserPersonPhones[] $userPersonPhones
 * @property People $person
 */
abstract class BaseUsers extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'users';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Users|Users', $n);
	}

	public static function representingColumn() {
		return 'username';
	}

	public function rules() {
		return array(
			array('person_id, username, passwd, create_date', 'required'),
			array('update_date', 'required', 'on' => 'update' ),
			array('person_id', 'length', 'max'=>10),
			array('username, passwd, facebook_access_token, twitter_auth_token', 'length', 'max'=>255),
			array('delete_date', 'safe'),
			array('facebook_access_token, twitter_auth_token, delete_date', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, person_id, username, passwd, facebook_access_token, twitter_auth_token, create_date, update_date, delete_date', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'contacts' => array(self::HAS_MANY, 'Contacts', 'contact_user_id'),
			'contacts1' => array(self::HAS_MANY, 'Contacts', 'user_id'),
			'devices' => array(self::HAS_MANY, 'Devices', 'user_id'),
			'groupMembers' => array(self::HAS_MANY, 'GroupMembers', 'user_id'),
			'groups' => array(self::HAS_MANY, 'Groups', 'user_id'),
			'messageFavorites' => array(self::HAS_MANY, 'MessageFavorites', 'user_id'),
			'messageRecipients' => array(self::HAS_MANY, 'MessageRecipients', 'user_id'),
			'messages' => array(self::HAS_MANY, 'Messages', 'user_id'),
			'preferences' => array(self::HAS_MANY, 'Preferences', 'user_id'),
			'products' => array(self::MANY_MANY, 'Products', 'products_users(user_id, product_id)'),
			'userPersonAddresses' => array(self::HAS_MANY, 'UserPersonAddresses', 'user_id'),
			'userPersonEmails' => array(self::HAS_MANY, 'UserPersonEmails', 'user_id'),
			'userPersonPhones' => array(self::HAS_MANY, 'UserPersonPhones', 'user_id'),
			'person' => array(self::BELONGS_TO, 'People', 'person_id'),
		);
	}

	public function pivotModels() {
		return array(
			'products' => 'ProductsUsers',
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'person_id' => null,
			'username' => Yii::t('app', 'Username'),
			'passwd' => Yii::t('app', 'Passwd'),
			'facebook_access_token' => Yii::t('app', 'Facebook Access Token'),
			'twitter_auth_token' => Yii::t('app', 'Twitter Auth Token'),
			'create_date' => Yii::t('app', 'Create Date'),
			'update_date' => Yii::t('app', 'Update Date'),
			'delete_date' => Yii::t('app', 'Delete Date'),
			'contacts' => null,
			'contacts1' => null,
			'devices' => null,
			'groupMembers' => null,
			'groups' => null,
			'messageFavorites' => null,
			'messageRecipients' => null,
			'messages' => null,
			'preferences' => null,
			'products' => null,
			'userPersonAddresses' => null,
			'userPersonEmails' => null,
			'userPersonPhones' => null,
			'person' => null,
		);
	}

	public function beforeValidate() {
		if($this->isNewRecord) { $this->create_date = date('Y-m-d H:i:s'); }
		else { $this->update_date = date('Y-m-d H:i:s'); }

		return true;
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('person_id', $this->person_id);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('passwd', $this->passwd, true);
		$criteria->compare('facebook_access_token', $this->facebook_access_token, true);
		$criteria->compare('twitter_auth_token', $this->twitter_auth_token, true);
		$criteria->compare('create_date', $this->create_date, true);
		$criteria->compare('update_date', $this->update_date, true);
		$criteria->compare('delete_date', $this->delete_date, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}