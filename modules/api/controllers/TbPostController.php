<?php

namespace app\modules\api\controllers;

use app\modules\api\models\TbPost;
use app\modules\api\models\TbUserinfo;
use yii\helpers\BaseJson;
use Yii;

class TbPostController extends \yii\web\Controller
{
  /********
  *返回所有post信息
  *******/
  public function actionAll()
  {
    return BaseJson::encode(TbPost::find()->all());
  }

  /********
  *插入新post
  *******/
  public function actionPost()
  {
    $token = Yii::$app->request->post('token');
    $userid = Yii::$app->request->post('userid');
    $title = Yii::$app->request->post('title');
    $ip = Yii::$app->request->userIP;
    $posttime = date("Y-m-d H:i:s");
    $content = Yii::$app->request->post('content');
    $tag = Yii::$app->request->post('tag');

    $query = TbUserinfo::find()->where(['userid' => $userid])->one();
    if ($token != $query->authsalt) {
      return '-1';//认证失败
    }else {
      $post = new TbPost;
      $post->userid = $userid;
      $post->title = $title;
      $post->ip = $ip;
      $post->posttime = $posttime;
      $post->content = $content;
      $post->tag = $tag;

      if ($post->save() > 0) {
          return '1';//post成功
      } else {
          return '-1';//post失败
      }
    }
  }
}
