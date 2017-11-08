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

/**
 * This is the base model class for table "{{%product_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property integer $product_model
 * @property string $picture
 * @property integer $parent
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;
    const MODEL_CHAPI=1;
    const MODEL_SHOP=2;

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            ''
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','status','product_model'], 'required'],
            [['id', 'status', 'product_model','parent'], 'integer'],
            [['description'], 'string'],
            [['name', 'picture'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_category}}';
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'name' => 'نام دسته',
            'description' => 'توضیحات',
            'status' => 'وضعیت',
            'product_model' => 'نوع محصول',
            'picture' => 'تصاویر',
            'parent'=>'دسته ی والد'
        ];
    }
}
