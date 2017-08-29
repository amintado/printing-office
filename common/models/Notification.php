<?php

namespace common\models;

use Yii;
use \common\models\base\Notification as BaseTabanNotification;

/**
 * This is the model class for table "taban_notification".
 */
class Notification extends BaseTabanNotification
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['resiverID', 'module', 'type'], 'required'],
            [['resiverID', 'visited', 'uid', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['description'], 'string'],
            [['time', 'created_at', 'updated_at'], 'safe'],
            [['module', 'type'], 'string', 'max' => 50],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
