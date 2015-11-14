<?php

use yii\db\Migration;

class m151108_005431_init_log_table extends Migration
{
    public function up()
    {
        $this->createTable(
            'visitor',
            [
                'id' => 'pk',
                'ip' => 'string',
                'agent' => 'string',
                'url' => 'string',
                'date' => 'datetime',
            ],
            'ENGINE=InnoDB'
        );
    }

    public function down()
    {
        $this->dropTable('visitor');
        echo "m151108_005431_init_log_table reverted successfully.\n";

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
