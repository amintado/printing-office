<?php
/**
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 */

namespace common\models;

use Yii;
use \common\models\base\UserModeOptions as BaseUserModeOptions;

/**
 * This is the model class for table "taban_user_mode_options".
 */
class UserModeOptions extends BaseUserModeOptions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['mode', 'uid', 'lock'], 'integer'],
            [['created_at'], 'safe'],
            [['key', 'value', 'description'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
