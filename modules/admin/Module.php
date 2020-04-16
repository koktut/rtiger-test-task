<?php

namespace app\modules\admin;

use Yii;
use yii\filters\AccessControl;

/**
 * Class Module
 * @package app\modules\admin
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->configureUrlManager();
    }

    /**
     * Настройка компонента UrlManager.
     */
    protected function configureUrlManager()
    {
        Yii::$app->getUrlManager()->addRules([
            '/admin/rooms' => 'admin/room/index',
            '/admin/rooms/booking' => 'admin/room/booking',
        ]);
    }
}