<?php

use yii\db\Migration;

/**
 * Class m230502_155103_create_table_request_document
 */
class m230502_155103_create_table_request_document extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
            $this->createTable('request_document', [
                'id' => $this->primaryKey(),
                'file_path' => $this->string(300)->notNull(),
                'document_type_id' => $this->integer()->notNull(),
                'request_id' => $this->integer()->notNull(),
            ]);

            $this->addForeignKey(
                'fk-request_document-document_type_id',
                'request_document',
                'document_type_id',
                'document_type',
                'id',
                null,
                'CASCADE'
            );

            $this->addForeignKey(
                'fk-request_document-request_id',
                'request_document',
                'request_id',
                'request',
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
            $this->dropForeignKey('fk-request_document-document_type_id', 'request_document');
            $this->dropForeignKey('fk-request_document-request_id', 'request_document');
            $this->dropTable('request_document');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230502_155103_create_table_request_document cannot be reverted.\n";

        return false;
    }
    */
}
