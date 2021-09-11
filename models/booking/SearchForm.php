<?php


namespace app\models\booking;


use app\models\booking\validators\DataCheckValidator;
use yii\base\Model;

class SearchForm extends Model
{
    public $arrival_date;
    public $date_of_departure;

    public function rules()
    {
        return [
            ['arrival_date', DataCheckValidator::class],
            ['date_of_departure', DataCheckValidator::class],
        ];
    }

    public function attributeLabels()
    {
        return [
            'arrival_date' => 'Дата заезда',
            'date_of_departure' => 'Дата отъезда',
        ];
    }


}