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

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%role}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $RegisterTime
 * @property integer $status
 */
class Role extends \yii\db\ActiveRecord
{
    const ROLE_NORMAL_USER=1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['id', 'status'], 'integer'],
            [['description'], 'string'],
            [['RegisterTime'], 'safe'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'Role - ID'),
            'name' => Yii::t('backend', 'Role - Name'),
            'description' => Yii::t('backend', 'Role - Description'),
            'RegisterTime' => Yii::t('backend', 'Role - Register Time'),
            'status' => Yii::t('backend', 'Role - Status'),
        ];
    }
}
