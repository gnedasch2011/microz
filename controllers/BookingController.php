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
            Reservation::createReservation($reservationForm);
        }

        $htmlForSelect = Rooms::generateHtmlForSelect();

        return $this->render('/booking/RoomReservation', [
            'reservationForm' => $reservationForm,
            'roomsFree' => $htmlForSelect ?? false,

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

            $reserveInRange =  Reservation::getReserveInRange($reservationForm);


            echo "<pre>"; print_r($reservationForm);die();
            //Надо собрать все резервы в предлагаемом диапазоне
            // и отнять от начального списка, то есть начало заезда
            //не должно попасть в диапазон
            
            

            echo "<pre>"; print_r($reservationForm);die();
            echo "<pre>"; print_r('f');die();
        } else {
          echo "<pre>"; print_r($reservationForm->errors);die();
        }

    }


}