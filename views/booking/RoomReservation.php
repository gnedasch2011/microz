<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<?= $form->field($reservationForm, 'name') ?>
<?= $form->field($reservationForm, 'email') ?>
<?= DateTimePicker::widget([
    'model' => $reservationForm,
    'attribute' => 'arrival_date',
    'language' => 'es',
    'size' => 'ms',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'dd MM yyyy',
        'todayBtn' => true
    ]
]); ?>

<?= DateTimePicker::widget([
    'model' => $reservationForm,
    'attribute' => 'date_of_departure',
    'language' => 'es',
    'size' => 'ms',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'dd MM yyyy',
        'todayBtn' => true
    ]
]); ?>

<?php if ($rooms): ?>
    <?= $form->field($reservationForm, 'type_rooms')->dropDownList([
        '0' => 'Активный',
        '1' => 'Отключен',
        '2' => 'Удален'
    ]);
    ?>
<?php endif; ?>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Вход', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>