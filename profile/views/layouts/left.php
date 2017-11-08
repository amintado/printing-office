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
use common\models\UserInfo;

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
        <div class="user-panel">
            <div class="pull-right image">
                <div style="color: white;" class="text-center">
                <?= Yii::t('common', 'account balance').':' ?>
                    <?php

                    echo   number_format(intval(  \common\models\base\UserInfo::find()->where(['uid'=>Yii::$app->user->id])->one()->balance ), 0, ',', ',');
                ?>
                    ریال
                </div>
            </div>
            <div class="pull-right">
                <a name="" id="" class="btn btn-success" href="<?= Yii::$app->urlManager->createUrl(['/payment/default/create']) ?> " role="button"><?= Yii::t('common', 'Increase in inventory') ?> </a>
            </div>
        </div>
        

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    [
                        'label' => Yii::t('backend', 'main-menu'),
                        'options' => ['class' => 'header']
                    ],
                    [
                        'label' => Yii::t('backend', 'home'),
                        'icon' => 'home',
                        'url' => ['/site']
                    ],
                    [
                        'label'=> 'سفارش چاپ',
                        'url'=>['/order']
                    ],
                    [
                        'label' => Yii::t('common', 'User Profile View'),
                        'icon' => 'share',
                        'url' => ['/user/view'],

                    ],
                    [
                        'label' => Yii::t('common', 'Profile Side Tickets'),
                        'icon' => 'headphones',
                        'url' => ['/ticket']
                    ],
                    [
                        'label' => 'استعلام',
                        'url' => ['/inquery']
                    ],
                    [
                        'label' => 'حساب',
                        'items' =>
                            [
                                [
                                    'label' => 'صورت حساب',
                                    'icon' => 'share',
                                    'url' => ['/payment']
                                ]
                            ]
                    ]


                ],
            ]
        ) ?>

    </section>

</aside>
