<?php

namespace common\models;

use Yii;
use \common\models\base\ProductPropertyStep as BaseTabanProductPropertyStep;

/**
 * This is the model class for table "taban_product_property_step".
 */
class ProductPropertyStep extends BaseTabanProductPropertyStep
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['product_property', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
