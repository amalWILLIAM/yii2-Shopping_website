<?php

use yii\db\Migration;

class m251001_034702_add_role_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{user}}','role', $this->string()->defaultValue('user'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{user}}','role');
        echo "m251001_034702_add_role_to_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251001_034702_add_role_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
