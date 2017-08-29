<?php

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
