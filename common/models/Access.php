<?php

namespace common\models;

/**
 * This is the model class for table "{{%access}}".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $page_id
 */
class Access extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%access}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'page_id'], 'required'],
            [['role_id', 'page_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'page_id' => 'Page ID',
        ];
    }
}
