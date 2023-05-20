<?php

use yii\db\Migration;

/**
 * Class m230502_161309_create_table_request_container
 */
class m230502_161309_create_table_request_container extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try {
            $this->createTable('request_container', [
                'id' => $this->primaryKey(),
                'request_id' => $this->integer()->notNull(),
                'container_id' => $this->integer()->notNull(),
                'container_count' => $this->integer()->notNull()
            ]);

            $this->addColumn('request_container', 'type',"ENUM('take', 'give') NOT NULL DEFAULT 'take'");

            $this->addForeignKey(
                'fk-request_container-request_id',
                'request_container',
                'request_id',
                'request',
                'id',
                null,
                'CASCADE'
            );

            $this->addForeignKey(
                'fk-request_container-container_id',
                'request_container',
                'container_id',
                'container',
                'id',
                null,
                'CASCADE'
            );
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
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
            $this->dropForeignKey('fk-request_container-request_id', 'request_container');
            $this->dropForeignKey('fk-request_container-container_id', 'request_container');
            $this->dropTable('request_container');
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
        echo "m230502_161309_create_table_request_container cannot be reverted.\n";

        return false;
    }
    */
}
