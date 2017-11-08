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
 * This is the base model class for table "taban_zinks".
 *
 * @property integer $id
 * @property string $name
 * @property integer $mode
 * @property integer $status
 * @property double $width
 * @property double $height
 * @property double $max_width
 * @property double $max_height
 * @property string $tag
 * @property string $description
 */
class Zink extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    const MODE_SHARE=1;//اشتراکی
    const MODE_PRIVATE=2;//اختصاصی

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static $StatusList =
        [
            self::STATUS_ACTIVE => 'فعال',
            self::STATUS_INACTIVE => 'غیر فعال'
        ];

    public static $ModeList=
        [
          self::MODE_SHARE=>'اشتراکی',
          self::MODE_PRIVATE=>'اختصاصی',
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
            [['mode', 'status'], 'integer'],
            [['width', 'height', 'max_width', 'max_height'], 'number'],
            [['name','height','width','tag','max_height','max_width','mode'],'required'],
            [['description'], 'string'],
            [['name', 'tag'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%zinks}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'نام',
            'mode' => 'نوع زینک',
            'status' => 'وضعیت',
            'width' => 'عرض',
            'height' => 'طول',
            'max_width' => 'حداکثر عرض',
            'max_height' => 'حداکثر طول',
            'tag' => 'نامک',
            'description' => 'توضیحات',
        ];
    }
}
