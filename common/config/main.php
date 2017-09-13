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
            'class'=>'amintado\base\AmintadoFunctions',
            'telegram_bot' => '@shahrmap_debug'
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
