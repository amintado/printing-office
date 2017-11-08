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
 * This is the base model class for table "{{%product_properties}}".
 *
 * @property integer $id
 * @property integer $mode
 * @property integer $required
 * @property integer $status
 * @property integer $group
 * @property string $name
 * @property ProductPropertyGroups $groupname
 */
class ProductProperties extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    const MODE_CHAPI = 1;
    const MODE_SHOP = 2;



    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static $ModeList =
        [
            self::MODE_CHAPI => 'محصول چاپی',
            self::MODE_SHOP => 'محصول فروشگاهی'
        ];



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
            [['mode', 'required', 'status', 'group'], 'integer'],
            [['name'],'string','max' => 255],
            [['mode', 'name', 'group'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products_properties}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mode' => 'نوع محصول',
            'required' => 'اجباری شود',
            'status' => 'وضعیت',
            'group' => 'گروه',
            'name' => 'نام',
        ];
    }


    public function getGroupname(){
        return ProductPropertyGroups::findOne(['id'=>$this->group])->name;
    }
}
