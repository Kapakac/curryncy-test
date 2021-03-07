<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(250)->notNull()->unique(),
            'description' => $this->string(250),
            'deleted' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions);


        $this->createIndex('idx-status_id', '{{%user}}', 'status_id');

        $this->addForeignKey(
            'fk-status_id',
            'user',
            'status_id',
            'status',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-status_id',
            'user'
        );

        $this->dropTable('{{%user}}');
        $this->dropTable('{{%status}}');
    }
}
