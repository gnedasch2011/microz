<?php

namespace app\models\booking;

use Yii;
use yii\helpers\ArrayHelper;

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

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->date_of_departure = strtotime($this->date_of_departure);
        $this->arrival_date = strtotime($this->arrival_date);

        return true;
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

    /**
     * Вернуть типы комнат занятые на этот день
     * @param $reservationForm
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getReserveInRange($searchForm)
    {
        $res = self::find()
            ->select('type_rooms, COUNT(*) as count')
            ->where(['>=', 'date_of_departure', strtotime($searchForm->arrival_date),])
            ->andWhere(['<=', 'arrival_date', strtotime($searchForm->arrival_date),])
            ->groupBy('type_rooms')
            ->asArray()
            ->all();

        return $res;

    }

}
