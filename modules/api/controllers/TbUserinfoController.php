<?php

namespace app\modules\api\controllers;

use yii\web\Controller;
use app\modules\api\models\TbUserinfo;
use yii\helpers\BaseJson;
use Yii;

class TbUserinfoController extends Controller
{
    public function actionAll()
    {
        return BaseJson::encode(TbUserinfo::find()->all());
    }

    public function actionInsert()
    {
        $username = Yii::$app->request->post('username');
        $email = Yii::$app->request->post('email');
        $homepage = md5($username).'/homepage';
        $imagedir = md5($username).'/image';
        $authkey = md5(Yii::$app->request->post('authkey'));
        $authsalt = '';

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
}
