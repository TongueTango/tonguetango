<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Airship
 * This is a simple PHP library for Kohana to the Urban Airship API
 *
 *    $airship = Airship::factory([config_name]);
 *    $airship->push($payload);
 *
 * @author	George Moncrief (@geomon)
 * @copyright	(c) 2012 @geomon
 * @license	http://www.opensource.org/licenses/mit-license.php
 */
abstract class Airship_Core {

	/**
	 * @var	string	Default config name
	 */
	public static $default_config_name = 'default';

	/**
	 * @var	array	Configuration array
	 */
	protected $_config;
	
	/**
	 * Create and return new Airship object
	 * 
	 * @param string $name
	 * @return Airship
	 */
	public static function factory($name = NULL)
	{
		return new Airship($name);
	}

	/**
	 * Init Airship
	 *
	 * @param string $name
	 */
	public function __construct($name = NULL)
	{
		if ($name === NULL)
		{
			$name = self::$default_config_name;
		}

        $this->_config = Kohana::$config->load("airship")->$name;

		if ( ! isset($this->_config['push_secret'])		OR
			   $this->_config['push_secret'] === NULL	OR
			   $this->_config['push_secret'] == ''
			)
		{
			throw new Airship_Exception('Airship push_secret is not defined in :name configuration',
				array(':name' => $name));
		}

		if ( ! isset($this->_config['app_key'])	OR
			   $this->_config['app_key'] === NULL	OR
			   $this->_config['app_key'] == ''
			)
		{
			throw new Airship_Exception('Airship app_key is not defined in :name configuration',
				array(':name' => $name));
		}
	}

	/**
	 * Send a push notification by providing a payload.
	 *
	 * @param	mixed	$payload
	 * @return	mixed
	 */
	public function push($payload)
	{
		// Check if we can initialize a cURL connection
		$ch = curl_init();
		if ($ch === FALSE)
		{
			throw new Airship_Exception('Could not initialise cURL!');
		}

		$json = json_encode($payload );
		$json = preg_replace( "/:(\d+)(,|\})/", ':"$1"$2', $json );
		
		$session = curl_init($this->_config['endpoint']);
		curl_setopt($session, CURLOPT_USERPWD, $this->_config['app_key'] . ':' . $this->_config['push_secret']);
		curl_setopt($session, CURLOPT_POST, True);
		curl_setopt($session, CURLOPT_POSTFIELDS, $json);
		curl_setopt($session, CURLOPT_HEADER, False);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, True);
		curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		$content = curl_exec($session);

		// Check if any error occured
		$response = curl_getinfo($session);
		
		// print debug::vars($payload);
		// print debug::vars($response);
		
		
		
		if($response['http_code'] != 200) {
			// Log::instance()->add(Log::NOTICE, 'UA Error.  Request: '.debug::vars($json).' Response: '.debug::vars($response));
			//throw new Airship_Exception('Airship error. Please check the error log.');
		}
		// Log::instance()->add(Log::DEBUG, 'UA Response: '.print_r($response, true));
		
		curl_close($session);
	}
}