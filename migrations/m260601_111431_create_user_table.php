<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m260601_111431_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100)->notNull()->unique(),
            'email' => $this->string(100)->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'full_name' => $this->string(100)->notNull(),
            'phone' => $this->string(50)->notNull(),
            'role' => "enum('user', 'admin') not null default 'user'",
        ]);

        $this->insert('{{%user}}', [
            'username' => 'Admin',
            'email' => 'admin@korok.net',
            'password' => md5('KorokNET'),
            'full_name' => 'Admin',
            'phone' => '8(888)888-88-88',
            'role' => 'admin',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
