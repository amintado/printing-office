<?php
/**
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 */

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "{{%user_mode_options}}".
 *
 * @property integer $id
 * @property integer $mode
 * @property string $key
 * @property string $value
 * @property string $description
 * @property integer $uid
 * @property string $created_at
 * @property string $lock
 */
class UserModeOptions extends \yii\db\ActiveRecord
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
            [['mode', 'uid', 'lock'], 'integer'],
            [['created_at'], 'safe'],
            [['key', 'value', 'description'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_mode_options}}';
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
            'id' => Yii::t('backend', 'ID'),
            'mode' => Yii::t('backend', 'Mode'),
            'key' => Yii::t('backend', 'Key'),
            'value' => Yii::t('backend', 'Value'),
            'description' => Yii::t('backend', 'Description'),
            'uid' => Yii::t('backend', 'Uid'),
            'lock' => Yii::t('backend', 'Lock'),
        ];
    }


    /**
     * @inheritdoc
     * @return \common\models\UserModeOptionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\UserModeOptionsQuery(get_called_class());
    }
}
