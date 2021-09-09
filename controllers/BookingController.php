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

        $rooomsRes = Reservation::find()
            ->select('type_rooms, COUNT(*) as count')
            ->groupBy('type_rooms')
            ->asArray()
            ->all();

        $rooomsResOut = [];

        foreach ($rooomsRes as $rooomsRe) {
            $rooomsResOut[$rooomsRe['type_rooms']] = $rooomsRe['count'];
        }

        echo "<pre>"; print_r($rooomsResOut);die();

        $roomsFree = [];

        foreach ($rooms as $typeRoom => $countRoom) {
            echo "<pre>";
            print_r($typeRoom);
            echo "<pre>";
            print_r($countRoom);
            echo "<pre>";
            print_r($rooomsRes);
            die();

        }


        echo "<pre>";
        print_r($rooomsRes);
        die();
        $roomsReservation = ArrayHelper::map(Reservation::find()->all(), 'id', 'type_rooms');

        echo "<pre>";
        print_r($roomsReservation);
        die();

        if ($reservationForm->load(\Yii::$app->request->post()) && $reservationForm->validate()) {
            //Заполняем массив свободных комнат


            echo "<pre>";
            print_r($rooms);
            die();
            ////
            ///type/count
            ///
            ///


            echo "<pre>";
            print_r($reservationForm);
            die();
        }

        return $this->render('/booking/RoomReservation', [
            'reservationForm' => $reservationForm,
            'rooms' => $rooms ?? false,

        ]);
    }

    public function actionSearch()
    {

    }


}