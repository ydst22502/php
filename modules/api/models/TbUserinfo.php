<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "tb_userinfo".
 *
 * @property int $userid
 * @property string $username
 * @property string $email
 * @property string $homepage
 * @property string $imagedir
 * @property string $authkey
 * @property string $authsalt
 * @property TbPost[] $tbPosts
 * @property TbReply[] $tbReplies
 */
class TbUserinfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_userinfo';
    }

    public function listAllUser()
    {
        return $this->find()->all();
    }

    public function isEmailDuplication($email)
    {
        $count_email = $this->find()->andWhere(['email' => $email])->count('userid');
        if ($count_email == 0) {
            return '1';//没有重名或注册过的邮箱
        } else {
            return '-1';//有重名或注册过的邮箱
        }
    }

    public function isNameDuplication($username)
    {
        $count_username = $this->find()->andWhere(['username' => $username])->count('userid');

        if ($count_username == 0) {
            return '1';//没有重名或注册过的邮箱
        } else {
            return '-1';//有重名或注册过的邮箱
        }
    }

    public function insertIn($username, $email, $authkey)//insert似乎是个保留字
    {
        $homepage = md5($username).'/homepage';
        $imagedir = md5($username).'/image';
        $authsalt = (string) rand(1, 19920920);
        $authkey = md5(md5(Yii::$app->request->post('authkey')).$authsalt);

        $this->username = $username;
        $this->email = $email;
        $this->homepage = $homepage;
        $this->imagedir = $imagedir;
        $this->authkey = $authkey;
        $this->authsalt = $authsalt;
        if ($this->save() > 0) {
            return ['flag' => '1', 'userid' => $this->userid, 'token' => $authsalt];//添加成功
        } else {
            return ['flag' => '-1', 'userid' => '-1', 'token' => '-1'];//添加失败
        }
    }

    public function login($email, $authkey)
    {
      $query = $this->find()->where(['email' => $email])->one();
      if ($query == null) {
          return ['flag' => '-1', 'userid' => '-1', 'token' => '-1'];
      }//登录失败
      if ($query->authkey == md5(md5($authkey).$query->authsalt)) {
          return ['flag' => '1', 'userid' => $query->userid, 'token' => $query->authsalt];//登陆成功
      } else {
          return ['flag' => '-1', 'userid' => '-1', 'token' => '-1'];//登录失败
      }
    }

    /*********
    *验证token和userid是不是符合
    *******/
    public function isTokenOfThisUseridRight($userid, $token)
    {
      $query = $this->find()->where(['userid' => $userid])->one();
      if ($query->authsalt == $token) {//这里偷了个懒token同时也是salt
        return true;
      }else{
        return false;
      }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'homepage', 'imagedir', 'authkey', 'authsalt'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'username' => 'Username',
            'email' => 'Email',
            'homepage' => 'Homepage',
            'imagedir' => 'Imagedir',
            'authkey' => 'Authkey',
            'authsalt' => 'Authsalt',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPosts()
    {
        return $this->hasMany(TbPost::className(), ['userid' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbReplies()
    {
        return $this->hasMany(TbReply::className(), ['userid' => 'userid']);
    }
}
