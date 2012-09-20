<?php

$arrayMainConfig = array('basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Local Event',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.giix-components.*',
		'ext.airship.*',
        
	),

	// application components
	'components'=>array(
//        'cache'=>array(
//            'class'=>'system.caching.CMemCache',
//            'useMemcached'=>false,
//            'servers'=>array(
//                array('host'=>'localhost', 'port'=>11211, 'weight'=>60),
//            ),
//        ),
        
        
        'CURL' =>array(
            'class' => 'application.extensions.curl.Curl',
                //you can setup timeout,http_login,proxy,proxylogin,cookie, and setOPTIONS
            ),
        's3'=>array(
                    'class'=>'ext.s3.ES3',
                    'aKey'=>'ADD YOUR AKEY HERE', 
                    'sKey'=>'ADD YOUR SKEY HERE',
                ),
        'email' => array(
            'class'=>'application.extensions.email.Email',
            'delivery'=>'php', //Will use the php mailing function.
        ),
        'bitly' => array(
            'class' => 'application.extensions.bitly.VGBitly',
            'login' => 'xxxxx', // login name
            'apiKey' => 'xxxxxx', // apikey 
            'format' => 'xml', // default format of the response this can be either xml, json (some callbacks support txt as well)
        ),
		
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				// REST patterns for users
        		array('user/login', 'pattern'=>'user/login', 'verb'=>'POST'),
        		array('user/registration', 'pattern'=>'user/registration', 'verb'=>'POST'),
        		array('user/delete', 'pattern'=>'user/delete', 'verb'=>'DELETE'),
        		array('user/update', 'pattern'=>'user/update', 'verb'=>'PUT'),
                // REST patterns for messages
                array('message/create', 'pattern'=>'message/create', 'verb'=>'POST'),
                array('message/user', 'pattern'=>'message/user', 'verb'=>'GET'),
                array('message/conversations', 'pattern'=>'message/conversations', 'verb'=>'GET'),
                // REST patterns for contacts
                array('contact/create', 'pattern'=>'contact/create', 'verb'=>'POST'),
                array('contact/search', 'pattern'=>'contact/search', 'verb'=>'POST'),
                
                // REST patterns for groups
                array('group/create', 'pattern'=>'group/create', 'verb'=>'POST'),
                array('group/update', 'pattern'=>'group/update/<id:\d+>', 'verb'=>'PUT'),
                array('group/list', 'pattern'=>'group/list', 'verb'=>'GET'),
                array('group/delete', 'pattern'=>'group/delete/<id:\d+>', 'verb'=>'DELETE'),
                
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
    		'connectionString' => 'mysql:host=localhost;dbname=tongue_tango_dev',
    		'emulatePrepare' => true,
            'schemaCachingDuration' => 60,	
    		'username' => 'root',
    		'password' => '',
    		'charset' => 'utf8',
		),
		
		
		'errorHandler'=>array(),
        
		'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'ext.logger.CPSLiveLogRoute',
                    'levels' => 'error, warning, info, trace',
                    'maxFileSize' => '10240',
                    'logFile' => 'apicontroller',
                        //  Optional excluded category
                        'excludeCategories' => array(
                                'system.db.CDbCommand',
                        ),
                ),
            ),
        ),
	),

	
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'dmitri@vprex.com',
	),);

    $giiModule = array('class'=>'system.gii.GiiModule',
                'password'=>'pass',
                'generatorPaths' => array(
                        'ext.giix-core'
                    ),

                'ipFilters'=>array('127.0.0.1','::1'));
    /*$emailModule = array(
        'class'=>'application.extensions.email.Email',
        'delivery'=>'php', //Will use the php mailing function.
    );*/



// ADDING Gii MODULE
    $arrayModules = array();
$arrayModules['modules']['gii'] = $giiModule;
// $arrayModules['modules']['email'] = $emailModule;



return array_merge($arrayMainConfig, $arrayModules);