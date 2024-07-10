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
        $this->createTable('{{%queue}}', [
            'id' => $this->primaryKey(),
            'channel' => $this->string()->notNull(),
            'job' => $this->binary()->notNull(),
            'pushed_at' => $this->integer()->notNull(),
            'ttr' => $this->integer()->notNull(),
            'delay' => $this->integer()->notNull(),
            'priority' => $this->integer()->notNull()->defaultValue(1024),
            'reserved_at' => $this->integer(),
            'attempt' => $this->integer(),
            'done_at' => $this->integer(),
        ], $tableOptions);


        // $this->createTable('{{%queue_failed}}', [
        //     'id' => $this->primaryKey(),
        //     'job_id' => $this->integer()->notNull(),
        //     'exception' => $this->text(),
        //     'error_message' => $this->text(),
        //     'failed_at' => $this->integer()->notNull(),
        //     'attempt' => $this->integer()->notNull(),
        //     'queue' => $this->string()->notNull(),
        // ], $tableOptions);

        // $this->createIndex('idx_queue_failed_job_id', '{{%queue_failed}}', 'job_id');
        // $this->createIndex('idx_queue_failed_failed_at', '{{%queue_failed}}', 'failed_at');

        $this->createIndex('channel', '{{%queue}}', 'channel');
        $this->createIndex('reserved_at', '{{%queue}}', 'reserved_at');
        $this->createIndex('priority', '{{%queue}}', 'priority');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%queue}}');
        // $this->dropTable('{{%queue_failed}}');
    }
}
