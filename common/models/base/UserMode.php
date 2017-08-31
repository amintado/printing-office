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
 * This is the base model class for table "{{%user_mode}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $mode_title
 * @property string $description
 * @property string $lock
 */
class UserMode extends \yii\db\ActiveRecord
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
            [['uid', 'mode_title'], 'required'],
            [['uid', 'lock'], 'integer'],
            [['mode_title'], 'string', 'max' => 10],
            [['description'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_mode}}';
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
            'uid' => Yii::t('backend', 'Uid'),
            'mode_title' => Yii::t('backend', 'Mode Title'),
            'description' => Yii::t('backend', 'Description'),
            'lock' => Yii::t('backend', 'Lock'),
        ];
    }


    /**
     * @inheritdoc
     * @return \common\models\UserModeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\UserModeQuery(get_called_class());
    }
}
