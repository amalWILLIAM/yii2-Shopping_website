<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m251001_050726_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'total_price' => $this->decimal(10,2)->notNull(),
            'status' => $this->string(50)->defaultValue('pending'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-order-user_id',
            '{{%order}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-order-user_id', '{{%order}}');
        $this->dropTable('{{%order}}');
    }
}
