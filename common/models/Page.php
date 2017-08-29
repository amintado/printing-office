<?php

namespace common\models;

use Yii;
use \common\models\base\Page as BaseTabanPage;

/**
 * This is the model class for table "taban_page".
 */
class Page extends BaseTabanPage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id'], 'required'],
            [['id', 'uid', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['css', 'html', 'js', 'meta'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
