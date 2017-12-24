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

namespace common\models\base\product\dimensions;


use yii\base\Model;


/**
 * @property boolean $perth
 * @property boolean $prevent_change_in_client
 * @property double  $base_width
 * @property double  $base_height
 * @property double  $min_height
 * @property double  $min_width
 * @property double  $max_height
 * @property double  $max_width
 * @property double  $price
 */
class variableDimensions extends Model
{
    public $perth,$prevent_change_in_client,$base_width,$base_height,$min_height,$min_width,$max_height,$max_width,$price;

    public function rules()
    {
        return
            [
                [['perth','prevent_change_in_client'],'boolean'],
                [['base_height','base_width','max_height','max_width','min_height','min_width','price'],'required'],
                [['base_width','base_height','min_height','min_width','max_height','max_width'],'double'],
                [['price'],'double']
            ];
    }


    public function attributeLabels()
    {
        return
        [
            'perth'=>'استفاده از پرتی کاغذ',
            'prevent_change_in_client'=>'جلوگیری از ثبت ابعاد توسط مشتری(پس از انتخاب این گزینه باید لیستی از ابعاد پیشفرض را وارد کنید)',
            'base_width'=>'عرض پایه',
            'base_height'=>'طول پایه',
            'min_height'=>'حداقل طول',
            'min_width'=>'حداقل عرض',
            'max_height'=>'حداکثر طول',
            'max_width'=>'حداکثر عرض',
            'price'=>'قیمت',
        ];
    }
}