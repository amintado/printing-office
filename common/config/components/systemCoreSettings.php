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
 * Date: 8/27/2017
 * Time: 6:36 PM
 */

namespace common\config\components;


use yii\base\Component;

class systemCoreSettings extends Component
{
    public $nationCodeLength = '10';
    public $googleMapAPI_key = '';
    public $KavehNegarSMSAPI_key = '';
    public $companyName = '';
    public $SMSPanelAPI = '';
    public $payApi='';
    /**
     * This email Will Use In This Parts Of System::
     *
     *
     * Admin User Email In Users Table
     *
     * @var string
     */
    public $AdminEmail='amintado@gmail.com';
    /**
     * @var bool
     * if this attribute equal TRUE, then system will not sent any SMS request CURL
     */
    public $SmsDebug = false;
    /**
     * @var string
     * default password that use for sig up and login users with sms
     */
    public $DefaultPassword = '123456';
    /** default login duration for users in Second
     *
     *
     * default value is 3600 * 24 * 30 = 2592000 second
     * @var int
     */
    public $LoginDuration = 2592000;


    /**
     * @var string
     *
     * will set global download Url value for create Download Links
     *
     *
     * add url with 'http://' or 'https://'
     *
     * for example : 'http://dl.example.com' or 'http://example.com/frontend/download'
     */
    public $downloadURL = '';

    /**
     * elastic mail service for send email
     *
     * for send email with this configurations use common\config\components\functions\sendElasticEmail() method
     *
     *
     * from https://elasticemail.com/
     * @var array
     */
    public $elasticMail =
        [
            'username' => '',
            'api_key' => '',
            'from_email' => '',
            'from_name' => ''

        ];

    public $product =
        [
            'images' =>
                [
                    'maxFileCount' => 10,
                    'maxFileSize' => 25600,//25MB
                    'previewFileType' => '.jpg,.jpeg,.tif',
                    'language' => 'fa'
                ]
        ];

    public $poweredByTexts =
        [
            'profile' => '<strong> بخش مدیریت <a href="http://shahrmap.ir">سایت شهرمپ</a></strong> همه ی حقوق محفوظ است',
            'backend' => '<strong> بخش مدیریت <a href="http://shahrmap.ir">سایت شهرمپ</a></strong> همه ی حقوق محفوظ است'
        ];

    public $versions=
        [
          'profile'=>' <b>نسخه</b> 1',
          'backend'=>' <b>نسخه</b> 1',
          'frontend'=>' <b>نسخه</b> 1'
        ];
    public $wordpressUsername='wpadmin';
    public $BackendAddress= 'admin123admin';

}