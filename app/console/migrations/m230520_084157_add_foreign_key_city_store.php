<?php

use yii\db\Migration;

/**
 * Class m230520_084157_add_foreign_key_city_store
 */
class m230520_084157_add_foreign_key_city_store extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('restaurant_container', [
           'id' => $this->primaryKey(),
           'container_id' => $this->integer(),
           'restaurant_id' => $this->integer(),
           'container_count' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-container-container_id',
            'restaurant_container',
            'container_id',
            'container',
            'id',
            null,
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-restaurant-container_id',
            'restaurant_container',
            'restaurant_id',
            'restaurant',
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
        $this->dropForeignKey('fk-container-container_id', 'restaurant_container');
        $this->dropForeignKey('fk-restaurant-container_id', 'restaurant_container');
        $this->dropTable('restaurant_container');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230520_084157_add_foreign_key_city_store cannot be reverted.\n";

        return false;
    }
    */
}
