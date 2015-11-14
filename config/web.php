<?php

/* 
 * @Developed by Dajun Luo
 * @All copyrights reserved
 */

 return [
       'id' => 'DSL',
       'basePath' => realpath(__DIR__ . '/../'),
       'components' => [
           'request' => [
               'cookieValidationKey' => 'www.pornhub.com',
            ], 
           'urlManager' => [
               'enablePrettyUrl' => true,
               'showScriptName' => false
            ],
            'db' => require(__DIR__ . '/db.php'),
        ],
   ];