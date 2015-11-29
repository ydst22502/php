<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_reply".
 *
 * @property integer $replyid
 * @property integer $postid
 * @property integer $userid
 * @property string $content
 * @property string $replytime
 * @property string $ip
 *
 * @property TbPost $post
 * @property TbUserinfo $user
 */
class Reply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_reply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert) && !Yii::$app->user->isGuest) {
            date_default_timezone_set('Asia/Shanghai');
            $this->replytime = date('Y-m-d H:i:s');
            $this->ip = $_SERVER['REMOTE_ADDR'];
            $this->userid = Yii::$app->user->identity->userid;
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'replyid' => 'Replyid',
            'postid' => 'Postid',
            'userid' => 'Userid',
            'content' => '回复：',
            'replytime' => 'Replytime',
            'ip' => 'Ip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(TbPost::className(), ['postid' => 'postid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TbUserinfo::className(), ['userid' => 'userid']);
    }
}
