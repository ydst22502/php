<?php

use yii\db\Migration;

class m151114_120141_bootstrap extends Migration
{
    public function up()
    {
        $this->createTable(
            'tb_userinfo',
            [
                'userid' => 'pk',
                'username' => 'string',
                'email' => 'string',
                'homepage' => 'string',
                'imagedir' => 'string',
                'authkey' => 'string',
                'authsalt' => 'string',
            ],
            'ENGINE=InnoDB'
        );

        $this->createTable(
            'tb_reply',
            [
                'replyid' => 'pk',
                'postid' => 'int',
                'userid' => 'int',
                'content' => 'text',
                'replytime' => 'datetime',
                'ip' => 'string',
            ],
            'ENGINE=InnoDB'
        );
        $this->addForeignKey('reply_user_id', 'tb_reply', 'userid', 'tb_userinfo', 'userid');

        $this->createTable(
            'tb_post',
            [
                'postid' => 'pk',
                'userid' => 'int',
                'title' => 'string',
                'ip' => 'string',
                'posttime' => 'datetime',
                'content' => 'text',
                'tag' => 'string',
            ],
            'ENGINE=InnoDB'
        );
        $this->addForeignKey('post_user_id', 'tb_post', 'userid', 'tb_userinfo', 'userid');
        $this->addForeignKey('post_reply_id', 'tb_reply', 'postid', 'tb_post', 'postid');
    }

    public function down()
    {
        $this->dropForeignKey('reply_user_id', 'tb_reply');
        $this->dropForeignKey('post_user_id', 'tb_post');
        $this->dropForeignKey('post_reply_id', 'tb_reply');

        echo "m151114_120141_bootstrap everted successfully.\n";

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
