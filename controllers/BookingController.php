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
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionRoomReservation()
    {

        $reservationForm = new ReservationForm();

        if ($reservationForm->load(\Yii::$app->request->post()) && $reservationForm->validate()) {

            //Выводим сколько есть свободных на эту дату
            // и дальше уже форму


            $freeRooms = Rooms::getFreeRoomsInTheRange($reservationForm);
            //Reservation::createReservation($reservationForm);
        }

        //Посчитать сколько на сегодняшний день
        // $htmlForSelect = Rooms::generateHtmlForSelect();

        return $this->render('/booking/RoomReservation', [
            'reservationForm' => $reservationForm,
            'freeRooms' => $freeRooms ?? false,

        ]);
    }



    /**
     * render-free-rooms-for-this-day
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionRenderFreeRoomsForThisDay()
    {
        $reservationForm = new ReservationForm();

        if ($reservationForm->load(\Yii::$app->request->post()) && $reservationForm->validate()) {
            echo "<pre>";
            print_r(Reservation::getReserveInRange());
            die();
            $reserveInRange = Reservation::getReserveInRange($reservationForm);

            //Надо собрать все резервы в предлагаемом диапазоне
            // и отнять от начального списка, то есть начало заезда
            //не должно попасть в диапазон


        } else {
            echo "<pre>";
            print_r($reservationForm->errors);
            die();
        }

    }


}