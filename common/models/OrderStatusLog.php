<?php

namespace common\models;

use Yii;
use \common\models\base\OrderStatusLog as BaseTabanOrderStatusLog;

/**
 * This is the model class for table "taban_order_status_log".
 */
class OrderStatusLog extends BaseTabanOrderStatusLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['status', 'uid', 'order_id', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
