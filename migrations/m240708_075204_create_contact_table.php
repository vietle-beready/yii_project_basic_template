<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact}}`.
 */
class m240708_075204_create_contact_table extends Migration
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
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'subject' => $this->string()->notNull(),
            'body' => $this->text()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            '{{%fk-contact-user_id}}',
            '{{%contact}}',
            'userId',
            '{{%user_contact}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contact}}');
    }
}
