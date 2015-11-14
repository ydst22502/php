<?php

/* 
 * @Developed by Dajun Luo
 * @All copyrights reserved
 */

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'prod');

// register Composer autoloader
require(__DIR__ . '/../vendor/autoload.php');

// include Yii class file
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

// load application configuration
$config = require(__DIR__ . '/../config/web.php');

ini_set('display_errors', false);

// create, configure and run application
(new yii\web\Application($config))->run();
