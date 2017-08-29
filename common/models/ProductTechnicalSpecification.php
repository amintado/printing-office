<?php

namespace common\models;

use Yii;
use \common\models\base\ProductTechnicalSpecification as BaseTabanProductTechnicalSpecification;

/**
 * This is the model class for table "taban_product_technical_specification".
 */
class ProductTechnicalSpecification extends BaseTabanProductTechnicalSpecification
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['product_id', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['texhnical_specifications'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
