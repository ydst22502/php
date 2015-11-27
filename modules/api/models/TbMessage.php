<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "tb_message".
 *
 * @property integer $messageid
 * @property integer $senderid
 * @property integer $receiverid
 * @property string $timestamp
 * @property integer $state
 * @property string $content
 *
 * @property TbUserinfo $receiver
 * @property TbUserinfo $sender
 */
class TbMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['senderid', 'receiverid', 'state'], 'integer'],
            [['timestamp'], 'safe'],
            [['content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'messageid' => 'Messageid',
            'senderid' => 'Senderid',
            'receiverid' => 'Receiverid',
            'timestamp' => 'Timestamp',
            'state' => 'State',
            'content' => 'Content',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(TbUserinfo::className(), ['userid' => 'receiverid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(TbUserinfo::className(), ['userid' => 'senderid']);
    }
}
