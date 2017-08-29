<?php

namespace common\models;

use Yii;
use \common\models\base\Inquery as BaseInquery;

/**
 * This is the model class for table "taban_inquery".
 */
class Inquery extends BaseInquery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['uid', 'category', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['qdescription', 'adescription'], 'required'],
            [['qdate', 'adate', 'created_at', 'updated_at'], 'safe'],
            [['qdescription', 'adescription'], 'string', 'max' => 2000],
            [['qfile', 'afile'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
