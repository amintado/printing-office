<?php

namespace common\models;

use Yii;
use \common\models\base\Order as BaseTabanOrder;

/**
 * This is the model class for table "taban_order".
 */
class Order extends BaseTabanOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['uid', 'status', 'price'], 'required'],
            [['uid', 'send_method', 'status', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['tax', 'discount', 'price'], 'number'],
            [['address', 'telephone', 'mobile', 'description'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
