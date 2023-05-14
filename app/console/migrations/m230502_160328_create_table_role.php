<?php

use yii\db\Migration;

/**
 * Class m230502_160328_create_table_roles
 */
class m230502_160328_create_table_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('role', [
           'id' => $this->primaryKey(),
           'role' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('role');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230502_160328_create_table_roles cannot be reverted.\n";

        return false;
    }
    */
}
