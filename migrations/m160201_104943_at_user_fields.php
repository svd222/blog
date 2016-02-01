<?php

use yii\db\Schema;
use yii\db\Migration;

class m160201_104943_at_user_fields extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'name', Schema::TYPE_STRING.'(14) NULL');
        $this->addColumn('{{%user}}', 'surname', Schema::TYPE_STRING.'(14) NULL');
        $this->addColumn('{{%user}}', 'skype', Schema::TYPE_STRING.'(14) NULL');
        $this->addColumn('{{%user}}', 'ref_link', Schema::TYPE_STRING.'(14) NOT NULL');
        $this->addColumn('{{%user}}', 'inviter_user_id', Schema::TYPE_INTEGER.'(11) NOT NULL DEFAULT 0');
        $this->addColumn('{{%user}}', 'last_visit_date', Schema::TYPE_STRING.'(11) NOT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'name');
        $this->dropColumn('{{%user}}', 'surname');
        $this->dropColumn('{{%user}}', 'skype');
        $this->dropColumn('{{%user}}', 'ref_link');
        $this->dropColumn('{{%user}}', 'inviter_user_id');
        $this->dropColumn('{{%user}}', 'last_visit_date');
    }
}
