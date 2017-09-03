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

namespace common\config\components;
use common\models\Galleries;
use common\models\StatPlaceView;
use common\models\User;
use Exception;
use const false;
use function idate;
use function realpath;
use const SORT_DESC;
use Yii;
use yii\base\Component;
use common\config\components\jdf;
class functions extends Component {
    public static function currentUser() {
        return Yii::$app->user->identity;
    }
    public static function getdate() {
        return date('Y-m-d');
    }
    public static function getdatetime() {
        return date('Y-m-d') . ' ' . jdf::jdate('H:i:s');
    }
    public static function convertdatetime($in_datetime) {
        if ($in_datetime && $in_datetime != '0000-00-00 00:00:00') {
            $datetime = explode(' ', $in_datetime);
            return jdf::jdate('Y/m/d', strtotime($datetime[0])) . ' - ' . $datetime[1];
        }
        return '---';
    }

    /**
     * will convert all NULL value to empty string "" for android in RestFull
     * @param $array
     * @return mixed
     */
    public static function null_filter($array)
    {

        $text = serialize($array);
        return unserialize(str_replace(";N", ";s:0:\"\"", $text));
        //return str_replace(";N",";s:0:\"\"",$text);
        //return $text;
        // return $array;
    }
    public static function getfilename()
    {
        $date = date('Ymd');
        $range1 = range('a', 'z');
        shuffle($range1);
        $range2 = range(0, 9);
        shuffle($range2);
        $merge = array_merge($range1, $range2);
        shuffle($merge);

        $fileName = 'file_' . $date . '_';
        for ($i = 0; $i < 7; $i++) {
            $fileName .= $merge[$i];
        }

        return $fileName;
    }

    /**
     * created by amintado
     * will convert your gregorian date to  shamsi and then clear 00:00:00 text from it and retyrn shamsi YYYY:MM:DD
     */
    public static function Date_To_Shamsi($date)
    {
        try {
            return self::DateTime_Clear($date . ' 00:00:00');
        } catch (Exception $e) {
            return Yii::t('app', 'not_defined');
        }
    }

    /**
     * created by amintado
     * will convert your date to  gregorian
     */
    public static function Date_to_Gregory($date)
    {
        if (count(explode('/', $date)) < 3) {
            if (count(explode('-', $date)) < 3){
                return '';
            }else{
                return trim(jdf::jalali_to_gregorian(explode('-', $date)[0], explode('-', $date)[1], explode('-', $date)[2], '-') );
            }
        }
        return trim(jdf::jalali_to_gregorian(explode('/', $date)[0], explode('/', $date)[1], explode('/', $date)[2], '-') . ' 00:00:00');
    }
    /**
     * check your shansi date and clear 00:00:00 text from it and return :
     *
     * yy:mm:dd as string
     */
    public static function DateTime_Clear($date)
    {
        if ($date == '' or $date == null) {
            return '';
        }

        $datetime = explode('-', $date);

        if (count($datetime) < 3) {
            return '';

        }
        if (count(explode(' ', $datetime[2])) < 2 or count(explode(' ', $datetime[2])) < 2) {
            return '';
        }
        //echo jdf::gregorian_to_jalali($datetime[0], $datetime[1], explode(' ', $datetime[2])[0], '/') .
        //   ' ' . explode(' ', $datetime[2])[1];
        $var1 = serialize(jdf::gregorian_to_jalali($datetime[0], $datetime[1], explode(' ', $datetime[2])[0], '/') .
            ' ' . explode(' ', $datetime[2])[1]);
        $var2 = str_replace('\'', '', $var1);
        $var3 = str_replace('00:00:00', '', $var2);
        if (!($var2 === $var3)) {

            $var4 = str_replace('s:17', 's:09', $var3);
            $var5 = str_replace('s:18', 's:10', $var4);
            $var6 = str_replace('s:19', 's:11', $var5);
            $var7 = unserialize($var6);
            return str_replace('00:00:00', '', $var7);

        } else {
            return $var3 = str_replace('00:00:00', '', unserialize($var1));
        }
    }
    public static function convertdate($in_date, $type = 0) {
        if ($type === 0) {
            if ($in_date) {
                if (strlen($in_date) > 10) {
                    $datetime = explode(' ', $in_date);
                    $in_date = $datetime[0];
                }
                if ($in_date == '0000-00-00') {
                    return null;
                }
                return jdf::jdate('Y/m/d', strtotime($in_date));
            }
            return null;
        }
        elseif ($type === 1) {
            if ($in_date && $in_date != '0000-00-00') {
                if (strlen($in_date) > 10) {
                    $datetime = explode(' ', $in_date);
                    $in_date = $datetime[0];
                }
                $jdate = explode('/', $in_date);
                if (count($jdate)) {
                    return implode('-', jdf::jalali_to_gregorian($jdate[0], $jdate[1], $jdate[2]));
                }
            }
            return null;
        }
    }
    public static function datestring($in_date) {
        if ($in_date) {
            if (strlen($in_date) > 10) {
                $datetime = explode(' ', $in_date);
                $in_date = $datetime[0];
            }
            if ($in_date == '0000-00-00') {
                return null;
            }
            return jdf::jdate('l d F Y', strtotime($in_date));
        }
        return '0000-00-00';
    }
    public static function getIP() {
        return $_SERVER['REMOTE_ADDR'];
    }
    public static function setPassword($password) {
        return Yii::$app->security->generatePasswordHash($password);
    }
    public static function generateAuthKey() {
        return Yii::$app->security->generateRandomString();
    }
    public static function generatePasswordResetToken() {
        return Yii::$app->security->generateRandomString() . '_' . time();
    }
    /**
     * will return user image
     *
     * if user image not set or not find in directory
     *
     * will return default picture
     * @param $bool boolean  if this=true will return true if user picture was exist
     * @param $objectID
     * @return mixed  return boolean if $bool parameter is true and return string link if $bool parameter is false
     */
    public static function ImageReturn($objectID, $bool = false)
    {


        $user=User::find()->where(['id'=>$objectID])->asArray()->one();

            $pic = !empty($user['Image'])?$user['Image']:'';

            if (!empty($pic)) {
                try{
                    $headers=get_headers(Yii::$app->systemCore->downloadURL. '/profiles' . '/' . $pic);
                    $result =stripos($headers[0],"200 OK")?true:false;
                }catch (Exception $e){
                    $result=false;
                }

                if ($result) {
                    if ($bool == false) {

                        $return_value =Yii::$app->systemCore->downloadURL.  '/profiles' . '/'  . $pic;
                    } else {
                        $return_value = true;
                    }
                } else {
                    if ($bool == false) {
                        $return_value = Yii::$app->systemCore->downloadURL. '/profiles' . '/' . 'defualt-pic.png';
                    } else {
                        $return_value = false;
                    }
                }
            } else {
                if ($bool == false) {

                    $return_value =Yii::$app->systemCore->downloadURL. '/profiles' . '/' . 'defualt-pic.png';
                } else {
                    $return_value = false;
                }
            }


        return $return_value;

    }

