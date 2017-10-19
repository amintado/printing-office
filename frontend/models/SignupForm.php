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

namespace frontend\models;

use common\config\components\functions;
use common\models\LoginForm;
use common\models\Role;
use common\models\UserInfo;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\BadRequestHttpException;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;

    public $VerificationCode;
    //---------------- SignUp Step 2 -------------------
    public $name, $family, $id;

    const SCENARIO_GET_MOBILE = 'get_mobile';
    const SCENARIO_GET_CODE = 'get_code';
    const SCENARIO_GET_USER_DETAIL = 'get_detail';

    public function scenarios()
    {
        $S = parent::scenarios();

        $S[self::SCENARIO_GET_MOBILE] =
            [
                ['username', 'string', 'min' => 11, 'max' => 17],
                ['username', 'required'],
                ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('common', 'This mobile has already been taken.')],
            ];


        $S[self::SCENARIO_GET_CODE] =
            [
                ['VerificationCode', 'string', 'min' => 4, 'max' => 7],
                ['VerificationCode', 'required'],
            ];

        $S[self::SCENARIO_GET_USER_DETAIL] =
            [
                [['name', 'family', 'id'], 'string', 'min' => 3, 'max' => 40],
                [['name', 'family', 'id'], 'required']

            ];

        return $S;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required', 'on' => self::SCENARIO_GET_MOBILE],
            [['VerificationCode'], 'required', 'on' => self::SCENARIO_GET_CODE],
            [['name', 'family'], 'required', 'on' => self::SCENARIO_GET_USER_DETAIL],

            ['username', 'string', 'min' => 11, 'max' => 17],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('common', 'This mobile has already been taken.')],


            ['VerificationCode', 'string', 'min' => 4, 'max' => 7],
            ['VerificationCode', 'required'],


            [['name', 'family', 'id'], 'string', 'min' => 3, 'max' => 40],
            [['name', 'family', 'id'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('common', 'mobile'),
            'VerificationCode' => Yii::t('common', 'VerificationCode'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->mobile;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }

    public function GetMobile()
    {
        $this->scenario = self::SCENARIO_GET_MOBILE;
        if (!$this->validate()) {

            return null;
        }


        $mobile = $this->username;

        do {
            $token = rand(1203, 9564);
            $user = User::find()->where(['VerificationCode' => $token])->one();
        } while (!empty($user));

        $user = User::findOne(['username' => $mobile]);
        if (!empty($user)) {
            //---------------- Has Verification Code -------------------
            if (!empty($user->VerificationCode)) {
                $token=(string)$user->VerificationCode;
                $user->username;
            } else {
                //---------------- Has No Verification Code -------------------
                $user->VerificationCode = (string)$token;
                $user->username = $mobile;
                $user->updated_at = time();
            }

        } else {
            $user = new User();
            $user->VerificationCode = $token;
            $user->username = $mobile;
            $user->created_at = time();
            $user->RoleID = Role::ROLE_NORMAL_USER;
            $user->status = User::STATUS_MOBILE_VERIFY_WAITING;
        }

        if ($user->save()) {
            if (empty($user->hash_id)) {
                $user->hash_id = hash('adler32', $user->id);
                $user->save();
            }
            $info = new UserInfo();
            $info->uid = $user->id;
            $info->save();
            if (empty(Yii::$app->systemCore->SmsDebug)) {
                $url = "https://api.kavenegar.com/v1/" . Yii::$app->systemCore->SMSPanelAPI . "/verify/lookup.json?receptor=$mobile&token=$token&template=verify";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_NOBODY, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_exec($ch);
                $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                return $code == 200 ? $code : null;
            } else {
                return 200;
            }


        } else {
            return null;
        }


    }

    public function GetCode()
    {

        if (!$this->validate()) {

            return null;
        }


        $user = User::find()->where(['VerificationCode' => $this->VerificationCode])->one();

        if (!empty($user)) {

            $user->VerificationCode = null;
            if ($user->status == User::STATUS_MOBILE_VERIFY_WAITING or $user->status == User::STATUS_SIGNUP_DATA_WAITING) {
                $user->status = User::STATUS_SIGNUP_DATA_WAITING;
                $user->save();
                $this->id = $user->hash_id;
                return 'signup';
            } else {
                $user->save();
                $login = new LoginForm();
                $login->username = $user->username;
                $login->password = Yii::$app->systemCore->DefaultPassword;
                if ($login->login()) {
                    return 'login';
                }
            }


        } else {
            return null;
        }

    }

    public function GetDetail()
    {
        $this->scenario = self::SCENARIO_GET_USER_DETAIL;
        if (!$this->validate()) {
            return null;
        }
        $user = User::find()->where(['hash_id' => $this->id])->one();
        if (!empty($user)) {
            $info = UserInfo::find()->where(['uid' => $user->id])->one();
            $info->name = $this->name;
            $info->family = $this->family;
            if ($info->save()) {
                $user->status = User::STATUS_ACTIVE;
                $user->fullname = $this->name . ' ' . $this->family;

                $user->setPassword(Yii::$app->systemCore->DefaultPassword);
                $user->generateAuthKey();
                if ($user->save()){
                    $login=new LoginForm();
                    $login->username=$user->username;
                    $login->password=Yii::$app->systemCore->DefaultPassword;
                    if ($login->login()){
                        return true;
                    }
                }
            }
        }else{
            throw new BadRequestHttpException('مشکلی پیش آمده است، لطفا مجددا سعی کنید، اگر مشکل باقی بود، با مدیر سایت تماس بگیرید.');
        }
    }




}
