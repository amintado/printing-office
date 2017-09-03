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

namespace common\models;

use common\config\components\functions;
use frontend\models\SignupForm;
use const null;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use johnitvn\rbacplus\models\AuthItem;
use common\models\UserInfo;
use Exception;


/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $fullname
 * @property int    $RoleID
 * @property string $Image
 * @property string $VerificationCode
 * @property string $hash_id
 * @property  string $shamsibirthday
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    use \mootensai\relation\RelationTrait;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_MOBILE_VERIFY_WAITING=1;
    const STATUS_SIGNUP_DATA_WAITING=2;
    protected $uid = null;

    public $birthday;
    const IsPrivate_no = 0; //خیر
    const IsPrivate_yes = 1; //بله

    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_MOBILE_VERIFY_WAITING],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED,self::STATUS_MOBILE_VERIFY_WAITING,self::STATUS_SIGNUP_DATA_WAITING]],
            ['username', 'string', 'min' => 11, 'max' => 17],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('common', 'This mobile has already been taken.')],
        ];
    }

    /**
     * this function will return select2 filter data in around the system
     * @return array
     */
    public static function statuses_select2(){
        return [
            User::STATUS_ACTIVE => Yii::t('common', 'User Active'),
            User::STATUS_DELETED => Yii::t('common', 'User Deleted')
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Generates "api" access token
     */
    public function generateAccessToken()
    {
        $this->access_token = urlencode(Yii::$app->security->generateRandomString(50) . time());
    }

    public function loginWithUsernameAndPassword($username, $password)
    {
        $user = self::findByUsername($username);

        if ($user) {
            if (Yii::$app->security->validatePassword($password, $user->password_hash)) {


                return $user;
            } else {
                return 'incorrect';
            }
        } else {

            return false;
        }

    }





    /*
     *
     *
     *
     * User Relation Ships
     *
     *
     */




    public static function EvRoles(){
        return [self::role_ev,5,8];
    }





    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('common', 'User - ID'),
            'username' => Yii::t('common', 'User - Name'),
            'fullname' => Yii::t('common', 'User - Fullname'),
            'RoleID' => Yii::t('common', 'User - Role ID'),
            'Image' => Yii::t('common', 'User - Image'),
            'auth_key' => Yii::t('common', 'User - Auth Key'),
            'access_token' => Yii::t('common', 'User - Access Token'),
            'password_hash' => Yii::t('common', 'User - Password Hash'),
            'password_reset_token' => Yii::t('common', 'User - Password Reset Token'),
            'email' => Yii::t('common', 'User - Email'),
            'mobile' => Yii::t('common', 'User - Mobile'),
            'status' => Yii::t('common', 'User - Status'),
            'LastLoginIP' => Yii::t('common', 'User - Last Login Ip'),
            'created_at' => Yii::t('common', 'User - Created At'),
            'updated_at' => Yii::t('common', 'User - Updated At'),
        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames() {
        return null;
//            $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('{{%auth_assignment}}', ['user_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole() {
        return Role::findOne(['id' => $this->RoleID]);
    }

    public function getRoleName() {
        if ($this->RoleID) {
            $role = $this->getRole();
            if ($role) {
                return $role->name;
            }
        }
        return '---';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInfo()
    {
        return $this->hasOne(UserInfo::className(), ['uid' => 'id']);
    }

    /**
     *
     */
    public function getInqueries(){
        return $this->hasMany(Inquery::className(),['id'=>'id']);
    }

    public function getNotifications(){
        return $this->hasMany(Notification::className(),['uid'=>'id']);
    }

    public function getOrderStatusLogs(){
        return $this->hasMany(OrderStatusLog::className(),['uid'=>'id']);
    }

    public function getticketHeads(){
        return $this->hasMany(TicketHead::className(),['user_id'=>'id']);
    }

    public function getTransactions(){
        return $this->hasMany(Transaction::className(),['uid'=>'id']);
    }


    public function getShamsibirthday(){
        $model=UserInfo::find()->where(['uid'=>$this->id])->one();
        if (!empty($model)){
            if (!empty($model->birthday)){
                return functions::convertdate( $model->birthday);
            }
        }
    }





    protected function UpdateUser($model, $data)
    {
        /**
         * @var $model User
         */
        //---------------- Parameters -------------------
        if (!empty($data['RoleID'])){
            $RoleID = trim($data['RoleID']);
        }
        if (!empty($data['status'])){
            $status = $data['status'];
        }
        $Email = trim($data['email']);
        $Mobile = trim($data['username']);


        //---------------- Validate -------------------
        //RoleID
        if (!empty($RoleID)) {
            $RoleModel = Role::findOne($RoleID);
            if (!empty($RoleModel)) {
                $model->RoleID = (int)$RoleID;
            } else {
                $this->Alert('error', Yii::t('backend', 'Invalid RoleID'));
            }
        }

        //Email
        if (!empty($Email)) {
            if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                $model->email = (string)$Email;
            } else {
                $this->Alert('error', Yii::t('backend', 'Invalid Email Format'));
            }
        }

        //Mobile
        if (!empty($Mobile)) {

                $Mobile = str_replace(['(', ')', ' ', '-'], '', $Mobile);


                $user=User::find()->where(['username'=>$Mobile])->one();
                if (empty($user)){
                    $model->username = (string)$Mobile;
                }else{
                    if ($model->username!==$Mobile){
                        $this->Alert('warning', Yii::t('backend', 'Duplicate Mobile'));
                    }
                }


        }

        if (!empty($status)) {
            if (!empty((int)$status)) {
                $model->status = (int)$status;
            } else {
                $this->Alert('error', Yii::t('backend', 'Invalid User Status'));
            }
        }//TODO: Image Update Code

        if ($model->validate()) {
            if ($model->save()) {
                return true;
            } else {
                $this->Alert('error', Yii::t('backend', 'Not Saved'));
                return false;
            }
        } else {
            $this->Alert('error', Yii::t('backend', 'Not Saved'));
            return false;
        }
    }


    protected function UpdateUserProfile($model, $data)
    {
        /**
         * @var $model User
         */
        //---------------- Parameters -------------------
        if (!empty($data['RoleID'])){
            $RoleID = trim($data['RoleID']);
        }
        if (!empty($data['status'])){
            $status = $data['status'];
        }
        $Email = trim($data['email']);
//        $Mobile = trim($data['mobile']);


        //---------------- Validate -------------------
        //RoleID
        if (!empty($RoleID)) {
            $RoleModel = Role::findOne($RoleID);
            if (!empty($RoleModel)) {
                $model->RoleID = (int)$RoleID;
            } else {
                $this->Alert('error', Yii::t('backend', 'Invalid RoleID'));
            }
        }

        //Email
        if (!empty($Email)) {
            if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                $model->email = (string)$Email;
            } else {
                $this->Alert('error', Yii::t('backend', 'Invalid Email Format'));
            }
        }

        //Mobile
//        if (!empty($Mobile)) {
//            if (!empty((float)$Mobile)) {
//                $model->mobile = (string)$Mobile;
//            } else {
//                $this->Alert('error', Yii::t('backend', 'Invalid Mobile Format'));
//            }
//        }

        if (!empty($status)) {
            if (!empty((int)$status)) {
                $model->status = (int)$status;
            } else {
                $this->Alert('error', Yii::t('backend', 'Invalid User Status'));
            }
        }

        if ($model->validate()) {
            if ($model->save()) {
                return true;
            } else {
                $this->Alert('error', Yii::t('backend', 'Not Saved'));
                return false;
            }
        } else {
            $this->Alert('error', Yii::t('backend', 'Not Saved'));
            return false;
        }
    }



    protected function CreateUser($data)
    {
        //---------------- Create New User -------------------
        $model=new User();
        $model->setPassword(Yii::$app->systemCore->DefaultPassword);
        $model->generateAuthKey();

        //---------------- Parameters -------------------
        if (!empty($data['RoleID'])){
            $RoleID = trim($data['RoleID']);
        }
        if (!empty($data['email'])){
            $Email = trim($data['email']);
        }
        if (!empty($data['username'])){
            $Mobile = trim($data['username']);
        }
        if (!empty($data['status'])){
            $status = $data['status'];
        }






        //---------------- Validate -------------------
        //RoleID
        if (!empty($RoleID)) {
            $RoleModel = Role::findOne($RoleID);
            if (!empty($RoleModel)) {
                $model->RoleID = (int)$RoleID;
            } else {
                $this->Alert('Invalid-RoleID', Yii::t('backend', 'Invalid RoleID'));
            }
        }

        //Email
        if (!empty($Email)) {
            if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                $model->email = (string)$Email;
            } else {
                $this->Alert('Invalid-Email', Yii::t('backend', 'Invalid Email Format'));
            }
        }

        //Mobile
        if (!empty($Mobile)) {

            $Mobile = str_replace(['(', ')', ' ', '-'], '', $Mobile);


                $user=User::find()->where(['username'=>$Mobile])->one();
                if (empty($user)){
                    $model->username = (string)$Mobile;
                }else{
                    $this->Alert('warning', Yii::t('backend', 'Duplicate Mobile'));
                }

        }

        if (!empty($status)) {
            if (!empty((int)$status)) {
                $model->status = (int)$status;
            } else {
                $this->Alert('Invalid-User-Status', Yii::t('backend', 'Invalid User Status'));
            }
        }

        if ($model->validate()) {
            if ($model->save()) {
                $model->hash_id=hash('adler32',$model->id,false);
                $model->save();
                return true;
            } else {
                $this->Alert('error', Yii::t('backend', 'Not Saved'));
                return false;
            }
        } else {
            $this->Alert('error', Yii::t('backend', 'Not Saved'));
            return false;
        }
    }

    /**
     * this function will set a flash message for show to user
     * @param $key
     * @param $text
     */
    protected function Alert($key, $text)
    {
        Yii::$app->session->addFlash($key, $text);
    }



    public function HandleUserPost($post)
    {

        //---------------- Check Posted Parameters -------------------
        if (!empty($post['User'])) {
            $post = $post['User'];
        } else {
            return;
        }

        if (!empty($post['id'])) {
            $this->uid = $post['id'];

            $user = User::findOne($this->uid);
            if (!empty($user)) {
                return $this->UpdateUser($user, $post);
            } else {
                return $this->CreateUser($post);
            }
        }else{
            return $this->CreateUser($post);
        }


    }



    public function HandleUserPostProfile($post)
    {
        //---------------- Check Posted Parameters -------------------
        if (!empty($post['User'])) {
            $post = $post['User'];
        } else {
            return;
        }

        if (!empty($post['id'])) {
            $this->uid = $post['id'];

            $user = User::findOne($this->uid);
            if (!empty($user)) {
                return $this->UpdateUserProfile($user, $post);
            } else {
                return $this->CreateUser($post);
            }
        }


    }

}
