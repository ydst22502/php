<?php

namespace app\models;

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
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_post';
    }

    public function save($runValidation = true, $attributeNames = NULL)
    {
        $this->userid = Yii::$app->user->id;
        $this->ip = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Shanghai');
        $this->posttime = date('Y-m-d H:i:s');
        return parent::save($runValidation, $attributeNames);
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
            [['title', 'ip', 'tag'], 'string', 'max' => 255],
            [['content', 'title'], 'required'],
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
            'title' => '标题',
            'ip' => 'Ip',
            'posttime' => 'Posttime',
            'content' => '正文',
            'tag' => '标签',
            'username' => '用户名',
        ];
    }

    public function getUsername()
    {
        return User::findIdentity($this->userid)->username;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userid' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbReplies()
    {
        return $this->hasMany(TbReply::className(), ['postid' => 'postid']);
    }
}
