<?php
/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 8/25/2017
 * Time: 2:14 PM
 */

namespace profile\controllers;


use common\models\User;
use common\models\UserInfo;
use function mysqli_thread_safe;
use Yii;
use yii\web\Controller;

class ProfileController extends Controller
{
 public function actionIndex(){
     return $this->render('index');
 }



}