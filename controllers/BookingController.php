<?php


namespace app\controllers;


use app\models\booking\Reservation;
use app\models\booking\ReservationForm;
use app\models\booking\Rooms;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class BookingController extends Controller
{

    public function beforeAction($action)
    {
        if ($action->id == 'room-reservation') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionRoomReservation()
    {
        $this->enableCsrfValidation = false;
        $reservationForm = new ReservationForm();


        $rooms = ArrayHelper::map(Rooms::find()->all(), 'id', 'count_rooms');

        $roomsReservation = Reservation::find()
            ->select('type_rooms, COUNT(*) as count')
            ->groupBy('type_rooms')
            ->asArray()
            ->all();


        $rooomsResOut = [];
        $roomsFree = [];


        if ($roomsReservation) {
            //пе
            foreach ($roomsReservation as $roomsReserv) {
                $rooomsReservationOut[$roomsReserv['type_rooms']] = $roomsReserv['count'];
            }

            foreach ($rooms as $typeRoom => $countRoom) {
                $count = 0;

               $count = $rooms[$typeRoom] - $rooomsReservationOut[$typeRoom];
                $roomsFree[$typeRoom] = Rooms::returnName($typeRoom) . '(' . $count . ' свободных номера)';
            }
        }

        if ($reservationForm->load(\Yii::$app->request->post()) && $reservationForm->validate()) {
            //Заполняем массив свободных комнат

        }

        return $this->render('/booking/RoomReservation', [
            'reservationForm' => $reservationForm,
            'roomsFree' => $roomsFree ?? false,

        ]);
    }

    public function actionSearch()
    {

    }


}