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
        $this->alterColumn('user', 'phone', $this->string(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
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
