<?php

namespace app\modules\api\models;

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
class TbReply extends \yii\db\ActiveRecord
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
            [['postid', 'userid'], 'integer'],
            [['content'], 'string'],
            [['replytime'], 'safe'],
            [['ip'], 'string', 'max' => 255]
        ];
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
            'content' => 'Content',
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
