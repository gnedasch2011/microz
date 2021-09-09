<?php

namespace app\models\booking;

use Yii;

/**
 * This is the model class for table "reservation".
 *
 * @property int $id
 * @property int|null $type_rooms
 * @property string|null $booking_date
 * @property string|null $arrival_date
 * @property string|null $date_of_departure
 * @property int|null $client_id
 */
class Reservation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_rooms', 'client_id'], 'integer'],
            [['booking_date', 'arrival_date', 'date_of_departure'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_rooms' => 'Type Rooms',
            'booking_date' => 'Booking Date',
            'arrival_date' => 'Arrival Date',
            'date_of_departure' => 'Date Of Departure',
            'client_id' => 'Client ID',
        ];
    }

    //todo
    //При сохранении нужен метод пересчёта по типу комнаты и не давать сохранять


}
