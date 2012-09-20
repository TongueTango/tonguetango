Airship
==================

This is a very simple Kohana 3 module for the Urban Airship REST API (http://www.urbanairship.com)

Use it like so:

$payload = array(
	"aps" => array(
			'badge' => '+1',
			'alert' => "You are sending Push Notifications! :)",
			'sound' => 'alert.caf',
		),
	"device_tokens" => array('asdlkfj12340809r8qweorlkasjdflkajsd091823094'),
	"extra" => array(
		'some_key' => 'some_value',
		),
 );
 
$airship = Airship::factory(); 
$airship->push($payload);


License
-------
Copyright 2011, @geomon. Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
