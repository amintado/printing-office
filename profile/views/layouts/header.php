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

use common\config\components\functions;
use common\models\User;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


$fullname=User::findOne(Yii::$app->user->getId() )->fullname;
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">تابان</span><span class="logo-lg">' . Yii::$app->systemCore->companyName . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">



        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">



                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= functions::ImageReturn(Yii::$app->user->getId()) ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= $fullname?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= functions::ImageReturn(Yii::$app->user->getId()) ?>" class="img-circle"
                                 alt="User Image"/>

                            <p>
                               <?= $fullname ?>
                                <small>عضویت از 1395</small>
                                <small><?= Yii::$app->user->id ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">دنبال کننده ها</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">سفارشات</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">دوستان</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">نمایه</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    Yii::t('common', 'Sign Out'),
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
