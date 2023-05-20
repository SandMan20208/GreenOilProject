<?php

use yii\db\Migration;

/**
 * Class m230304_143638_create_table_store
 */
class m230304_143638_create_table_store extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('store',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(30)->notNull(),
                'city_id' => $this->integer()->notNull(),
            ]
        );

        $this->addForeignKey(
            'fk-store-city_id',
            'store',
            'city_id',
            'store',
            'id',
            null,
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-store-city_id', 'store');
        $this->dropTable('store');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230304_143638_create_table_store cannot be reverted.\n";

        return false;
    }
    */
}
