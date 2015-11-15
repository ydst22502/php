<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "tb_userinfo".
 *
 * @property integer $userid
 * @property string $username
 * @property string $email
 * @property string $homepage
 * @property string $imagedir
 * @property string $authkey
 * @property string $authsalt
 *
 * @property TbPost[] $tbPosts
 * @property TbReply[] $tbReplies
 */
class TbUserinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_userinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'homepage', 'imagedir', 'authkey', 'authsalt'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
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
