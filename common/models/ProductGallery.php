<?php

namespace common\models;

use Yii;
use \common\models\base\ProductGallery as BaseTabanProductGallery;

/**
 * This is the model class for table "taban_product_gallery".
 */
class ProductGallery extends BaseTabanProductGallery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['product_id', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['url', 'img_name'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
