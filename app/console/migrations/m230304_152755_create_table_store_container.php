<?php

use yii\db\Migration;

/**
 * Class m230304_152755_create_table_store_container
 */
class m230304_152755_create_table_store_container extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->createTable('store_container',
                [
                    'id' => $this->primaryKey(),
                    'store_id' => $this->integer(4),
                    'container_id' => $this->integer(4),
                    'count_of_full' => $this->integer(4),
                    'count_of_empty' => $this->integer(4)
                ]
            );

            $this->addForeignKey(
                'fk-store_container-store_id',
                'store_container',
                'store_id',
                'store',
                'id',
                'CASCADE',
                'CASCADE'
            );

            $this->addForeignKey(
                'fk-store_container-container_id',
                'store_container',
                'container_id',
                'container',
                'id',
                'CASCADE',
                'CASCADE'
            );
            $transaction->commit();
        } catch(\Throwable $exception) {
            $transaction->rollBack();
            echo ($exception->getMessage());
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-store_container-store_id', 'store_container');
        $this->dropForeignKey('fk-store_container-container_id', 'store_container');
        $this->dropTable('store_container');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230304_152755_create_table_store_container cannot be reverted.\n";

        return false;
    }
    */
}
