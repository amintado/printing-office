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

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-right image">
                <img src="<?= functions::ImageReturn(Yii::$app->user->getId()) ?>" class="img-circle" alt="User Image"
                     style="height: 45px;width: 45px"/>
            </div>
            <div class="pull-right info">
                <p><?= User::findOne(Yii::$app->user->getId())->fullname ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?= Yii::t('backend', 'online') ?></a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="<?= Yii::t('backend', 'search') ?>"/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => Yii::t('backend', 'main-menu'), 'options' => ['class' => 'header']],
                    ['label' => Yii::t('backend', 'home'), 'icon' => 'home', 'url' => ['/site']],

                    [
                        'label' => Yii::t('common', 'User Profile View'),
                        'icon' => 'share',
                        'url' => ['/user/view'],

                    ],
                    [
                        'label' => Yii::t('common', 'Profile Side Tickets'),
                        'icon' =>'headphones',
                        'url'=>['/ticket']
                    ]


                ],
            ]
        ) ?>

    </section>

</aside>
