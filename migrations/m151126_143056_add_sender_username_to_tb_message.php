<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_143056_add_sender_username_to_tb_message extends Migration
{
    public function up()
    {
      $this->addColumn('tb_message', 'senderusername', 'string');
    }

    public function down()
    {
        $this->dropColumn('tb_message', 'senderusername');
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
