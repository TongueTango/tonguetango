<?php defined('SYSPATH') or die('No direct script access.');
abstract class Kohana_Notification_Adapter
{
	protected static $_instances = array();
	public static function getAdapterInstance($name=null,$config=null,$force=false)
	{
		$gConfig			= Config::instance()->load('push');
		$defaultProvider	= $gConfig['default_provider'];
		if( $name === null ) {
			if( array_key_exists( 'default', self::$_instances ) AND !$force )
				return self::$_instances['default'];
			$adapterConfig	= $gConfig['providers'][$defaultProvider];
			$adapterClass	= $adapterConfig['class_name'];
			self::$_instances['default'] = new $adapterClass( $adapterConfig );
			self::$_instances[$defaultProvider] = self::$_instances['default'];
			return self::$_instances['default'];
		} else {
			if( !$config )
				$config = $gConfig['providers'][$name];
			if( array_key_exists( $name, self::$_instances ) AND !$force )
				return self::$_instances[$name];
			if( is_array($config) ) {
				$adapterClass = ( array_key_exists( 'class_name', $config ) ? $config['class_name'] : 'Notification_Adapter_'.ucfirst( $name ) );
				Kohana::$log->add(LOG_DEBUG, $adapterClass );
				self::$_instances[$name] = new $adapterClass( $config );
			} else {
				throw new Exception("Configuration not found for specified provider!");
			}
			return self::$_instances[$name];
		}
		return self::$_instances[$name];
	}
}