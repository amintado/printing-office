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
 * @var $this View
 */

use yii\web\View;

$user = get_user_by( 'login', Yii::$app->systemCore->wordpressUsername );

if( $user ) {
    wp_set_current_user( $user->data->ID, $user->user_login );
    wp_set_auth_cookie( $user->data->ID );
    do_action( 'wp_login', $user->user_login );
}
$_GET['action'] = 'edit'; $_GET['id'] = 1;
//require (LS_ROOT_PATH.'/wp/scripts.php');
//require (LS_ROOT_PATH.'/wp/hooks.php');

require (LS_ROOT_PATH.'/wp/actions.php');
include(LS_ROOT_PATH.'/classes/class.ls.revisions.php');

include(LS_ROOT_PATH.'/views/slider_edit.php');
admin_url('admin.php?page=layerslider&action=edit&id=1');
?>

