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
 * This is the base model class for table "{{%storage_litography}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $telephone
 * @property string $address
 * @property string $descriptions
 */
class Litography extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


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
            [['descriptions'], 'string'],
            [['name', 'telephone', 'address'], 'string', 'max' => 255],
            [['name'],'required'],
            [['name'],'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%storage_litography}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'نام',
            'telephone' => 'تلفن',
            'address' => 'آدرس',
            'descriptions' => 'توضیحات',
        ];
    }
}
