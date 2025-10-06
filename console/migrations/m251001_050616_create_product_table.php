<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m251001_050616_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'price' => $this->decimal(10,2)->notNull(),
            'image' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Foreign key
        $this->addForeignKey(
            'fk-product-category_id',
            '{{%product}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    
     public function safeDown()
     {
         $this->dropForeignKey('fk-product-category_id', '{{%product}}');
         $this->dropTable('{{%product}}');
     }
}
