<?php

use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var \app\models\HotelRoom $hotelRoom
 * @var \app\models\BookingForm $model
 */
$this->title = Yii::t('app', 'Бронирование номера')
?>
<h1><?= Yii::t('app', 'Бронирование номера: {0} - {1}', [$hotelRoom->number, $hotelRoom->name]) ?></h1>

<?php $form = ActiveForm::begin([
    'id' => 'booking-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>
<?= $form->field($model, 'hotel_room_id')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'phone')->textInput() ?>
<?= $form->field($model, 'date_from')->widget(DatePicker::class, [
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
        ],
]) ?>
<?= $form->field($model, 'date_to')->widget(DatePicker::class, [
        'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
    ],
]) ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton(Yii::t('app', 'Бронировать'), ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
