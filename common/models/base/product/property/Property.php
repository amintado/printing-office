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

namespace common\models\base\product\property;


use yii\base\Model;

/**
 * Class FixedDimensions
 * @package common\models\base\product\dimensions
 * @property string $property
 * @property string $priceMode kaheshi or afzayeshi
 * @property string $calculateMode darsadi tedadi
 */
class Property extends Model
{
    const PRICE_MODE_DROPPING='1';
    const PRICE_MODE_ADDITIVE='2';
    const CALCULATE_MODE_DARSAD='1';
    const CALCULATE_MODE_PRICE='2';
    public $from,$to,$price;

    public function rules()
    {
        return
            [
                [['property'], 'string','max'=>255],
                [['priceMode','calculateMode'],'integer']
            ];
    }

    public function attributeLabels()
    {
        return
            [
                'property' => 'ویژگی',
                'priceMode' => 'نوع محاسبه',
                'calculateMode' => 'نوع محاسبه',

            ];
    }
}