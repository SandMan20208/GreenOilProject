<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230304_142301_create_table_cities
 */
class m230304_142301_create_table_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('city',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(30)->notNull(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('city');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230304_142301_create_table_cities cannot be reverted.\n";

        return false;
    }
    */
}
