<?php


namespace app\models\booking;


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
            [['name', 'email','arrival_date', 'date_of_departure' ], 'required','message' => 'Заполните пожалуйста'],
            ['email', 'email'],
            ['arrival_date', 'dataCheck'],
            ['date_of_departure', 'dataCheck'],
            ['type_rooms', 'checkFreeRooms'],
        ];
    }

    public function dataCheck($attribute, $params)
    {
        if (strtotime($this->arrival_date) > strtotime($this->date_of_departure)) {

            $this->addError($attribute, 'Такого не может быть!');
        }

    }

    public function checkFreeRooms($attribute, $params)
    {
        if (!Rooms::checkFreeRooms($this->type_rooms)) {
            $this->addError($attribute, 'Свободных номеров нет');
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