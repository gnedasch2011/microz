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

    public static function checkFreeRoomsType($reservationForm): bool
    {    
        $freeRooms = self::getFreeRoomsInTheRange($reservationForm);

        if ($freeRooms[$reservationForm->type_rooms] > 0) {
            return true;
        }

        return false;
    }

    public static function generateHtmlForSelect($searchForm)
    {

        $freeRoom = self::getFreeRoomsInTheRange($searchForm);

        foreach ($freeRoom as $typeRoom => $count) {
            $html[$typeRoom] = Rooms::returnName($typeRoom) . ' (' . $count . ' свободных номера)';
        }

        return $html;


    }

    public static function getFreeRoomsInTheRange($searchForm)
    {
        $rooms = ArrayHelper::map(self::find()->all(), 'id', 'count_rooms');
        
        $roomsReservation = Reservation::getReserveInRange($searchForm);

        $roomsFree = $rooms;

        if ($roomsReservation) {
            foreach ($roomsReservation as $roomsReserv) {
                $rooomsReservationOut[$roomsReserv['type_rooms']] = $roomsReserv['count'];
            }

            foreach ($rooms as $typeRoom => $countRoom) {
                $count = 0;

                if (isset($rooomsReservationOut[$typeRoom])) {
                    $count = $rooms[$typeRoom] - $rooomsReservationOut[$typeRoom];

                    $roomsFree[$typeRoom] = $count;
                } else {
                    continue;
                }

            }

        }

        return $roomsFree;
    }


}
