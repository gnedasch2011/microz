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
            'type_rooms' => 'Тип комнаты',
            'booking_date' => 'Booking Date',
            'arrival_date' => 'Arrival Date',
            'date_of_departure' => 'Date Of Departure',
            'client_id' => 'Client ID',
        ];
    }

    public static function createReservation($reservationForm)
    {

        //Создать клиента, если он есть, то вернуть id

        $newClient = Clients::createNewClient($reservationForm);

        $newReservation = new self;
        $newReservation->attributes = $reservationForm->attributes;
        $newReservation->link('client', $newClient);

        self::sendMessageAboutReserv($newClient);
    }

    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }

    public static function sendMessageAboutReserv($newClient)
    {
        \Yii::$app->mailer->compose()
            ->setFrom('bron@yandex.ru')
            ->setTo($newClient->email)
            ->setSubject('Ваша бронь')
            ->setTextBody('Ваша бронь')
            ->setHtmlBody('<b>Ваша бронь</b>')
            ->send();
    }

}
