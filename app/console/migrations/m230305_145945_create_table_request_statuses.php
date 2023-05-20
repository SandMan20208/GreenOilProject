<?php

use yii\db\Migration;

/**
 * Class m230305_145945_create_request_statuses
 */
class m230305_145945_create_table_request_statuses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
            $this->createTable('request_status',
                [
                    'id' => $this->primaryKey(),
                    'status' => $this->string(25)->notNull(),
                    'status_name' => $this->string(25)->notNull(),
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('request_status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230305_145945_create_table_requests cannot be reverted.\n";

        return false;
    }
    */
}
