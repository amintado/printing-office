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

namespace common\models\base\product\tiraj;


use MongoDB\BSON\Decimal128;
use yii\base\Model;

/**
 * Class FixedDimensions
 * @package common\models\base\product\dimensions
 * @property int $tiraj
 * @property Decimal128 $price
 */
class Tiraj extends Model
{
    public $tiraj,$price;

    public function rules()
    {
        return
            [
                [['tiraj'], 'integer'],
                [['price'],'double'],
                [['tiraj','price'], 'required']
            ];
    }

    public function attributeLabels()
    {
        return
            [
                'price' => 'قیمت نهایی',
                'tiraj' => 'تیراژ',
            ];
    }
}