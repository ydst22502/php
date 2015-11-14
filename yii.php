#!/usr/bin/env /Applications/MAMP/bin/php
<?php

/* 
 * @Developed by Dajun Luo
 * @All copyrights reserved
 */

defined('YII_DEBUG') or define('YII_DEBUG', false);

// register Composer autoloader
require(__DIR__ . '/vendor/autoload.php');

// include Yii class file
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');

// load application configuration
$config = require(__DIR__ . '/config/console.php');

$application = new yii\console\Application($config);
$exitCode = $application->run();
exit($exitCode);
