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
        $this->addForeignKey(
            'fk-store-city_id',
            'store',
            'city_id',
            'store',
            'id',
            null,
            'CASCADE'
        );
        $this->alterColumn('user', 'phone', $this->string(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-store-city_id', 'store');
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
