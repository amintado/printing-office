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

/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 8/27/2017
 * Time: 6:36 PM
 */

namespace common\config\components;


use yii\base\Component;

class systemCoreSettings extends Component
{
public $nationCodeLength='10';
public $googleMapAPI_key='';
public $KavehNegarSMSAPI_key='';
public $companyName='';
public $SMSPanelAPI='';
    /**
     * @var bool
     * if this attribute equal TRUE, then system will not sent any SMS request CURL
     */
public $SmsDebug=false;
    /**
     * @var string
     * default password that use for sig up and login users with sms
     */
public $DefaultPassword='123456';
    /** default login duration for users in Second
     *
     *
     * default value is 3600 * 24 * 30 = 2592000 second
     * @var int
     */
public $LoginDuration=2592000;
}