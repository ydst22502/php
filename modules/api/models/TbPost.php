<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "tb_post".
 *
 * @property integer $postid
 * @property integer $userid
 * @property string $title
 * @property string $ip
 * @property string $posttime
 * @property string $content
 * @property string $tag
 *
 * @property TbUserinfo $user
 * @property TbReply[] $tbReplies
 */
class TbPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'integer'],
            [['posttime'], 'safe'],
            [['content'], 'string'],
            [['title', 'ip', 'tag'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'postid' => 'Postid',
            'userid' => 'Userid',
            'title' => 'Title',
            'ip' => 'Ip',
            'posttime' => 'Posttime',
            'content' => 'Content',
            'tag' => 'Tag',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TbUserinfo::className(), ['userid' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbReplies()
    {
        return $this->hasMany(TbReply::className(), ['postid' => 'postid']);
    }
}
