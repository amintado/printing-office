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
 * Date: 11/6/2017
 * Time: 9:35 AM
 */

namespace profile\controllers;


use yii\web\Controller;

class OrderController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }
}