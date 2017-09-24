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
        <?php
        $items[] = ['label' => Yii::t('backend', 'main-menu'), 'options' => ['class' => 'header']];
        $items[] = ['label' => Yii::t('backend', 'home'), 'icon' => 'home', 'url' => ['/site']];
        $items[] = [
            'label' => 'مدیریت اسلایدر ها',
            'icon' => 'share',
            'items' =>
                [
                    [
                        'label' => 'پنل مدیریت اسلاید',
                        'icon' => 'share',
                        'url' => ['/slide']
                    ],
                    [
                        'label' => 'راهنمای استفاده از ادمین',
                        'icon' => 'share',
                        'url' => ['/slide/help']
                    ]

                ]
        ];
        //                    ['label' => Yii::t('backend', 'gii'), 'icon' => 'file-code-o', 'url' => ['/gii']],
        $items[] = [
            'label' => 'مدیریت کاربران',
            'icon' => 'share',
            'url' => '#',
            'items' => [
                ['label' => 'فهرست عمومی کاربران', 'icon' => 'map-marker', 'url' => ['/users/index'],],
//                        ['label' => 'نقش های کاربری', 'icon' => 'comment', 'url' => ['/role/index'],],
//                        ['label'=>'مدل های کاربری','icon'=>'filter','url'=>['/user-mode']]

            ],
        ];
        $items[] = [
            'label' => 'مدیریت محصولات',
            'icon' => 'inbox',
            'url' => ['/product']
        ];

        $items[] = [
            'label' => 'پشتیبانی',
            'icon' => 'headphones',
            'url' => ['/ticket/admin']
        ];
        $items[] = [
            'label' => 'سیستم',
            'icon' => 'no',
            'items' =>
                [
                    ['label' => 'تنظیمات سیستم',
                        'icon' => 'share',
                        'url' => ['/settings'],
                    ],
                    ['label' => 'انواع پارامتر',
                        'icon' => 'share',
                        'url' => ['/types'],
                    ],
                ]
        ];


        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => $items

            ]
        ) ?>

    </section>

</aside>
