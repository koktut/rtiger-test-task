<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * Class HotelRoom
 * @package app\models
 *
 * @property integer $id
 * @property integer $number
 * @property string $name
 * @property string $description
 * @property integer $status
 */
class HotelRoom extends ActiveRecord
{
    const STATUS_FREE = 1;
    const STATUS_BOOKED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel_room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['number', 'required'],
            ['number', 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_FREE],
            ['status', 'in', 'range' => [self::STATUS_FREE, self::STATUS_BOOKED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'Номер'),
            'name' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'status' => Yii::t('app', 'Статус'),
        ];
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_FREE => Yii::t('app', 'Свободен'),
            self::STATUS_BOOKED => Yii::t('app', 'Забронирован'),
        ];
    }

    /**
     * @return bool
     */
    public function isFree()
    {
        return $this->status == self::STATUS_FREE;
    }

    /**
     * @return bool
     */
    public function isBooked()
    {
        return $this->status == self::STATUS_BOOKED;
    }
}