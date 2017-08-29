<?php

namespace common\models;

use Yii;
use \common\models\base\OrderDetails as BaseTabanOrderDetails;

/**
 * This is the model class for table "taban_order_details".
 */
class OrderDetails extends BaseTabanOrderDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['price', 'total'], 'required'],
            [['price', 'total_price'], 'number'],
            [['order_id', 'lock'], 'integer'],
            [['total', 'dimensions', 'name', 'file', 'type_name'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
