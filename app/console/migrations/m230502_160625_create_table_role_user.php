<?php

use yii\db\Migration;

/**
 * Class m230502_160625_create_table_role_user
 */
class m230502_160625_create_table_role_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
//            $this->createTable('role_user', [
//                'id' => $this->primaryKey(),
//                'role_id' => $this->integer(),
//                'user_id' => $this->integer()
//            ]);

            $this->addForeignKey(
                'fk-role_user-role_id',
                'role_user',
                'role_id',
                'role',
                'id',
                'CASCADE',
                'CASCADE'
            );

            $this->addForeignKey(
                'fk-role_user-user_id',
                'role_user',
                'user_id',
                'user',
                'id',
                'CASCADE',
                'CASCADE'
            );
            $transaction->commit();
        } catch (\Throwable $exception) {
            $transaction->rollBack();
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
            $this->dropForeignKey('fk-role_user-role_id', 'role_user');
            $this->dropForeignKey('fk-role_user-user_id', 'role_user');
            $this->dropTable('role_user');
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
        echo "m230502_160625_create_table_role_user cannot be reverted.\n";

        return false;
    }
    */
}
