<?php

use yii\db\Schema;
use yii\db\Migration;

class m151125_135800_add_introduction extends Migration
{
    public function up()
    {
        $this->addColumn('tb_userinfo', 'introduction', 'text');
    }

    public function down()
    {
        echo "m151125_135800_add_introduction cannot be reverted.\n";

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
