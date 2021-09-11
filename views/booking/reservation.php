<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => [
        'class' => 'form-horizontal',
    ]

]) ?>
    <a href="/booking/room-search">Вернуться к поиску</a>
<h2>Бронирование комнаты</h2>
    <p>Дата заезда: <?= $reservationForm->arrival_date ;?></p>
        <?php if($reservationForm->errors):?>
            <?= 'Ошибка ввода даты' ;?>
        <?php else:?>
        
        <?php endif;?>
    <p>Дата выезда: <?= $reservationForm->date_of_departure ;?></p>

<?= $form->field($reservationForm, 'name') ?>
<?= $form->field($reservationForm, 'email') ?>


<?php if ($freeRooms): ?>
    <?= $form->field($reservationForm, 'type_rooms')->dropDownList($htmlForSelect);
    ?>
<?php endif; ?>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Зарезервировать', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>