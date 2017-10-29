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

/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 8/25/2017
 * Time: 2:14 PM
 */

namespace backend\controllers;


use function mysqli_thread_safe;
use yii\web\Controller;

class ProfileController extends Controller
{
 public function actionIndex(){
     return $this->render('index');

 }
}