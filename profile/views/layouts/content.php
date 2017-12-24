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

use dmstr\widgets\Alert;
use yii\web\View;
use yii\widgets\Breadcrumbs;


?>

<div class="container-fluid">
    <div class="card card-nav-tabs card-plain" style="
	margin-top: -90px;
">
        <div class="header header-success" style="direction: rtl;
float: right;
width: 100%;">
            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs" style="direction: rtl;
float: right;">
                        <li><a href="/profile/index.php/site"><i class="fa fa-home"></i> <span>میز کار</span>
                                <div class="ripple-container"></div>
                            </a></li>
                        <li><a href="/profile/index.php/order"> <span>سفارش چاپ</span></a>
                        </li>
                        <li><a href="/profile/index.php/user/view">
                                <span>نمایه ی کاربر</span></a></li>
                        <li><a href="/profile/index.php/ticket">
                                <span>پشتیبانی</span></a></li>
                        <li><a href="/profile/index.php/inquery"> <span>استعلام</span></a>
                        </li>
                        <li class="dropdown treeview">
                            <a href="#" class="btn btn-simple dropdown-toggle" data-toggle="dropdown">
                                <b class="caret"></b>
                                <span>حساب</span>

                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/profile/index.php/payment"><i class="fa fa-share"></i>
                                        <span>صورت حساب</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content">

        </div>
    </div>


    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h3><?= $this->blocks['content-header'] ?></h3>
        <?php } ?>
        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <div class="row">
        <div class="col-md-12">

            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>


</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <?php Yii::$app->systemCore->versions['profile'] ?>
        <?php Yii::$app->systemCore->poweredByTexts['profile'] ?>
    </div>

</footer>

<!-- Control Sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
