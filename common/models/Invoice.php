<?php

namespace common\models;

use Yii;
use \common\models\base\Invoice as BaseTabanInvoice;

/**
 * This is the model class for table "taban_invoice".
 */
class Invoice extends BaseTabanInvoice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id', 'uid', 'status', 'price', 'paymentmethod'], 'required'],
            [['id', 'uid', 'status', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['date', 'paydate', 'created_at', 'updated_at'], 'safe'],
            [['price', 'discount', 'tax'], 'number'],
            [['paymentmethod', 'description', 'title', 'paycode'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
