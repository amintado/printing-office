<?php

namespace common\models;

use Yii;
use \common\models\base\ProductStepProperty as BaseTabanProductStepProperty;

/**
 * This is the model class for table "taban_product_step_property".
 */
class ProductStepProperty extends BaseTabanProductStepProperty
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['price'], 'number'],
            [['mintotal', 'requre', 'product_id', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'title', 'value'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
