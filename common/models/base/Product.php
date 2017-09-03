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

use common\models\behaviors\DeletedBehavior;
use common\models\behaviors\HashBehavior;
use common\models\traits\GlobalTrait;
use mysqli;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%taban_product}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $specification
 * @property string $technical_specification
 * @property string $UUID
 * @property string $lock
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property string $deleted_by
 * @property string $restored_by
 * @property string $hash_id
 * @property integer $status
 *
 *
 *
 * @property string $statusText
 *
 * @property \common\models\ProductGallery[] $productGalleries
 * @property \common\models\ProductStepProperty[] $productStepProperties
 */
class Product extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    use GlobalTrait;

    const STATUS_ACTIVR = 1;
    const STATUS_INACTIVE = 0;

    private $_rt_softdelete;
    private $_rt_softrestore;
    public $images = [];

    public function __construct()
    {
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
            'productGalleries',
            'productStepProperties',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'specification', 'technical_specification'], 'string'],
            [['lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],


            [['status'],'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['hash_id'], 'string', 'max' => 30],
            [['description', 'title'], 'required'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock()
    {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'title' => Yii::t('backend', 'Product Title'),
            'description' => Yii::t('backend', 'Description'),
            'UUID' => Yii::t('backend', 'Uuid'),
            'lock' => Yii::t('backend', 'Lock'),
            'restored_by' => Yii::t('backend', 'Restored By'),
            'specification' => Yii::t('backend', 'Product Specification'),
            'technical_specification' => Yii::t('backend', 'Product Technical Specification'),
            'status' => Yii::t('backend', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductGalleries()
    {
        return $this->hasMany(\common\models\ProductGallery::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSpecifications()
    {
        return $this->hasMany(\common\models\ProductSpecifications::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductStepProperties()
    {
        return $this->hasMany(\common\models\ProductStepProperty::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTechnicalSpecifications()
    {
        return $this->hasMany(\common\models\ProductTechnicalSpecification::className(), ['product_id' => 'id']);
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
            'deleted' => [
                'class' => DeletedBehavior::className(),
                'deleted_by' => 'deleted_by',
                'value' => 0
            ],

        ];
    }



    /**
     * @inheritdoc
     * @return \common\models\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \common\models\ProductQuery(get_called_class());
        return $query->where(['deleted_by' => 0]);
    }





}
