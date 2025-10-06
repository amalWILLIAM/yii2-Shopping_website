<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_item}}`.
 */
class m251001_050820_create_order_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'price' => $this->decimal(10,2)->notNull(),
        ]);

        $this->addForeignKey(
            'fk-order_item-order_id',
            '{{%order_item}}',
            'order_id',
            '{{%order}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-order_item-product_id',
            '{{%order_item}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-order_item-order_id', '{{%order_item}}');
        $this->dropForeignKey('fk-order_item-product_id', '{{%order_item}}');
        $this->dropTable('{{%order_item}}');
    }
}
