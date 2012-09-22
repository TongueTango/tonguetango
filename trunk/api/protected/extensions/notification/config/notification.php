<?php defined('SYSPATH') or die('No direct script access.');

return array(
	// General module options
	'module' => array(
	),
	// Push notification adapter configs
	'push' => array(
		// Ordered by priority
		'adapters' => array(
			1 => array(
				'name' => 'urbanairship',
				'types' => array(
					'ios', 'android', 'blackberry'
				)
			)
		)
	),
	// Email notification adapter configs
	'email' => array(
	),
	// SMS notification adapter configs
	'sms' => array(
	),
);