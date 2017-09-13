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

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%taban_ticket_body}}".
 *
 * @property integer $id
 * @property integer $id_head
 * @property string $name_user
 * @property string $text
 * @property integer $client
 * @property string $date
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property string $deleted_by
 * @property string $restored_by
 *
 * @property \common\models\TicketHead $head
 * @property \common\models\TicketFile[] $tabanTicketFiles
 */
class TicketBody extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

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
            'head',
            'tabanTicketFiles'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_head'], 'required'],
            [['id_head', 'client', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['text'], 'string'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['name_user'], 'string', 'max' => 255],

        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ticket_body}}';
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
            'id_head' => Yii::t('common', 'Id Head'),
            'name_user' => Yii::t('common', 'Name User'),
            'text' => Yii::t('common', 'Text'),
            'client' => Yii::t('common', 'Client'),
            'date' => Yii::t('common', 'Date'),
            'restored_by' => Yii::t('common', 'Restored By'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHead()
    {
        return $this->hasOne(\common\models\TicketHead::className(), ['id' => 'id_head']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabanTicketFiles()
    {
        return $this->hasMany(\common\models\TicketFile::className(), ['id_body' => 'id']);
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

    /**
     * The following code shows how to apply a default condition for all queries:
     *
     * ```php
     * class Customer extends ActiveRecord
     * {
     *     public static function find()
     *     {
     *         return parent::find()->where(['deleted' => false]);
     *     }
     * }
     *
     * // Use andWhere()/orWhere() to apply the default condition
     * // SELECT FROM customer WHERE `deleted`=:deleted AND age>30
     * $customers = Customer::find()->andWhere('age>30')->all();
     *
     * // Use where() to ignore the default condition
     * // SELECT FROM customer WHERE age>30
     * $customers = Customer::find()->where('age>30')->all();
     * ```
     */


}
