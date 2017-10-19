<?php
/*******************************************************************************
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 ******************************************************************************/

use Codeception\Module\Yii2;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-profile',

    'language' => 'fa-IR',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'profile\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview'=>[
          'class'=>'kartik\grid\Module'
        ],
        'ticket' => [
            'class' => amintado\ticket\Module::className(),
            'qq' =>
                [
                    'support' => 'بخش پشتیبانی',
                    'Technical' => 'بخش فنی'
                ]
        ],
        'inquery'=> [
            'class'=>amintado\inquery\Module::className(),

        ],
        'datecontrol'=>[
            'class'=>kartik\datecontrol\Module::className()
        ],

    ],
    'components' => [

        'view' => [
            'title' => Yii::t('profile','app-name'),
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-advanced-app'
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
        ],


        'authManager'       => [
            'class' => 'yii\rbac\DbManager',
        ],

    ],
    'params' => $params,
];
