<?php

use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\HotelRoom;

/**
 * @var ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Список номеров');
?>
<h1><?= $this->title ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'number',
        'name',
        'description',
        [
            'class' => ActionColumn::class,
            'header' => Yii::t('app', 'Действия'),
            'buttons' => [
                'booking' => function ($url, HotelRoom $model, $key) {
                    if ($model->isFree()) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-lock"></span>',
                            Url::to(['/room/booking', 'id' => $model->id]),
                            ['title' => Yii::t('app', 'Забронировать')]
                        );
                    }
                },
            ],
            'template' => '{booking}',
        ],
    ],

]) ?>
