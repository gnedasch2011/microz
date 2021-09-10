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

        if ($reservationForm->load(\Yii::$app->request->post()) && $reservationForm->validate()) {
            Reservation::createReservation($reservationForm);
        }

        $htmlForSelect = Rooms::generateHtmlForSelect();

        return $this->render('/booking/RoomReservation', [
            'reservationForm' => $reservationForm,
            'roomsFree' => $htmlForSelect ?? false,

        ]);
    }


}