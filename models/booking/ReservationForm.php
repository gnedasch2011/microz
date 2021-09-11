<?php


namespace app\models\booking;


use app\models\booking\validators\DataCheckValidator;
use yii\base\Model;

class ReservationForm extends Model
{
    public $name;
    public $email;
    public $arrival_date;
    public $date_of_departure;
    public $type_rooms;


    public function rules()
    {
        return [
            ['name', 'string'],
            ['email', 'email', 'message'=>'Введите правильный емейл'],
            [['name', 'email', 'arrival_date', 'date_of_departure'], 'required', 'message' => 'Заполните пожалуйста'],
            ['arrival_date', DataCheckValidator::class],
            ['date_of_departure', DataCheckValidator::class],
            ['type_rooms', 'checkFreeRooms'],
        ];
    }

    public function checkFreeRooms($attribute)
    {
        if (!Rooms::checkFreeRoomsType($this)) {
            $this->addError($attribute, 'Извините, данный тип номеров уже забронировали');
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'arrival_date' => 'Дата заезда',
            'date_of_departure' => 'Дата отъезда',
            'type_rooms' => 'Тип комнаты',
        ];
    }


}