<?php

use yii\db\Migration;

/**
 * Class m230502_153233_create_table_document_type
 */
class m230502_153233_create_table_document_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('document_type', [
           'id' => $this->primaryKey(),
           'type' => $this->string(100)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('document_type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230502_153233_create_table_document_type cannot be reverted.\n";

        return false;
    }
    */
}
