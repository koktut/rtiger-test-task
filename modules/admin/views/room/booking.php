<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/**
 * @var ActiveDataProvider $dataProvider
 */
$this->title = Yii::t('app', 'Спискок забронированных номеров');
?>
<h1><?= $this->title ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        'phone',
        'date_from',
        'date_to',
        'created_at',
    ],
]) ?>
