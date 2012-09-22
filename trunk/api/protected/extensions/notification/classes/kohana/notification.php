<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kohana level notification class, handling all
 * styles of notification communication, especially
 * started to handle push notifications and e-mail
 * like secure mobile messaging.
 * @author James Zimmerman II
 */
abstract class Kohana_Notification {
	protected static $_request = array();
	protected static $_adapters = array();
	/**
	 * Adapter generator
	 * @param string|null	$name	Optional identifier name, default: "default"
	 * @param array|null	$config	Optional configuration array with parameters
	 * @param bool|null		$force	Optionally force reconstruction, event default
	 * @return Kohana_Notification_Adapter_Abstract
	 */
	public static function getAdapter($name='default',$config=null,$force=false)
	{
		$adapter = ( Notification_Adapter::getAdapterInstance($name,$config,$force) );
		$adapter
			->setRequest(self::_getRequest())
			->setParameters(self::_getRequestBody(),$_GET,$_POST);
		self::$_adapters[$name] = $adapter;
//		Kohana::$log->add(LOG_DEBUG, 'Request Body: '.print_r(self::_getRequestBody(),true));
		return $adapter;
	}
	public static function setRequestBody($body)
	{
		self::$_request['body'] = $body;
//		Kohana::$log->add(LOG_DEBUG,print_r(self::$_request['body'],true));
	} 
	protected static function _getRequest()
	{
		$request = $_SERVER['REQUEST_URI'];
		return $request;
	}
	protected static function _getRequestBody()
	{
		return ( array_key_exists('body', self::$_request) ? self::$_request['body'] : null );
	}
	/**
	 * Device management
	 */
	public static function deviceCreate($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Creating notification device record.');
		return self::getAdapter($adapter)->deviceCreate();
	}
	public static function deviceList($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Listing notification device records.');
		return self::getAdapter($adapter)->deviceList();
	}
	public static function deviceDetails($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Listing notification device record details.');
		return self::getAdapter($adapter)->deviceDetails();
	}
	public static function deviceCount($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Counting notification device records.');
		return self::getAdapter($adapter)->deviceCount();
	}
	public static function deviceFeedback($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Updating notification device records from feedback.');
		return self::getAdapter($adapter)->deviceFeedback();
	}
	public static function deviceUpdate($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Updating notification device record.');
		return self::getAdapter($adapter)->deviceUpdate();
	}
	public static function deviceTagAdd($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Updating notification device record.');
		return self::getAdapter($adapter)->deviceTagAdd();
	}
	public static function deviceTagRemove($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Updating notification device record.');
		return self::getAdapter($adapter)->deviceTagRemove();
	}
	public static function deviceRemove($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Removing notification device record.');
		return self::getAdapter($adapter)->deviceRemove();
	}
	/**
	 * User management
	 */
	public static function userCreate($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Creating mobile mail user record.');
		return self::getAdapter($adapter)->userCreate();
	}
	public static function userList($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Listing mobile mail user records.');
		return self::getAdapter($adapter)->userList();
	}
	public static function userReset($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Resetting mobile mail user record.');
		return self::getAdapter($adapter)->userReset();
	}
	public static function userUpdate($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Updating mobile mail user record.');
		return self::getAdapter($adapter)->userUpdate();
	}
	public static function userRemove($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Removing mobile mail user record.');
		return self::getAdapter($adapter)->userRemove();
	}
	/**
	 * Tag management
	 */
	public static function tagCreate($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Creating tag record.');
		return self::getAdapter($adapter)->tagCreate();
	}
	public static function tagList($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Listing tag records.');
		return self::getAdapter($adapter)->tagList();
	}
	public static function tagDetails($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Listing tag record details.');
		return self::getAdapter($adapter)->tagDetails();
	}
	public static function tagUpdate($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Updating tag record.');
		return self::getAdapter($adapter)->tagUpdate();
	}
	public static function tagRemove($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Removing tag record.');
		return self::getAdapter($adapter)->tagRemove();
	}
	/**
	 * Push notification
	 */
	public static function pushNotification($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Creating push notification message.');
		return self::getAdapter($adapter)->pushNotification();
	}
	public static function pushBroadcast($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Creating broadcast push notification message.');
		return self::getAdapter($adapter)->pushBroadcast();
	}
	public static function pushStats($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Retrieving push notification statistics!');
		return self::getAdapter($adapter)->pushStats();
	}
	/**
	 * Rich push notification
	 */
	public static function mobileMailNotification($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Creating mobile mail notification message.');
		return self::getAdapter($adapter)->mobileMailNotification();
	}
	public static function mobileMailBroadcast($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Creating broadcast mobile mail notification message.');
		return self::getAdapter($adapter)->mobileMailBroadcast();
	}
	public static function mobileMailMessageList($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Listing mobile mail messages.');
		return self::getAdapter($adapter)->mobileMailMessageList();
	}
	public static function mobileMailMessageBody($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Listing mobile mail message details.');
		return self::getAdapter($adapter)->mobileMailMessageBody();
	}
	public static function mobileMailMessageStatus($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Updating mobile mail message status.');
		return self::getAdapter($adapter)->mobileMailMessageStatus();
	}
	public static function mobileMailDeleteMessage($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Removing mobile mail message.');
		return self::getAdapter($adapter)->mobileMailDeleteMessage();
	}
	/**
	 * Push application management
	 */
	public static function applicationCreate($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Creating notification application record.');
		return self::getAdapter($adapter)->applicationCreate();
	}
	public static function applicationList($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Listing notification application records.');
		return self::getAdapter($adapter)->applicationList();
	}
	public static function applicationDetails($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Updating notification application record details.');
		return self::getAdapter($adapter)->applicationDetails();
	}
	public static function applicationUpdate($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Updating notification application record details.');
		return self::getAdapter($adapter)->applicationUpdate();
	}
	public static function applicationRemove($adapter=null)
	{
		Kohana::$log->add(LOG_INFO, 'Removing notification application record.');
		return self::getAdapter($adapter)->applicationRemove();
	}
	/**
	 * End API's
	 */
}