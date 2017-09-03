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
 * This is the base model class for table "{{%taban_order}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $date
 * @property string $address
 * @property string $telephone
 * @property string $mobile
 * @property string $description
 * @property integer $send_method
 * @property integer $status
 * @property string $tax
 * @property string $discount
 * @property string $price
 * @property string $UUID
 * @property string $lock
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property string $deleted_by
 * @property string $restored_by
 *
 * @property \common\models\SendMethod $sendMethod
 * @property \common\models\OrderDetails[] $tabanOrderDetails
 * @property \common\models\OrderStatusLog[] $tabanOrderStatusLogs
 */
class Order extends \yii\db\ActiveRecord
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
            'sendMethod',
            'tabanOrderDetails',
            'tabanOrderStatusLogs'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'status', 'price'], 'required'],
            [['uid', 'send_method', 'status', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['tax', 'discount', 'price'], 'number'],
            [['address', 'telephone', 'mobile', 'description'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
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
            'uid' => Yii::t('common', 'Uid'),
            'date' => Yii::t('common', 'Date'),
            'address' => Yii::t('common', 'Address'),
            'telephone' => Yii::t('common', 'Telephone'),
            'mobile' => Yii::t('common', 'Mobile'),
            'description' => Yii::t('common', 'Description'),
            'send_method' => Yii::t('common', 'Send Method'),
            'status' => Yii::t('common', 'Status'),
            'tax' => Yii::t('common', 'Tax'),
            'discount' => Yii::t('common', 'Discount'),
            'price' => Yii::t('common', 'Price'),
            'UUID' => Yii::t('common', 'Uuid'),
            'lock' => Yii::t('common', 'Lock'),
            'restored_by' => Yii::t('common', 'Restored By'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSendMethod()
    {
        return $this->hasOne(\common\models\SendMethod::className(), ['id' => 'send_method']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabanOrderDetails()
    {
        return $this->hasMany(\common\models\OrderDetails::className(), ['order_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabanOrderStatusLogs()
    {
        return $this->hasMany(\common\models\OrderStatusLog::className(), ['order_id' => 'id']);
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

    /**
     * @inheritdoc
     * @return \common\models\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \common\models\OrderQuery(get_called_class());
        return $query->where(['deleted_by' => 0]);
    }
}
