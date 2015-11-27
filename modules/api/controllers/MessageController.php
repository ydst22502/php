<?php

namespace app\modules\api\controllers;

use app\modules\api\models\TbPost;
use app\modules\api\models\TbUserinfo;
use app\modules\api\models\TbMessage;
use yii\helpers\Json;
use Yii;

class MessageController extends \yii\web\Controller
{
  public function actionAllTo()
  {
    $userid = Yii::$app->request->post('userid');
    $model = new TbMessage();
    $rows = $model->find()->Where(['receiverid'=>$userid])->orderBy('timestamp DESC')->all();

    return Json::encode($rows);
  }

  public function actionInsert()
  {
    $model = new TbMessage();
    $user = new TbUserinfo();

    $model->senderid = Yii::$app->request->post('senderid');
    $model->receiverid = Yii::$app->request->post('receiverid');
    $model->timestamp = date('Y-m-d H:i:s');
    $model->state = 0;
    $model->content = Yii::$app->request->post('content');
    $model->senderusername = $user->findOne($model->senderid)->username;

    if ($model->save()>0) {
      return '1';
    }else{
      return '-1';
    }
  }
}
