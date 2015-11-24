<?php

namespace app\modules\api\controllers;

use app\modules\api\models\TbReply;
use yii\helpers\Json;
use Yii;

class ReplyController extends \yii\web\Controller
{
    /********
      *返回所有此postid下的reply
      *******/
    public function actionAllOfThePostid()
    {
        $postid = Yii::$app->request->post('postid');
        $model = new TbReply();
        $count = $model->find()
        ->where(['postid' => $postid])
        ->count('replyid');

        if ($count == 0) {
          return '-1';
        }

        $rows = $model->find()
        ->where(['postid' => $postid])
        ->orderBy('replytime DESC')
        ->offset(-1)
        ->limit(-1)
        ->all();

        return Json::encode($rows);
    }

    /********
    *发送reply
    *******/
    public function actionReply()
    {
        $postid = Yii::$app->request->post('postid');
        $userid = Yii::$app->request->post('userid');
        $content = Yii::$app->request->post('content');
        $replytime = date('Y-m-d H:i:s');
        $ip = Yii::$app->request->userIP;

        $model = new TbReply();
        $model->postid = $postid;
        $model->userid = $userid;
        $model->content = $content;
        $model->replytime = $replytime;
        $model->ip = $ip;
        if ($model->save() > 0) {
            return $model->replyid;
        } else {
            return -1;
        }
    }
}
