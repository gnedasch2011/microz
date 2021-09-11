<?php


namespace app\models\booking;


use yii\base\Model;

class SearchForm extends Model
{
    public $arrival_date;
    public $date_of_departure;

    public function rules()
    {
        return [
            ['arrival_date', 'dataCheck'],
            ['date_of_departure', 'dataCheck'],
        ];
    }

    public function dataCheck($attribute, $params)
    {
        //не может быть раньше сегодня

        $hour = 12;
        $today              = strtotime($hour . ':00:00');
        $yesterday          = strtotime('-1 day', $today);

        if ($yesterday > strtotime($this->arrival_date)) {
            $this->addError($attribute, 'Дата не может быть раньше сегодня');
        }

        if (strtotime($this->arrival_date) > strtotime($this->date_of_departure)) {
            $this->addError($attribute, 'Поменяйте даты местами');
        }

    }

    public function attributeLabels()
    {
        return [
            'arrival_date' => 'Дата заезда',
            'date_of_departure' => 'Дата отъезда',
        ];
    }


}