<?php

namespace app\controllers;

use app\models\Booking;
use app\models\BookingForm;
use app\models\HotelRoom;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * Class BookingController
 * @package app\controllers
 */
class RoomController extends Controller
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
                ],
                'defaultOrder' => ['number' => SORT_ASC],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotAcceptableHttpException
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionBooking(int $id)
    {
        $hotelRoom = $this->getHotelRoom($id);

        if (!$hotelRoom->isFree()) {
            throw new NotAcceptableHttpException(Yii::t('app', 'Номер забронирован'));
        }

        $model = new BookingForm(['hotel_room_id' => $id]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Booking::getDb()->beginTransaction();
            $hotelRoom->status = HotelRoom::STATUS_BOOKED;

            if ($model->save() && $hotelRoom->save()) {
                $transaction->commit();
                Yii::$app->session->addFlash('success', Yii::t('app', 'Номер забронирован'));

                return $this->redirect(Url::to(['/rooms']));
            } else {
                $transaction->rollBack();
            }
        }

        return $this->render('booking', [
            'model' => $model,
            'hotelRoom' => $hotelRoom,
        ]);
    }

    /**
     * @param int $id
     * @return HotelRoom|null
     * @throws NotFoundHttpException
     */
    protected function getHotelRoom(int $id)
    {
        if ($hotelRoom = HotelRoom::findOne($id)) {
            return $hotelRoom;
        }

        throw new NotFoundHttpException(Yii::t('app', 'Номер не найден'));
    }
}