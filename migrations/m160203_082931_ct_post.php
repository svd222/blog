<?php

use yii\db\Schema;
use yii\db\Migration;

class m160203_082931_ct_post extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'status' => $this->boolean()->notNull()->defaultValue(0),
        ]);
        
        $this->addForeignKey('fk_user_post', '{{%post}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%post}}');
        $this->dropForeignKey('fk_user_post', '{{%post}}');
    }
}
