<?php

use yii\db\Migration;

/**
 * Class m230312_094043_create_table_request
 */
class m230312_094043_create_table_request extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->createTable('request',
                [
                    'id' => $this->primaryKey(),
                    'restaurant_id' => $this->integer()->notNull(),
                    'user_id' => $this->integer(),
                    'status_id' => $this->integer()->notNull(),
                    'date_created' => $this->integer(),
                    'planned_visit_date' => $this->dateTime(),
                    'close_date' => $this->dateTime(),
                    'deleted' => $this->integer(4),
                    'comment' => $this->string(150)
                ]
            );

            $this->addForeignKey(
                'fk-request-request_status_id',
                'request',
                'status_id',
                'request_status',
                'id',
                null,
                'CASCADE'
            );

            $this->addForeignKey(
                'fk-request-restaurant_id',
                'request',
                'restaurant_id',
                'restaurant',
                'id',
                null,
                'CASCADE'
            );

            $this->addForeignKey(
                'fk-request-user_id',
                'request',
                'user_id',
                'user',
                'id',
                'CASCADE',
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
            $this->dropForeignKey('fk-request-restaurant_id', 'request');
            $this->dropForeignKey('fk-request-user_id', 'request');
            $this->dropForeignKey('fk-request-request_status_id', 'request');
            $this->dropTable('request');
            $transaction->commit();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
            $transaction->rollBack();
            return false;
        }

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230312_094043_create_table_withdrawal cannot be reverted.\n";

        return false;
    }
    */
}
