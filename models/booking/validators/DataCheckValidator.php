<?php

namespace app\models\booking\validators;

use yii\validators\Validator;

class DataCheckValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $hour = 12;
        $today = strtotime($hour . ':00:00');
        $yesterday = strtotime('-1 day', $today);

        if ($yesterday > strtotime($model->arrival_date)) {
            //не может быть раньше сегодня
            $model->addError($attribute, 'Дата не может быть раньше сегодня');
        }

        if (strtotime($model->arrival_date) > strtotime($model->date_of_departure)) {
            $model->addError($attribute, 'Поменяйте даты местами');
        }
    }

}
