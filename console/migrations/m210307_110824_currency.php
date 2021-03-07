<?php

use yii\db\Migration;

/**
 * Class m210307_110824_currency
 */
class m210307_110824_currency extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),
            'NumCode' => $this->string(250)->notNull(),
            'CharCode' => $this->string(250),
            'Name' => $this->string(250),
            'Nominal' => $this->string(32),
            'Value' => $this->string(32),
            'loaded_at' => $this->dateTime(),
            'deleted' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%currency}}');
    }
}
