<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_125725_add_content_to_tb_message extends Migration
{
    public function up()
    {
      $this->addColumn('tb_message', 'content', 'text');
    }

    public function down()
    {
        echo "m151126_125725_add_content_to_tb_message cannot be reverted.\n";

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
