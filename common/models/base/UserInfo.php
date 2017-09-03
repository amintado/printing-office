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
 * This is the base model class for table "{{%user_info}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $family
 * @property string $workname
 * @property string $state
 * @property string $city
 * @property string $tel1
 * @property string $tel2
 * @property string $tel3
 * @property string $mob1
 * @property string $mob2
 * @property string $birthday
 * @property string $website
 * @property string $nationCode
 * @property string $postalcode
 * @property string $jobcategory
 * @property string $address
 * @property string $file
 * @property string $lat
 * @property string $lng
 * @property string $charge
 * @property integer $uid
 * @property string $UUID
 * @property string $lock
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property string $deleted_by
 * @property string $restored_by
 *
 * @property \common\models\User $u
 */
class UserInfo extends \yii\db\ActiveRecord
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
            'u'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birthday', 'created_at', 'updated_at'], 'safe'],
            [['charge'], 'number'],
            [['uid', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['name', 'family', 'workname', 'state', 'city', 'tel1', 'tel2', 'tel3', 'mob1', 'mob2', 'website', 'jobcategory', 'address', 'file', 'lat', 'lng'], 'string', 'max' => 255],
            [['nationCode', 'postalcode'], 'string', 'max' => 10],
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
        return '{{%user_info}}';
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
            'name' => Yii::t('common', 'Name'),
            'family' => Yii::t('common', 'Family'),
            'workname' => Yii::t('common', 'Workname'),
            'state' => Yii::t('common', 'State'),
            'city' => Yii::t('common', 'City'),
            'tel1' => Yii::t('common', 'Tel1'),
            'tel2' => Yii::t('common', 'Tel2'),
            'tel3' => Yii::t('common', 'Tel3'),
            'mob1' => Yii::t('common', 'Mob1'),
            'mob2' => Yii::t('common', 'Mob2'),
            'birthday' => Yii::t('common', 'Birthday'),
            'website' => Yii::t('common', 'Website'),
            'nationCode' => Yii::t('common', 'Nationcode'),
            'postalcode' => Yii::t('common', 'Postalcode'),
            'jobcategory' => Yii::t('common', 'Jobcategory'),
            'address' => Yii::t('common', 'Address'),
            'file' => Yii::t('common', 'File'),
            'lat' => Yii::t('common', 'Lat'),
            'lng' => Yii::t('common', 'Lng'),
            'charge' => Yii::t('common', 'Charge'),
            'uid' => Yii::t('common', 'Uid'),
            'UUID' => Yii::t('common', 'Uuid'),
            'lock' => Yii::t('common', 'Lock'),
            'restored_by' => Yii::t('common', 'Restored By'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'uid']);
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
     * @return \common\models\UserInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \common\models\UserInfoQuery(get_called_class());
        return $query->where(['deleted_by' => 0]);
    }
}
