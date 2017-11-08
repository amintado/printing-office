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
 * Class FixedDimensions
 * @package common\models\base\product\dimensions
 * @property double $price
 * @property double $fixed_height
 * @property double $fixed_width
 * @property boolean $invisible_dimensions
 */
class FixedDimensions extends Model
{
    public function rules()
    {
        return
        [
          [['price','fixed_height','fixed_width'],'double'],
            [['invisible_dimensions'],'boolean']
        ];
    }

    public function attributeLabels()
    {
        return
        [
            'price'=>'قیمت',
            'fixed_height'=>'طول ثابت',
            'fixed_width'=>'عرض ثابت',
            'invisible_dimensions'=>'عدم نمایش ابعاد(انتخاب به صورت پیشفرض برای کاربر)',
        ];
    }
}