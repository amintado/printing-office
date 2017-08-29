<?php

namespace common\config\components;

use common\models\base\UsersActionStat;
use function decrypt_string;
use const false;
use function getModuleLabel;
use const null;
use Yii;
use yii\base\Component;

/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 6/21/2017
 * Time: 11:52 AM
 */
class Stat extends Component
{
    public static function saveHome($desc = null, $lat = null, $lng = null, $device = null)
    {
        $headers = apache_request_headers();

        $model = new UsersActionStat();
        if (!empty($headers['appver'])) {
            $model->app_version = $headers['appver'];
        };
        if (!empty($headers['DModel'])) {
            $model->device_model = $headers['DModel'];
        };
        if (!empty($headers['Data'])) {
            $model->network = $headers['Data'];
        };
        if (!empty($headers['lang'])) {
            $model->lang = $headers['lang'];
            $model->device_lang =1;
        };
        if (!empty($headers['Provider'])) {
            $model->isp = $headers['Provider'];
        };
        if (!empty($headers['sdk'])) {
            $model->androidapi = $headers['sdk'];
        };
        if (!empty($headers['ssize'])) {
            $model->screen_size = $headers['ssize'];
        };
        if (!empty($headers['color'])) {
            $model->color = $headers['color'];
        };
        if (!empty($headers['cid'])) {
            $model->cid = (string)$headers['cid'];
        };
        if (!empty(Yii::$app->user->id)){
            if (Yii::$app->user->id>1){
                $model->user=(int)Yii::$app->user->id;
            }
        }
        $model->action = UsersActionStat::ACTION_OPEN_APP;
        $model->description = $desc;
        $model->lat = $lat;
        $model->lng = $lng;
        $model->device = $device;
        $model->save();

        return;
    }


    /**
     * this function will run from categoryController>places action
     * @param null $desc
     * @param null $lat
     * @param null $lng
     * @param null $gui
     */
    public static function saveCategory($results = null, $lat = null, $lng = null, $gui)
    {
        $headers = apache_request_headers();
        $model = new UsersActionStat();
        if (!empty($headers['appver'])) {
            $model->app_version = $headers['appver'];
        };
        if (!empty($headers['DModel'])) {
            $model->device_model = $headers['DModel'];
        };
        if (!empty($headers['Data'])) {
            $model->network = $headers['Data'];
        };
        if (!empty($headers['lang'])) {
            $model->lang = $headers['lang'];
            $model->device_lang = $headers['lang'];
        };
        if (!empty($headers['Provider'])) {
            $model->isp = $headers['Provider'];
        };
        if (!empty($headers['sdk'])) {
            $model->androidapi = $headers['sdk'];
        };
        if (!empty($headers['ssize'])) {
            $model->screen_size = $headers['ssize'];
        };
        $model->action = UsersActionStat::ACTION_LOAD_Category;
        $model->actionID = $gui;
        $model->results = $results;
        $model->lat = $lat;
        $model->lng = $lng;
        $model->save(false);
        return;
    }

    public static function saveComment($place_id = null, $lat = null, $lng = null)
    {
        $headers = apache_request_headers();
        $model = new UsersActionStat();
        if (!empty($headers['appver'])) {
            $model->app_version = $headers['appver'];
        };
        if (!empty($headers['DModel'])) {
            $model->device_model = $headers['DModel'];
        };
        if (!empty($headers['Data'])) {
            $model->network = $headers['Data'];
        };
        if (!empty($headers['lang'])) {
            $model->lang = $headers['lang'];
            $model->device_lang = $headers['lang'];
        };
        if (!empty($headers['Provider'])) {
            $model->isp = $headers['Provider'];
        };
        if (!empty($headers['sdk'])) {
            $model->androidapi = $headers['sdk'];
        };
        if (!empty($headers['ssize'])) {
            $model->screen_size = $headers['ssize'];
        };
        $model->action = UsersActionStat::ACTION_ADD_COMMENT;
        $model->actionID = $place_id;
        $model->lat = $lat;
        $model->lng = $lng;
        $model->save(false);
        return;
    }

    public static function saveFollow($place_id = null, $result = null)
    {
        $headers = apache_request_headers();
        $model = new UsersActionStat();
        if (!empty($headers['appver'])) {
            $model->app_version = $headers['appver'];
        };
        if (!empty($headers['DModel'])) {
            $model->device_model = $headers['DModel'];
        };
        if (!empty($headers['Data'])) {
            $model->network = $headers['Data'];
        };
        if (!empty($headers['lang'])) {
            $model->lang = $headers['lang'];
            $model->device_lang = $headers['lang'];
        };
        if (!empty($headers['Provider'])) {
            $model->isp = $headers['Provider'];
        };
        if (!empty($headers['sdk'])) {
            $model->androidapi = $headers['sdk'];
        };
        if (!empty($headers['ssize'])) {
            $model->screen_size = $headers['ssize'];
        };
        $model->action = UsersActionStat::ACTION_LIKE_PLACE;
        $model->actionID = $place_id;
        $model->resultbool = $result;
        $model->save(false);
        return;
    }


