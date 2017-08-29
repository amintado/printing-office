<?php

namespace common\models;

use Yii;
use \common\models\base\Menus as BaseTabanMenus;

/**
 * This is the model class for table "taban_menus".
 */
class Menus extends BaseTabanMenus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id', 'title'], 'required'],
            [['id', 'pageID', 'parent', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'link'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
