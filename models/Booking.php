<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use DateTime;
use yii\db\Expression;

/**
 * Class HotelRoom
 * @package app\models
 *
 * @property integer $id
 * @property integer $hotel_room_id
 * @property string $name
 * @property string $phone
 * @property string $date_from
 * @property string $date_to
 * @property DateTime $created_at
 * @property DateTime $updated_at
 *
 * @property HotelRoom $hotelRoom
 */
class Booking extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
                'updatedAtAttribute' => false,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_room_id', 'phone', 'date_from'], 'required'],
            [['name', 'phone'], 'string', 'max' => 255],
            [['date_from', 'date_to'], 'safe'],
            [
                'hotel_room_id',
                'exist',
                'targetClass' => HotelRoom::class,
                'targetAttribute' => ['hotel_room_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Имя'),
            'phone' => Yii::t('app', 'Телефон'),
            'date_from' => Yii::t('app', 'С даты'),
            'date_to' => Yii::t('app', 'По дату'),
            'created_at' => Yii::t('app', 'Время бронирования'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelRoom()
    {
        return $this->hasOne(HotelRoom::class, ['id' => 'hotel_room_id']);
    }
}