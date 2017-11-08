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
 * This is the base model class for table "{{%products_properties_groups}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 */
class ProductPropertyGroups extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static $StatusList =
        [
            self::STATUS_ACTIVE => 'فعال',
            self::STATUS_INACTIVE => 'غیر فعال'
        ];

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
            [['name'], 'required'],
            [['id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_properties_groups}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'نام',
            'status' => 'وضعیت',
        ];
    }
}
