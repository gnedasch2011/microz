<?php

use yii\db\Migration;

/**
 * Class m210908_151108_rooms
 */
class m210908_151108_rooms extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rooms', [
            'id' => $this->primaryKey()->notNull()->unique(),
            'type_name' => $this->string(45),
            'count_rooms' => $this->integer(10),
        ]);

        $this->insert('rooms', [
            'type_name' => 'Одноместный',
            'count_rooms' => '2',
        ]);

        $this->insert('rooms', [
            'type_name' => 'Двуместный',
            'count_rooms' => '4',
        ]);

        $this->insert('rooms', [
            'type_name' => 'Люкс',
            'count_rooms' => '3',
        ]);

        $this->insert('rooms', [
            'type_name' => 'Де-Люкс',
            'count_rooms' => '5',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210908_151108_rooms cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210908_151108_rooms cannot be reverted.\n";

        return false;
    }
    */
}
