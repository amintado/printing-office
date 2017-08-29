<?php

namespace common\models;

use Yii;
use \common\models\base\LogUsers as BaseTabanLogUsers;

/**
 * This is the model class for table "taban_log_users".
 */
class LogUsers extends BaseTabanLogUsers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['source_id', 'dest_id', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['dest_id', 'module', 'type', 'description', 'date'], 'required'],
            [['description'], 'string'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['module', 'type'], 'string', 'max' => 50],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
