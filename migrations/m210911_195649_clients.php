<?php

use yii\db\Migration;

/**
 * Class m210911_195649_clients
 */
class m210911_195649_clients extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('clients', [
            'id' => $this->primaryKey()->notNull()->unique(),
            'name' => $this->string(45),
            'email' => $this->string(45),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210911_195649_clients cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210911_195649_clients cannot be reverted.\n";

        return false;
    }
    */
}
