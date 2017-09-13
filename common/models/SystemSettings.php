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


namespace common\models;


use yii\db\ActiveRecord;

class SystemSettings extends ActiveRecord
{
    public $nationCodeLength,
        $googleMapAPI_key,
        $KavehNegarSMS_key,
        $companyName,
        $SMSPanelAPI,
        $AdminEmail;

    public function rules()
    {
        return
            [
                ['AdminEmail', 'email'],
                ['companyName', 'string', 'max' => 30],
                ['SMSPanelAPI', 'string', 'max' => 255],
                ['nationCodeLength', 'string', 'max' => 14],
                ['googleMapAPI_key', 'string', 'max' => 255],
                ['KavehNegarSMS_key', 'string', 'max' => 255],
            ];
    }


    public function validate($attributeNames = null, $clearErrors = true)
    {
        $validate = parent::validate($attributeNames, $clearErrors);

    }


}
