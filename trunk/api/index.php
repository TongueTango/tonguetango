<?php

//|
//|  BRIAN:  Implement a poor mans debugging test
$DataLog = print_r($_REQUEST, 1);
file_put_contents("/tmp/tango.log.txt", $DataLog, FILE_APPEND);

// change the following paths if necessary
$yii    = dirname(__FILE__).'/framework/yii.php';
$config = dirname(__FILE__).'/protected/config/main.php';

define('APPPATH', realpath('protected').DIRECTORY_SEPARATOR);

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',5);

require_once($yii);
Yii::createWebApplication($config)->run();
