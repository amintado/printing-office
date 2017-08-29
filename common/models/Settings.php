<?php

namespace common\models;

use Yii;
use \common\models\base\Settings as BaseTabanSettings;

/**
 * This is the model class for table "taban_settings".
 */
class Settings extends BaseTabanSettings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['setting_key', 'setting_value'], 'required'],
            [['setting_value', 'setting_description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['setting_key'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
