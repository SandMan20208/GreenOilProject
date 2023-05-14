<?php

use yii\db\Migration;

/**
 * Class m230304_151111_create_table_store_container
 */
class m230304_151111_create_table_container extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('container',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(50),
                'weight' => $this->integer(3),
                'volume' => $this->integer(3)
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('container');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230304_151111_create_table_store_container cannot be reverted.\n";

        return false;
    }
    */
}
