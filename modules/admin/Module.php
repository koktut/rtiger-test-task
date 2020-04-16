<?php

namespace app\modules\admin;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

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