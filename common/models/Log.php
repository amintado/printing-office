<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property integer $id
 * @property integer $user
 * @property string $ip
 * @property string $module
 * @property string $action
 * @property integer $type
 * @property string $time
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const ok_activity = 1;
    const error_activiy = 2;
    const error_on_save_db = 3;
    const undefined_error = 4;
    const user_problems_error = 5;
    const user_bad_validation = 6;
    const error_on_find = 7;
    const error_on_send_mail = 8;

    public static function tableName()
    {
        return '{{%log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'type', 'time'], 'integer'],
            [['ip', 'module', 'action', 'type'], 'required'],
            [['ip'], 'string', 'max' => 16],
            [['module', 'action'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user' => Yii::t('app', 'User'),
            'ip' => Yii::t('app', 'Ip'),
            'module' => Yii::t('app', 'Module'),
            'action' => Yii::t('app', 'Action'),
            'type' => Yii::t('app', 'Type'),
            'time' => Yii::t('app', 'Time'),
        ];
    }
}
