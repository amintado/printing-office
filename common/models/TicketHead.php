<?php

namespace common\models;

use Yii;
use \common\models\base\TicketHead as BaseTabanTicketHead;

/**
 * This is the model class for table "taban_ticket_head".
 */
class TicketHead extends BaseTabanTicketHead
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id'], 'required'],
            [['user_id', 'status', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['date_update', 'created_at', 'updated_at'], 'safe'],
            [['department', 'topic'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
