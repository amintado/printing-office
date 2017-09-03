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
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "{{%taban_order_details}}".
 *
 * @property integer $id
 * @property string $price
 * @property string $total_price
 * @property string $total
 * @property string $dimensions
 * @property string $name
 * @property string $file
 * @property string $type_name
 * @property integer $order_id
 * @property string $UUID
 * @property string $lock
 *
 * @property \common\models\Order $order
 */
class OrderDetails extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'order'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'total'], 'required'],
            [['price', 'total_price'], 'number'],
            [['order_id', 'lock'], 'integer'],
            [['total', 'dimensions', 'name', 'file', 'type_name'], 'string', 'max' => 255],
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
        return '{{%order_details}}';
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
            'price' => Yii::t('common', 'Price'),
            'total_price' => Yii::t('common', 'Total Price'),
            'total' => Yii::t('common', 'Total'),
            'dimensions' => Yii::t('common', 'Dimensions'),
            'name' => Yii::t('common', 'Name'),
            'file' => Yii::t('common', 'File'),
            'type_name' => Yii::t('common', 'Type Name'),
            'order_id' => Yii::t('common', 'Order ID'),
            'UUID' => Yii::t('common', 'Uuid'),
            'lock' => Yii::t('common', 'Lock'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(\common\models\Order::className(), ['id' => 'order_id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'UUID',
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \common\models\OrderDetailsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\OrderDetailsQuery(get_called_class());
    }
}
