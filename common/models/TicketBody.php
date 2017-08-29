<?php

namespace common\models;

use Yii;
use \common\models\base\TicketBody as BaseTabanTicketBody;

/**
 * This is the model class for table "taban_ticket_body".
 */
class TicketBody extends BaseTabanTicketBody
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id_head'], 'required'],
            [['id_head', 'client', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['text'], 'string'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['name_user'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
