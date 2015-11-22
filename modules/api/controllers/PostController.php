<?php

namespace app\modules\api\controllers;

use app\modules\api\models\TbPost;
use app\modules\api\models\TbUserinfo;
use yii\helpers\Json;
use Yii;

class PostController extends \yii\web\Controller
{
    /********
  *返回所有post信息
  *******/
  public function actionAll()
  {
      return Json::encode(TbPost::find()->all());
  }

  /*******
  *返回特定条件
  ********/
  public function actionAskByOffsetAndLimit()
  {
      $limit = Yii::$app->request->post('limit');
      $offset = Yii::$app->request->post('offset');
      $model = new TbPost();
      $rows = $model->find()
      ->orderBy('posttime DESC')
      ->offset($offset)
      ->limit($limit)
      ->all();

      return Json::encode($rows);
  }

  public function actionAskByPostid()
  {
    $postid = Yii::$app->request->post('postid');
    $model = new TbPost();
    $row = $model->find()
    ->where(['postid'=>$postid])
    ->one();

    return Json::encode($row);
  }

  /********
  *插入新post
  *********/
  public function actionPost()
  {
      $token = Yii::$app->request->post('token');
      $userid = Yii::$app->request->post('userid');
      $title = Yii::$app->request->post('title');
      $ip = Yii::$app->request->userIP;
      $posttime = date('Y-m-d H:i:s');
      $content = Yii::$app->request->post('content');
      $tag = Yii::$app->request->post('tag');

      $model_user = new TbUserinfo();
      $model_post = new TbPost();

      if ($model_user->isTokenOfThisUseridRight($userid, $token)) {
          return($model_post->insertIn($userid, $title, $ip, $posttime, $content, $tag));
      } else {
          return '-1';
      }
  }
}
