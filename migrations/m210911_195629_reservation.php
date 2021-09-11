<?php

use yii\db\Migration;

/**
 * Class m210911_195629_reservation
 */
class m210911_195629_reservation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reservation', [
            'id' => $this->primaryKey()->notNull()->unique(),
            'type_rooms' => $this->integer(10),
            'booking_date' => $this->string(45),
            'arrival_date' => $this->string(45),
            'date_of_departure' => $this->string(45),
            'client_id' => $this->integer(10),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210911_195629_reservation cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210911_195629_reservation cannot be reverted.\n";

        return false;
    }
    */
}
