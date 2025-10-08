<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart_item}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%cart}}`
 * - `{{%product}}`
 */
class m251007_090605_create_cart_item_table extends Migration{
    public function safeUp()
    {
        $this->createTable('{{%cart_item}}', [
            'id' => $this->primaryKey(),
            'cart_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // add unique key (cart_id + product_id)
        $this->createIndex(
            'idx-cart_item-unique',
            '{{%cart_item}}',
            ['cart_id', 'product_id'],
            true
        );

        // add foreign key for table `cart`
        $this->addForeignKey(
            'fk-cart_item-cart_id',
            '{{%cart_item}}',
            'cart_id',
            '{{%cart}}',
            'id',
            'CASCADE'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-cart_item-product_id',
            '{{%cart_item}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        // drops foreign keys
        $this->dropForeignKey('fk-cart_item-cart_id', '{{%cart_item}}');
        $this->dropForeignKey('fk-cart_item-product_id', '{{%cart_item}}');

        // drops index
        $this->dropIndex('idx-cart_item-unique', '{{%cart_item}}');

        // drops table
        $this->dropTable('{{%cart_item}}');
    }
}
