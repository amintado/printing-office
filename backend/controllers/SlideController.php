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
 * Date: 9/17/2017
 * Time: 2:40 AM
 */

namespace backend\controllers;


use Yii;
use yii\web\Controller;

class SlideController extends Controller
{
    public function actionIndex()
    {
        do_action( 'in_admin_header' );

        $user = get_user_by( 'login', Yii::$app->systemCore->wordpressUsername );

        if( $user ) {
            wp_set_current_user( $user->data->ID, $user->user_login );
            wp_set_auth_cookie( $user->data->ID );
            do_action( 'wp_login', $user->user_login );
        }

        admin_url('admin.php?page=layerslider');
        $this->redirect('/cms/wp-admin/admin.php?page=layerslider');
        //return $this->render('index');

    }

    public function actionHelp(){
        $this->layout='main-help';
        return $this->render('help');
    }
}