<?php

use yii\db\Migration;

/**
 * Class m210902_064715_test
 */
class m210902_064715_test extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey()->notNull()->unique(),
            'title' => $this->text(),
            'desc' => $this->text(),
            'link' => $this->string(450),
            'image' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210902_064715_test cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210902_064715_test cannot be reverted.\n";

        return false;
    }
    */
}
