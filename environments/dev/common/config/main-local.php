<?php
/**
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 */

return [
    'components' => [
        'systemCore' => [
            'class' => 'common\config\components\systemCoreSettings',
            'nationCodeLength' => 10,//Enter Length Of Personal NationCode In Your Country <<<>>> Set This Parameter Before Do Migration <<>> Length Of This Parameter Is 10 In Iran Country
            'googleMapAPI_key' => '',//Enter Your google map API Token Here
            'companyName' => '<a href="https://amintado.github.io/printing-office/">printing-office</a>'
        ],
        'telegram' => [
            'class' => 'common\config\components\telegram',
            'botToken' => '',//Create a new bot in telegram,then you will get new Bot Token,now enter your toke here
            'botUsername' => ''//create a new channel in telegram and add your new bot to it with admin permission, finish,new add your Bot ID here
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
