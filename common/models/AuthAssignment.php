<?php

namespace common\models;

use Yii;
use \common\models\base\AuthAssignment as BaseTabanAuthAssignment;

/**
 * This is the model class for table "taban_auth_assignment".
 */
class AuthAssignment extends BaseTabanAuthAssignment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['item_name', 'user_id'], 'required'],
            [['user_id', 'created_at', 'lock'], 'integer'],
            [['item_name'], 'string', 'max' => 64]
        ]);
    }
	
}
