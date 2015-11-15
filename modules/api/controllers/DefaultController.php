<?php

namespace app\modules\api\controllers;

use yii\web\Controller;
use app\modules\api\models\TbUserinfo;
use yii\helpers\BaseJson;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return BaseJson::encode(TbUserinfo::find()->all());
    }
}
