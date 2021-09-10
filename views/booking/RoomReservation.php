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

]); ?>

<?= $form->field($reservationForm, 'date_of_departure')->widget(DateTimePicker::className(), [
    'size' => 'ms',
    'template' => '{input}',
    'pickButtonIcon' => 'glyphicon glyphicon-time',

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

<?php
$script = <<< JS
          $(document).on('click','#reservationform-arrival_date',function (e) {
                 e.preventDefault();
              
               var form =  $(e.target).parents('form')[0];
         
              getFreeRoomsForThisDay(form);
          })
          
    var getFreeRoomsForThisDay = function (form)
    {
         $.ajax({
              url: '/booking/render-free-rooms-for-this-day',
              method: "post",
              data: {data:$(form).serialize()},
              
             success: function (data) {
                  console.log(data);
             }
          });
    }
     
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);
?>
