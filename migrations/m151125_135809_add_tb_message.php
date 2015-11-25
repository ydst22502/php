<?php

use yii\db\Schema;
use yii\db\Migration;

class m151125_135809_add_tb_message extends Migration
{
    public function up()
    {
        $this->createTable(
            'tb_message',
            [
                'messageid' => 'pk',
                'senderid' => 'int',
                'receiverid' => 'int',
                'timestamp' => 'datetime',
                'state' => 'int',
            ],
            'ENGINE=InnoDB'
        );
        $this->addForeignKey('message_sender_id', 'tb_message', 'senderid', 'tb_userinfo', 'userid');
        $this->addForeignKey('message_receiver_id', 'tb_message', 'receiverid', 'tb_userinfo', 'userid');
    }

    public function down()
    {
        $this->dropForeignKey('message_sender_id', 'tb_message');
        $this->dropForeignKey('message_receiver_id', 'tb_message');
        echo "m151125_135809_add_tb_message successfully reverted.\n";

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
