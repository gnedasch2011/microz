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

<?= $form->field($reservationForm, 'arrival_date')->widget(DateTimePicker::className(), [
    'size' => 'ms',
    'template' => '{input}',
    'pickButtonIcon' => 'glyphicon glyphicon-time',

]);?>

<?= $form->field($reservationForm, 'date_of_departure')->widget(DateTimePicker::className(), [
    'size' => 'ms',
    'template' => '{input}',
    'pickButtonIcon' => 'glyphicon glyphicon-time',

]);?>


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