    public static function sendElasticEmail($to, $subject, $from = null, $fromName = null, $body_text = null, $body_html = null, $template = null, $templateData = [])
    {
        $res = "";

        $data = "username=" . urlencode(Yii::$app->systemCore->elasticMail['username']);
        $data .= "&api_key=" . urlencode(Yii::$app->systemCore->elasticMail['api_key']);
        $data .= "&to=" . urlencode($to);
        $data .= "&subject=" . urlencode($subject);
        if ($template != null) {
            $data .= "&template=" . urlencode($template);
            foreach ($templateData as $key => $value) {
                $data .= "&merge_$key=" . urlencode($value);
            }
        } else {
            if ($from) {
                $data .= "&from=" . urlencode(Yii::$app->systemCore->elasticMail['from_email']);
            }
            if ($fromName) {
                $data .= "&from_name=" . urlencode(Yii::$app->systemCore->elasticMail['from_name']);
            }
            if ($body_html) {
                $data .= "&body_html=" . urlencode($body_html);
            }
            if ($body_text) {
                $data .= "&body_text=" . urlencode($body_text);
            }
        }
        $header = "POST /mailer/send HTTP/1.0\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($data) . "\r\n\r\n";
        $fp = fsockopen('ssl://api.elasticemail.com', 443, $errno, $errstr, 30);

        if (!$fp) {

            return false;//"ERROR. Could not open connection";
        } else {
            fputs($fp, $header . $data);
            while (!feof($fp)) {
                $res .= fread($fp, 1024);
            }
            fclose($fp);
        }


        return true;//was $res
    }

    /**
     * @param $url string Site Url That will Sent Request TO It
     * @param $upsleep int upsleep time
     *
     * will sent a curl to any server
     *
     *
     * @return array
     */
    public function CURL($url, $upsleep){
        $config=[];
        $mh = curl_multi_init();


        $curl_array = curl_init($url);
        curl_setopt($curl_array, CURLOPT_URL,$url);
        curl_setopt($curl_array,CURLOPT_RETURNTRANSFER,true);
        curl_multi_add_handle($mh, $curl_array);

        $running = NULL;
        do {
            usleep($upsleep);
            curl_multi_exec($mh, $running);
        } while ($running > 0);


        $res = curl_multi_getcontent($curl_array);



        curl_multi_remove_handle($mh, $curl_array);

        curl_multi_close($mh);

        return $res;
    }

    public  function PlaceView_IP2Llocation($ip, $place_id, $place_author){

        $db = new \IP2Location\Database(realpath(__DIR__.'/../../../dbloc/IP2LOCATION-LITE-DB11.BIN'), \IP2Location\Database::FILE_IO);

        $records = $db->lookup($ip, \IP2Location\Database::ALL);

        $Model=new StatPlaceView();

        $Model->PlaceID=$place_id;
        $Model->PlaceAuthor=$place_author;
        $Model->UID=Yii::$app->user->id;
        $Model->IP=$ip;


        if (!empty($records['latitude']) and !empty($records['longitude'])){


            $Model->lat=$records['latitude'];
            $Model->lon=$records['longitude'];

        }else{
            $Model->lat='';
            $Model->lon='';
        }

        $Model->country=!empty($records['countryName'])?$records['countryName']:'';

        $Model->city=!empty($records['cityName'])?$records['cityName']:'';

        $Model->region=!empty($records['regionName'])?$records['regionName']:'';



        $Model->save(false);
        unset($Model);

    }

    public static function telegram($text){
        Yii::$app->telegram->sendMessage(['chat_id' => '@shahrmap_debug', 'text' => $text]);
        return;
    }

}