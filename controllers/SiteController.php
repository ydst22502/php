<?php

/* 
 * @Developed by Dajun Luo
 * @All copyrights reserved
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\Visitor;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}