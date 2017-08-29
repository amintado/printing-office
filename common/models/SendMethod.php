<?php

namespace common\models;

use Yii;
use \common\models\base\SendMethod as BaseTabanSendMethod;

/**
 * This is the model class for table "taban_send_method".
 */
class SendMethod extends BaseTabanSendMethod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['price'], 'number'],
            [['status', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
