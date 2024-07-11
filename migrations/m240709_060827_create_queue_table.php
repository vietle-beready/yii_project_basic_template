<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%queue}}`.
 */
class m240709_060827_create_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%queue_failed}}', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer()->notNull(),
            'error_message' => $this->text(),
            'created_at' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_queue_failed_job_id', '{{%queue_failed}}', 'job_id');
        $this->createIndex('idx_queue_failed_failed_at', '{{%queue_failed}}', 'created_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%queue_failed}}');
    }
}
