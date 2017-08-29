<?php

namespace common\models\base;

use johnitvn\rbacplus\models\AuthItem;
use Yii;

/**
 * This is the base model class for table "{{%auth_assignment}}".
 *
 * @property string $item_name
 * @property integer $user_id
 * @property integer $created_at
 * @property string $lock
 *
 * @property \common\models\AuthItem $itemName
 * @property \common\models\User $user
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'itemName',
            'user'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['user_id', 'created_at', 'lock'], 'integer'],
            [['item_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_assignment}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_name' => Yii::t('common', 'Item Name'),
            'user_id' => Yii::t('common', 'User ID'),
            'lock' => Yii::t('common', 'Lock'),
        ];
    }
    

        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }
    

    /**
     * @inheritdoc
     * @return \common\models\AuthAssignmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\AuthAssignmentQuery(get_called_class());
    }
}
