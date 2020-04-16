<?php

namespace app\modules\admin\controllers;

use app\models\Booking;
use app\models\HotelRoom;
use yii\data\ActiveDataProvider;

/**
 * Class RoomController
 * @package app\modules\admin\controllers
 */
class RoomController extends \yii\web\Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => HotelRoom::find(),
            'sort' => [
                'attributes' => [
                    'id',
                    'number',
                    'name',
                    'description',
                    'status'
                ],
                'defaultOrder' => ['number' => SORT_ASC],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string
     */
    public function actionBooking()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Booking::find(),
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC],
            ],
        ]);

        return $this->render('booking', [
            'dataProvider' => $dataProvider,
        ]);
    }
}