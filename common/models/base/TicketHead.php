<?php
/*******************************************************************************
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 ******************************************************************************/

namespace common\models\base;

use common\models\traits\GlobalTrait;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%taban_ticket_head}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $department
 * @property string $topic
 * @property string $status
 * @property string $date_update
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property string $deleted_by
 * @property string $restored_by
 * @property string $hash_id
 *
 * @property \common\models\TicketBody[] $tabanTicketBodies
 * @property \common\models\TabanUsers $user
 */
class TicketHead extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;
    use GlobalTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    const TOPIC_ACCOUNTING=1;
    const TOPIC_TECHNICAL=2;

    const STATUS_WAITING=1;
    const STATUS_ANSWERED=2;
    const STATUS_USER_ANSWER=3;
    const STATUS_CLOSE=4;

    public static function departments(){
        return
            [
                self::TOPIC_TECHNICAL=> Yii::t('common', 'Ticket Department-'.self::TOPIC_TECHNICAL),
                self::TOPIC_ACCOUNTING=> Yii::t('common', 'Ticket Department-'.self::TOPIC_ACCOUNTING),
            ];
    }

    public function __construct(){
        parent::__construct();
        $this->_rt_softdelete = [
            'deleted_by' => \Yii::$app->user->id,
            'restored_by' => \Yii::$app->user->id,
        ];
        $this->_rt_softrestore = [
            'deleted_by' => 0,
            'restored_by' => date('Y-m-d H:i:s'),
        ];
    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'tabanTicketBodies',
            'user'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'status', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['date_update', 'created_at', 'updated_at'], 'safe'],
            [['department', 'topic'], 'string', 'max' => 255],
            ['hash_id','string','max'=>32]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ticket_head}}';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'user_id' => Yii::t('common', 'User ID'),
            'department' => Yii::t('common', 'Department'),
            'topic' => Yii::t('common', 'Topic'),
            'status' => Yii::t('common', 'Status'),
            'date_update' => Yii::t('common', 'Date Update'),
            'restored_by' => Yii::t('common', 'Restored By'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabanTicketBodies()
    {
        return $this->hasMany(\common\models\TicketBody::className(), ['id_head' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\TabanUsers::className(), ['id' => 'user_id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }



}
