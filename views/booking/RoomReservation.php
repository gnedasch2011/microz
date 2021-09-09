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

<?php if ($roomsFree): ?>
    <?= $form->field($reservationForm, 'type_rooms')->dropDownList($roomsFree);
    ?>
<?php endif; ?>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Забронировать', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>