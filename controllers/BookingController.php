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

    public function actionRenderFreeRoomsForThisDay()
    {
        $reservationForm = new ReservationForm();

        if ($reservationForm->load(\Yii::$app->request->post()) && $reservationForm->validate()) {
            echo "<pre>"; print_r('f');die();
        } else {
          echo "<pre>"; print_r($reservationForm->errors);die();
        }

    }


}