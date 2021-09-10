<?php

namespace app\models\booking;

use Yii;
use yii\helpers\ArrayHelper;

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


    public static function returnName($typeId)
    {
        $name = self::findOne($typeId);

        return $name['type_name'];
    }

    public static function getFreeRooms()
    {

        $rooms = ArrayHelper::map(self::find()->all(), 'id', 'count_rooms');

        $roomsReservation = Reservation::find()
            ->select('type_rooms, COUNT(*) as count')
            ->groupBy('type_rooms')
            ->asArray()
            ->all();

        $roomsFree = $rooms;

        if ($roomsReservation) {
            foreach ($roomsReservation as $roomsReserv) {
                $rooomsReservationOut[$roomsReserv['type_rooms']] = $roomsReserv['count'];
            }

            foreach ($rooms as $typeRoom => $countRoom) {
                $count = 0;

                $count = $rooms[$typeRoom] - $rooomsReservationOut[$typeRoom];

                $roomsFree[$typeRoom] = $count;
            }
        }

        return $roomsFree;
    }

    public static function checkFreeRooms($type): bool
    {
        $freeRooms = self::getFreeRooms();

        if ($freeRooms[$type] > 0) {
            return true;
        }

        return false;
    }

    public static function generateHtmlForSelect()
    {

        $freeRoom = self::getFreeRooms();

        foreach ($freeRoom as $typeRoom => $count) {
            $html[$typeRoom] = Rooms::returnName($typeRoom) . ' (' . $count . ' свободных номера)';
        }

        return $html;


    }
}
