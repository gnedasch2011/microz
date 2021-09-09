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
            ['email', 'email'],
            ['arrival_date', 'string'],
            ['date_of_departure', 'string'],
            ['type_rooms', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
        ];
    }
}