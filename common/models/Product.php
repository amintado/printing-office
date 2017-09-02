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

namespace common\models;

use Yii;
use \common\models\base\Product as BaseTabanProduct;

/**
 * This is the model class for table "taban_product".
 */
class Product extends BaseTabanProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['description','specification','technical_specification'], 'string'],
            [['lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
