<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
        return 'tb_userinfo';
    }

    public function rules()
    {
        return [
            [['username', 'authkey', 'email'], 'required'],
            [['username', 'authkey', 'email', 'authsalt'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique']
        ];
    }

    public function setPassword($authkey){
        $this->authkey = Yii::$app->security->generatePasswordHash($authkey);
    }


    public static function findIdentity($userid)
    {
        return static::findOne($userid);
    }
    
    public static function findByEmail($email){
        return static::findOne(['email' => $email]);
    }
    
    public function validatePassword($authkey){
        return Yii::$app->security->validatePassword($authkey, $this->authkey);
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    public function getId()
    {
        return $this->userid;
    }
    public function getAuthKey()
    {
        return $this->authsalt;
    }
    public function validateAuthKey($authsalt)
    {
        return $this->getAuthKey() === $authsalt;
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->authsalt = Yii::$app->getSecurity()->generateRandomString();
            }
            return true;
        }
        return false;
    }

    public function attributeLabels()
    {
        return [
            'userid' => 'ID',
            'username' => '用户名',
            'email' => '邮箱',
            'homepage' =>'主页',
            'imagedir' =>'头像',
            'authkey' =>'密码',
            'authsalt' =>'hash'
        ];
    }

}