    public static function saveUserFollow($uid = null, $result = null)
    {
        $headers = apache_request_headers();
        $model = new UsersActionStat();
        if (!empty($headers['appver'])) {
            $model->app_version = $headers['appver'];
        };
        if (!empty($headers['DModel'])) {
            $model->device_model = $headers['DModel'];
        };
        if (!empty($headers['Data'])) {
            $model->network = $headers['Data'];
        };
        if (!empty($headers['lang'])) {
            $model->lang = $headers['lang'];
            $model->device_lang = $headers['lang'];
        };
        if (!empty($headers['Provider'])) {
            $model->isp = $headers['Provider'];
        };
        if (!empty($headers['sdk'])) {
            $model->androidapi = $headers['sdk'];
        };
        if (!empty($headers['ssize'])) {
            $model->screen_size = $headers['ssize'];
        };
        $model->action = UsersActionStat::ACTION_USER_FOLLOW;
        $model->actionID = $uid;
        $model->resultbool = $result;
        $model->save(false);
        return;
    }

    public static function saveUserUnFollow($uid = null, $result = null)
    {
        $headers = apache_request_headers();
        $model = new UsersActionStat();
        if (!empty($headers['appver'])) {
            $model->app_version = $headers['appver'];
        };
        if (!empty($headers['DModel'])) {
            $model->device_model = $headers['DModel'];
        };
        if (!empty($headers['Data'])) {
            $model->network = $headers['Data'];
        };
        if (!empty($headers['lang'])) {
            $model->lang = $headers['lang'];
            $model->device_lang = $headers['lang'];
        };
        if (!empty($headers['Provider'])) {
            $model->isp = $headers['Provider'];
        };
        if (!empty($headers['sdk'])) {
            $model->androidapi = $headers['sdk'];
        };
        if (!empty($headers['ssize'])) {
            $model->screen_size = $headers['ssize'];
        };
        $model->action = UsersActionStat::ACTION_USER_UNFOLLOW;
        $model->actionID = $uid;
        $model->resultbool = $result;
        $model->save(false);
        return;
    }


    public static function savePlace($place_id = null, $lat = null, $lng = null)
    {
        $headers = apache_request_headers();
        $model = new UsersActionStat();
        if (!empty($headers['appver'])) {
            $model->app_version = $headers['appver'];
        };
        if (!empty($headers['DModel'])) {
            $model->device_model = $headers['DModel'];
        };
        if (!empty($headers['Data'])) {
            $model->network = $headers['Data'];
        };
        if (!empty($headers['lang'])) {
            $model->lang = $headers['lang'];
            $model->device_lang = $headers['lang'];
        };
        if (!empty($headers['Provider'])) {
            $model->isp = $headers['Provider'];
        };
        if (!empty($headers['sdk'])) {
            $model->androidapi = $headers['sdk'];
        };
        if (!empty($headers['ssize'])) {
            $model->screen_size = $headers['ssize'];
        };
        $model->action = UsersActionStat::ACTION_ADD_PLACE__WITH_DIALOG;
        $model->actionID = $place_id;
        $model->lat = $lat;
        $model->lng = $lng;
        $model->save(false);
        return;
    }

    public static function savePlaceSearchV($place_id = null, $lat = null, $lng = null)
    {
        $headers = apache_request_headers();
        $model = new UsersActionStat();
        if (!empty($headers['appver'])) {
            $model->app_version = $headers['appver'];
        };
        if (!empty($headers['DModel'])) {
            $model->device_model = $headers['DModel'];
        };
        if (!empty($headers['Data'])) {
            $model->network = $headers['Data'];
        };
        if (!empty($headers['lang'])) {
            $model->lang = $headers['lang'];
            $model->device_lang = $headers['lang'];
        };
        if (!empty($headers['Provider'])) {
            $model->isp = $headers['Provider'];
        };
        if (!empty($headers['sdk'])) {
            $model->androidapi = $headers['sdk'];
        };
        if (!empty($headers['ssize'])) {
            $model->screen_size = $headers['ssize'];
        };
        $model->action = UsersActionStat::ACTION_ADD_PLACE_WITH_VOICE;
        $model->actionID = $place_id;
        $model->lat = $lat;
        $model->lng = $lng;
        $model->save(false);
        return;
    }
}