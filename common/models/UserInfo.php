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

use common\config\components\functions;
use Exception;
use Yii;
use \common\models\base\UserInfo as BaseTabanUserInfo;

/**
 * This is the model class for table "taban_user_info".
 */
class UserInfo extends BaseTabanUserInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['birthday', 'created_at', 'updated_at'], 'safe'],
            [['charge'], 'number'],
            [['uid', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['name', 'family', 'workname', 'state', 'city', 'tel1', 'tel2', 'tel3', 'mob1', 'mob2', 'website', 'jobcategory', 'address', 'file', 'lat', 'lng'], 'string', 'max' => 255],
            [['nationCode', 'postalcode'], 'string', 'max' => 10],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }

    protected function UpdateUserInfo($model, $data)
    {
        /**
         * @var $model UserInfo
         */

        //---------------- Parameters -------------------
        $Name = $data['name'];
        $Family = $data['family'];
        $Workname = $data['workname'];
        $Birthday = $data['birthday'];
        $Nationcode = $data['nationCode'];
        $Jobcategory = $data['jobcategory'];
        $State = $data['state'];
        $City = $data['city'];
        $Postalcode = $data['postalcode'];
        $Adress = $data['address'];
        $Tel1 = $data['tel1'];
        $Tel2 = $data['tel2'];
        $Tel3 = $data['tel3'];
        $Mob1 = $data['mob1'];
        $Mob2 = $data['mob2'];
        $Website = $data['website'];
        $Charge = $data['charge'];

        if (!empty($Name)) {
            $model->name = (string)$Name;
        }
        if (!empty($Family)) {
            $model->family = (string)$Family;
        }
        if (!empty($Workname)) {
            $model->workname = (string)$Workname;
        }
        if (!empty($Birthday)) {
            try {
                $model->birthday = functions::Date_to_Gregory($Birthday);
            } catch (Exception $e) {

            }
        }
        if (!empty($Nationcode)) {
            if (!empty((float)$Nationcode)) {
                if ($this->CheckNationalCode(trim((string)$Nationcode))) {
                    $model->nationCode = (string)$Nationcode;
                }
            } else {
                $this->Alert('warning', Yii::t('common', 'National Code is not valid'));
            }
        }
        if (!empty($Jobcategory)) {
            $model->jobcategory = (string)$Jobcategory;
        }
        if (!empty($State)) {
            $model->state = (string)$State;
        }
        if (!empty($City)) {
            $model->city = (string)$City;
        }
        if (!empty($Postalcode)) {
            $model->postalcode = (string)$Postalcode;
        }
        if (!empty($Adress)) {
            $model->address = (string)$Adress;
        }
        if (!empty($Tel1)) {
            $model->tel1 = (string)$Tel1;
        }
        if (!empty($Tel2)) {
            $model->tel2 = (string)$Tel2;
        }
        if (!empty($Tel3)) {
            $model->tel3 = (string)$Tel3;
        }
        if (!empty($Mob1)) {
            $model->mob1 = (string)$Mob1;
        }
        if (!empty($Mob2)) {
            $model->mob2 = (string)$Mob2;
        }
        if (!empty($Website)) {
            $model->website = (string)$Website;
        }
        if (!empty($Charge)) {
            $model->charge = (float)$Website;
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
    protected function CreateUserInfo($data)
    {
        {//---------------- Create New User Info -------------------
            $model=new UserInfo();
            $model->uid=$this->uid;
        }


        /**
         * @var $model UserInfo
         */
        //---------------- Parameters -------------------
        $Name = $data['name'];
        $Family = $data['family'];
        $Workname = $data['workname'];
        $Birthday = $data['birthday'];
        $Nationcode = $data['nationCode'];
        $Jobcategory = $data['jobcategory'];
        $State = $data['state'];
        $City = $data['city'];
        $Postalcode = $data['postalcode'];
        $Adress = $data['address'];
        $Tel1 = $data['tel1'];
        $Tel2 = $data['tel2'];
        $Tel3 = $data['tel3'];
        $Mob1 = $data['mob1'];
        $Mob2 = $data['mob2'];
        $Website = $data['website'];
        $Charge = $data['charge'];

        if (!empty($Name)) {
            $model->name = (string)$Name;
        }
        if (!empty($Family)) {
            $model->family = (string)$Family;
        }
        if (!empty($Workname)) {
            $model->workname = (string)$Workname;
        }
        if (!empty($Birthday)) {
            try {
                $model->birthday = functions::Date_to_Gregory($Birthday);
            } catch (Exception $e) {

            }
        }
        if (!empty($Nationcode)) {
            if (!empty((float)$Nationcode)) {
                if ($this->CheckNationalCode(trim((string)$Nationcode))) {
                    $model->nationCode = (string)$Nationcode;
                }
            } else {
                $this->Alert('warning', Yii::t('common', 'National Code is not valid'));
            }
        }
        if (!empty($Jobcategory)) {
            $model->jobcategory = (string)$Jobcategory;
        }
        if (!empty($State)) {
            $model->state = (string)$State;
        }
        if (!empty($City)) {
            $model->city = (string)$City;
        }
        if (!empty($Postalcode)) {
            $model->postalcode = (string)$Postalcode;
        }
        if (!empty($Adress)) {
            $model->address = (string)$Adress;
        }
        if (!empty($Tel1)) {
            $model->tel1 = (string)$Tel1;
        }
        if (!empty($Tel2)) {
            $model->tel2 = (string)$Tel2;
        }
        if (!empty($Tel3)) {
            $model->tel3 = (string)$Tel3;
        }
        if (!empty($Mob1)) {
            $model->mob1 = (string)$Mob1;
        }
        if (!empty($Mob2)) {
            $model->mob2 = (string)$Mob2;
        }
        if (!empty($Website)) {
            $model->website = (string)$Website;
        }
        if (!empty($Charge)) {
            $model->charge = (float)$Website;
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
    protected function CheckNationalCode($code)
    {
        if (strlen($code) <> 10) {
            $this->Alert('error', Yii::t('common', 'NationCode Length', ['num' => Yii::$app->systemCore->nationCodeLengh]));
            return false;

        } else {
            $codeArray = str_split($code);
            $AllEq = null;
            foreach ($codeArray as $item => $value) {
                if ($codeArray[0] <> $value) {
                    $AllEq = false;
                    break;
                } else {
                    $AllEq = true;
                }
            }
            if ($AllEq == true) {
                $this->Alert('error', Yii::t('common', 'Numbers of the national code should not be equal'));
                return false;
            }
            $j = 10;
            $sum = 0;
            for ($i = 0; $i <= 8; $i++) {
                $sum += ((int)($codeArray[$i])) * $j;
                --$j;
            }
            $divid = $sum % 11;
            if ($divid <= 2) {
                if ($codeArray[9] == $divid) {
                    return true;
                }
                $this->Alert('error', Yii::t('common', 'National Code is not valid'));
                return false;
            } else {
                $divid1 = 11 - $divid;
                if ($codeArray[9] == $divid1) {
                    return true;
                } else {
                    $this->Alert('error', Yii::t('common', 'National Code is not valid'));
                    return false;
                }
            }
        }
    }
    public function HandleUserInfoPost($post)
    {
        //---------------- Check Posted Parameters -------------------
        if (!empty($post['UserInfo'])) {
            $post = $post['UserInfo'];
        } else {
            return false;
        }
        if (!empty($this->uid)) {

            $user = UserInfo::find()->where(['uid' => $this->uid])->one();
            if (!empty($user)) {
                return $this->UpdateUserInfo($user, $post);
            } else {
                return $this->CreateUserInfo($post);
            }
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
}
