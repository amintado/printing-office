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


use yii\base\Model;

/**
 * Class FixedDimensions
 * @package common\models\base\product\dimensions
 * @property int $from
 * @property int $to
 * @property double $price

 */
class Stair extends Model
{
    public $from,$to,$price;

    public function rules()
    {
        return
            [
                [['from','to'], 'integer'],
                [['price'],'double'],
                [['from','to','price'], 'required']
            ];
    }

    public function attributeLabels()
    {
        return
            [
                'price' => 'قیمت نهایی',
                'to' => 'تیراژ تا',
                'from' => 'تیراژ از',

            ];
    }
}