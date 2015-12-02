<?php

use yii\db\Schema;
use yii\db\Migration;

class m151202_172700_tb_reply_add_username extends Migration
{
    public function up()
    {
      $this->addColumn('tb_reply', 'username', 'string');
    }

    public function down()
    {
        echo "m151202_172700_tb_reply_add_username cannot be reverted.\n";

        return false;
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
