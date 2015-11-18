<?php

namespace app\modules\api\models;

/**
 * This is the model class for table "tb_post".
 *
 * @property int $postid
 * @property int $userid
 * @property string $title
 * @property string $ip
 * @property string $posttime
 * @property string $content
 * @property string $tag
 * @property TbUserinfo $user
 * @property TbReply[] $tbReplies
 */
class TbPost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_post';
    }

    public function insertIn($userid, $title, $ip, $posttime, $content, $tag)
    {
        $this->userid = $userid;
        $this->title = $title;
        $this->ip = $ip;
        $this->posttime = $posttime;
        $this->content = $content;
        $this->tag = $tag;

        if ($this->save() > 0 ) {
          return $this->postid;
        }else {
          return '-1';
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid'], 'integer'],
            [['posttime'], 'safe'],
            [['content'], 'string'],
            [['title', 'ip', 'tag'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
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
