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

/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 10/29/2017
 * Time: 2:35 PM
 */

namespace common\config\components;

use common\models\User;
use Kavenegar\KavenegarApi;
use amintado\pay\EventInterface;
use Yii;

class PayEvent implements EventInterface
{
    public static function afterPay($model)
    {
        $user=User::findOne(['id'=>$model->uid]);
        $message='حساب شما به میزان '.$model->price.' ریال شارژ شد.';
        $sms=new KavenegarApi(Yii::$app->systemCore->SMSPanelAPI);
        $sms->Send('10001000070070',$user->username,$message,null,null,$model->id);
    }

    public static function ErrorPay($model)
    {
        return null;
    }

    public static function AfterRemoval($model)
    {
        $user=User::findOne(['id'=>$model->uid]);
        $message=$model->description;
        $sms=new KavenegarApi(Yii::$app->systemCore->SMSPanelAPI);
        $sms->Send('10001000070070',$user->username,$message,null,null,$model->id);
    }
}