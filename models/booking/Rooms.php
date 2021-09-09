<?php

namespace app\models\booking;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property int $id
 * @property string|null $type_name
 * @property int|null $count_rooms
 */
class Rooms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rooms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count_rooms'], 'integer'],
            [['type_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_name' => 'Type Name',
            'count_rooms' => 'Count Rooms',
        ];
    }
}
