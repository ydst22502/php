<?php

namespace app\modules\api\controllers;

use yii\web\Controller;
use app\modules\api\models\TbUserinfo;
use yii\helpers\BaseJson;
use Yii;

class TbUserinfoController extends Controller
{
  /********
  *返回所有用户信息
  *******/
    public function actionAll()
    {
        return BaseJson::encode(TbUserinfo::find()->all());
    }

    /********
    *验证用户是否重名或重邮箱
    *******/
    public function actionDuplicationOfName()
    {
      $username = Yii::$app->request->post('username');
      $email = Yii::$app->request->post('email');

      $count_username=TbUserinfo::find()->andWhere(['username' => $username])->count('userid');
      $count_email=TbUserinfo::find()->andWhere(['email' => $email])->count('userid');

      if ($count_username==0&&$count_email==0) {
        return '1';//没有重名或注册过的邮箱
      }else{
        return '-1';//有重名或注册过的邮箱
      }
    }

    /********
    *创建新用户
    *******/
    public function actionInsert()
    {
        $username = Yii::$app->request->post('username');
        $email = Yii::$app->request->post('email');
        $homepage = md5($username).'/homepage';
        $imagedir = md5($username).'/image';
        $authsalt = (string)rand(1, 19920920);
        $authkey = md5(md5(Yii::$app->request->post('authkey')).$authsalt);

        $userinfo = new TbUserinfo();
        $userinfo->username = $username;
        $userinfo->email = $email;
        $userinfo->homepage = $homepage;
        $userinfo->imagedir = $imagedir;
        $userinfo->authkey = $authkey;
        $userinfo->authsalt = $authsalt;
        if ($userinfo->save() > 0) {
            return '1';//添加成功
        } else {
            return '-1';//添加失败
        }
      }

      /********
      *登陆并下发token（把盐和userid发给客户端存着）
      *******/
      public function actionLogin()
      {
        $email = Yii::$app->request->post('email');
        $client_authkey = Yii::$app->request->post('authkey');
        $query = TbUserinfo::find()->where(['email' => $email])->one();
        if ($query == NULL) return BaseJson::encode(['flag'=>'-1', 'userid'=>'-1', 'token'=>'-1']);
        if ($query->authkey == md5(md5($client_authkey).$query->authsalt)) {
          return BaseJson::encode(['flag'=>'1', 'userid'=>$query->userid, 'token'=>$query->authsalt]);
        } else {
          return BaseJson::encode(['flag'=>'-1', 'userid'=>'-1', 'token'=>'-1']);
        }
      }
}
