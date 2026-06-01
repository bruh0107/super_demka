<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%payment}}`
 */
class m260601_111613_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'payment_id' => $this->integer()->notNull(),
            'course_name' => "enum('oaip', 'owd', 'opbd') not null",
            'start_date' => $this->date()->notNull(),
            'status' => "enum('new', 'in_progress', 'completed') not null default 'new'",
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-request-user_id}}',
            '{{%request}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-request-user_id}}',
            '{{%request}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `payment_id`
        $this->createIndex(
            '{{%idx-request-payment_id}}',
            '{{%request}}',
            'payment_id'
        );

        // add foreign key for table `{{%payment}}`
        $this->addForeignKey(
            '{{%fk-request-payment_id}}',
            '{{%request}}',
            'payment_id',
            '{{%payment}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-request-user_id}}',
            '{{%request}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-request-user_id}}',
            '{{%request}}'
        );

        // drops foreign key for table `{{%payment}}`
        $this->dropForeignKey(
            '{{%fk-request-payment_id}}',
            '{{%request}}'
        );

        // drops index for column `payment_id`
        $this->dropIndex(
            '{{%idx-request-payment_id}}',
            '{{%request}}'
        );

        $this->dropTable('{{%request}}');
    }
}
