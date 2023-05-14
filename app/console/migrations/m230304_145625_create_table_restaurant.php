<?php

use yii\db\Migration;

/**
 * Class m230304_145625_create_table_restaurant
 */
class m230304_145625_create_table_restaurant extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('restaurant',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(100),
                'city_id' => $this->integer(4),
                'address' => $this->string(150),
                'contact_phone' => $this->string(12),
            ]
        );

        $this->addForeignKey(
            'fk-restaurant-city_id',
            'restaurant',
            'city_id',
            'city',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-restaurant-city_id',
            'restaurant'
        );

        $this->dropTable('restaurant');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230304_145625_create_table_restaurant cannot be reverted.\n";

        return false;
    }
    */
}
