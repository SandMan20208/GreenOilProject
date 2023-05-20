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
        $transaction = Yii::$app->db->beginTransaction();
        try {
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
            $transaction->commit();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
            $transaction->rollBack();
            return false;
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->dropForeignKey('fk-request_document-document_type_id', 'request_document');
            $this->dropForeignKey('fk-request_document-request_id', 'request_document');
            $this->dropTable('request_document');
            $transaction->commit();
        } catch (\Throwable $exception) {
            $transaction->rollBack();
            echo $exception->getMessage();
            return false;
        }
        return true;
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
