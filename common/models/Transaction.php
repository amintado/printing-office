<?php

namespace common\models;

use Yii;
use \common\models\base\Transaction as BaseTabanTransaction;

/**
 * This is the model class for table "taban_transaction".
 */
class Transaction extends BaseTabanTransaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['uid', 'invoice', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['price'], 'number'],
            [['description'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
