<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Notification adapter interface, specifying the
 * required minimum methods to be compatible with
 * the notification manager mechanisms.
 * @author James Zimmerman II
 */
interface Kohana_Notification_Adapter_Interface {
	public function deviceCreate();
	public function deviceList();
	public function deviceDetails();
	public function deviceCount();
	public function deviceFeedback();
	public function deviceUpdate();
	public function deviceRemove();
	public function userCreate();
	public function userList();
	public function userReset();
	public function userUpdate();
	public function userRemove();
	public function tagCreate();
	public function tagList();
	public function tagDetails();
	public function tagUpdate();
	public function tagRemove();
	public function pushNotification();
	public function pushBroadcast();
	public function pushStats();
	public function mobileMailNotification();
	public function mobileMailBroadcast();
	public function mobileMailMessageList();
	public function mobileMailMessageBody();
	public function mobileMailMessageStatus();
	public function mobileMailDeleteMessage();
	public function applicationCreate();
	public function applicationList();
	public function applicationDetails();
	public function applicationUpdate();
	public function applicationRemove();
}