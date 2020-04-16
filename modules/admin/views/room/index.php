<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use app\models\HotelRoom;
use yii\helpers\ArrayHelper;

/**
 * @var ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('app', 'Справочник номеров гостиницы');
?>
<h1><?= $this->title ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'number',
        'name',
        'description',
        [
            'attribute' => 'status',
            'value' => function (HotelRoom $model) {
                return ArrayHelper::getValue(HotelRoom::getStatusList(), $model->status);
            }
        ]
    ],
]) ?>
