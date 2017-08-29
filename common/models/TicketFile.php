<?php

namespace common\models;

use Yii;
use \common\models\base\TicketFile as BaseTabanTicketFile;

/**
 * This is the model class for table "taban_ticket_file".
 */
class TicketFile extends BaseTabanTicketFile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id', 'id_body', 'fileName'], 'required'],
            [['id', 'id_body', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['fileName'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
