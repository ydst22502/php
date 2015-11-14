<?php

/* 
 * @Developed by Dajun Luo
 * @All copyrights reserved
 */

namespace app\assets;

use yii\web\AssetBundle;

class LayoutAsset extends AssetBundle{
	public $basePath='@webroot';
	public $baseUrl='@web';
	public $depends=[
			'yii\web\YiiAsset',
			'yii\bootstrap\BootstrapAsset',
	];
}