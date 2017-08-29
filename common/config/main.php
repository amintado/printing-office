<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language'   => 'fa-IR',
    'components' => [

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mcrypt'=>[
            'class'=>'common\config\components\mcrypt'
        ],
        'functions'=>[
            'class'=>'common\config\components\functions'
        ],
        'stat'=>[
            'class'=> 'common\config\components\stat',
        ],

        'mdetect' =>           [
            'class' => 'common\components\mdetect'
        ],
        'curl' =>           [
            'class' => 'common\config\components\curl'
        ],
        'i18n'              => [
            'translations' => [
                'common*' => [
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/config/translations',
                    'fileMap'  => [
                        'backend' => 'common.php',
                    ],
                ],

                'ticket*' => [
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/config/translations',
                    'fileMap'  => [
                        'backend' => 'ticket.php',
                    ],
                ],
                'backend*' => [
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/config/translations',
                    'fileMap'  => [
                        'backend' => 'backend.php',
                    ],
                ],
                'frontend*' => [
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/config/translations',
                    'fileMap'  => [
                        'backend' => 'frontend.php',
                    ],
                ],
                'profile*' => [
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/config/translations',
                    'fileMap'  => [
                        'backend' => 'profile.php',
                    ],
                ],

            ],
        ],

    ],
    'aliases' => require (__DIR__.'/alias.php')
];
