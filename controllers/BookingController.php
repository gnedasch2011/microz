<?php


namespace app\controllers;


use app\models\booking\Reservation;
use app\models\booking\ReservationForm;
use app\models\booking\SearchForm;
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

    public function actionRoomSearch()
    {

        $searchForm = new SearchForm();

        if ($searchForm->load(\Yii::$app->request->post()) && $searchForm->validate()) {
            $this->redirect(['/booking/room-reserve',
                'searchForm' => $searchForm
            ]);
        }

        return $this->render('/booking/search', [
            'searchForm' => $searchForm,

        ]);
    }


    public function actionRoomReserve()
    {
        $reservationForm = new ReservationForm();
        $reservationForm->attributes = (\Yii::$app->request->get('searchForm'));

        if ($reservationForm->load(\Yii::$app->request->post()) && $reservationForm->validate()) {
            
            $newReserv = Reservation::createReservation($reservationForm);

           return $this->render('/booking/successReserve', [
                'newReserv' => $newReserv,
            ]);
        }

        $freeRooms = Rooms::getFreeRoomsInTheRange($reservationForm);
        $htmlForSelect = Rooms::generateHtmlForSelect($reservationForm);

        return $this->render('/booking/reservation', [
            'reservationForm' => $reservationForm,
            'freeRooms' => $freeRooms ?? false,
            'htmlForSelect' => $htmlForSelect ?? false,
        ]);
    }


}