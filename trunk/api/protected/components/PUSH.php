<?php //defined('SYSPATH') or die('No direct script access.');

/**
 * Utility class to provide fast access to
 * Urban Airship Push Notifications.
 * @author george
 */


abstract class PUSH
{
	public static function send($devices, $message='', $extra=array())
	{
		$android_apids_array = array();
		$ios_token_array = array();
		
		foreach ( $devices as $device ) {
			if ( $device->device_type == 'Android' ) {
				$android_apids_array[] = $device->push_token;
			} else {
				$ios_token_array[] = $device->push_token;
			}
		}
		// setup the android payload
		$push_array = array();	
		if (count($android_apids_array) > 0) {
			$push_array = array_merge($push_array, array(
				"android" => array(
					"alert" 	=> $message,
					"extra" 	=> $extra
				),
				"apids" => $android_apids_array
			));
		}
		// set up the ios payload
        
		if (count($ios_token_array) > 0) {
			$push_array = array_merge($push_array, array(
				"aps"	=> array(
					"badge"	=> 1,
					"alert"	=> $message,
					"sound"	=> "default",
				),
				"device_tokens"	=> $ios_token_array,
				"extra"	=> $extra
			));
		}
//		Yii::log('UA Push Payload: \n'.print_r($push_array, true), 'info', 'system.web.CController'); 
		
		$result = Airship::factory()->push($push_array);
        
//		Yii::log('UA Push Result: \n'.print_r($result, true), 'info', 'system.web.CController');
	}
}
	