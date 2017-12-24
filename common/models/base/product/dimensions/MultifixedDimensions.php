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
 * Date: 11/7/2017
 * Time: 7:32 PM
 */

namespace common\models\base\product\dimensions;


use yii\base\Model;

/**
 * Class MultifixedDimensions
 * @package common\models\base\product\dimensions
 * @property double $fixed_height
 * @property double $fixed_width
 * @property double $price
 */
class MultifixedDimensions extends Model
{
    public $fixed_height, $fixed_width,$price;
    public function rules()
{
    return
    [
        [['fixed_height','fixed_width','price'],'double'],
        [['fixed_height','fixed_width','price'],'required'],
    ];
}

public function attributeLabels()
{
    return
    [
        'fixed_height'=>'طول ثابت',
        'fixed_width'=>'عرض ثابت',
        'price'=>'قیمت',
    ];
}
}