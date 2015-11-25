<?php

namespace app\modules\api\controllers;

use yii\web\Controller;
use app\modules\api\models\TbUserinfo;
use yii\helpers\BaseJson;
use yii\helpers\Json;
use Yii;

class UserController extends Controller
{
    /********
  *返回所有用户信息
  *******/
    public function actionAll()
    {
        $model = new TbUserinfo();

        return Json::encode($model->listAllUser());
    }

    /********
    *验证用户是否重邮箱
    *******/
    public function actionDuplicationOfEmail()
    {
        $email = Yii::$app->request->post('email');
        $model = new TbUserinfo();

        return $model->isEmailDuplication($email); //如果对一个字符串进行Json加密的话会变成""string""
    }

    /********
    *验证用户是否重名
    *******/
    public function actionDuplicationOfName()
    {
        $username = Yii::$app->request->post('username');
        $model = new TbUserinfo();

        return $model->isNameDuplication($username);
    }

    /********
    *创建新用户
    *******/
    public function actionCreate()
    {
      $username = Yii::$app->request->post('username');
      $email = Yii::$app->request->post('email');
      $authkey = Yii::$app->request->post('authkey');
      $model = new TbUserinfo();

      return Json::encode($model->insertIn($username, $email, $authkey));
    }

    /********
    *登陆并下发token（把盐和userid发给客户端存着）
    *******/
    public function actionLogin()
    {
        $email = Yii::$app->request->post('email');
        $authkey = Yii::$app->request->post('authkey');
        $model = new TbUserinfo();

        return Json::encode($model->login($email, $authkey));
    }

    /********
    *通过userid查详细userinfo
    *******/
    public function actionGetUserinfo()
    {
      $userid = Yii::$app->request->post('userid');

      $model = new TbUserinfo();
      $row = $model->find()
      ->where(['userid' => $userid])
      ->one();

      if ($row->introduction == NULL) {
        $row->introduction = "empty";
      }

      return Json::encode($row);
    }

}
