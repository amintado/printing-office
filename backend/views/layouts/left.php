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
        $items[1] = ['label' => Yii::t('backend', 'main-menu'), 'options' => ['class' => 'header']];
        $items[2] = ['label' => Yii::t('backend', 'home'), 'icon' => 'home', 'url' => ['/site']];
        if (Yii::$app->user->can('SlideManage') or $SlideHelp = Yii::$app->user->can('SlideHelp')) {
            $items[3] = [
                'label' => 'مدیریت اسلایدر ها',
                'icon' => 'share',
                'items' => []
            ];
            if (Yii::$app->user->can('SlideManage')) {
                $items[3]['items'][] =
                    [
                        'label' => 'پنل مدیریت اسلاید',
                        'icon' => 'share',
                        'url' => ['/slide']
                    ];
            }
            if (Yii::$app->user->can('SlideHelp')) {
                $items[3]['items'][] =
                    [
                        'label' => 'راهنمای استفاده از ادمین',
                        'icon' => 'share',
                        'url' => ['/slide/help']
                    ];
            }

        }

        //                    ['label' => Yii::t('backend', 'gii'), 'icon' => 'file-code-o', 'url' => ['/gii']],

        if
        (
        (
            Yii::$app->user->can('userIndex')
            or
            Yii::$app->user->can('userView')
            or
            Yii::$app->user->can('userCreate')
            or
            Yii::$app->user->can('userUpdate')
            or
            Yii::$app->user->can('userDelete')
            or
            Yii::$app->user->can('userHelp')
        )
        ) {
            $items[4] = [
                'label' => 'مدیریت کاربران',
                'icon' => 'share',
                'url' => '#',
                'items' => [],
            ];

            if
            (
            Yii::$app->user->can('userIndex')
            ) {
                $items[4]['items'][] =
                    [
                        'label' => 'فهرست عمومی کاربران', 'icon' => 'map-marker', 'url' => ['/users/index'],
                    ];
            }
            if (Yii::$app->user->can('userAccess')) {
                $items[4]['items'][] = [
                    'label' => 'مدیریت دسترسی ها',
                    'items' =>
                        [
                            ['label' => 'راهنمای دسترسی ها', 'icon' => 'comment', 'url' => ['/users/help'],],
                            ['label' => 'نقش های موجود', 'icon' => 'comment', 'url' => ['/rbac/role'],],
                            ['label' => 'مجوز های سیستمی', 'icon' => 'filter', 'url' => ['/rbac/permission']],
                            ['label' => 'قوائد کاربری', 'icon' => 'filter', 'url' => ['/rbac/rule']],
                            ['label' => 'تخصیص نقش به کاربران', 'icon' => 'filter', 'url' => ['/rbac/assignment']],
                        ],
                    'icon' => 'filter'
                ];
            }
        }
        if
        (
            Yii::$app->user->can('productIndex') or
            Yii::$app->user->can('productView') or
            Yii::$app->user->can('productCreate') or
            Yii::$app->user->can('productUpdate') or
            Yii::$app->user->can('productDelete') or
            Yii::$app->user->can('productPdf')
        ) {
            $items[5] = [
                'label' => 'مدیریت محصولات',
                'icon' => 'inbox',
                'url' => ['/product']
            ];
        }

        if
        (
            Yii::$app->user->can('TicketAdminIndex') or
            Yii::$app->user->can('TicketAdminView') or
            Yii::$app->user->can('TicketAdminCreate') or
            Yii::$app->user->can('TicketAdminClosed') or
            Yii::$app->user->can('TicketAdminDelete') or

            Yii::$app->user->can('TicketAdminOpen') or
            Yii::$app->user->can('TicketAdminAnswer')
        ) {
            $items[6] = [
                'label' => 'پشتیبانی',
                'icon' => 'headphones',
                'url' => ['/ticket/admin']
            ];
        }

        if
        (
            (
                Yii::$app->user->can('InqueryCategoryIndex') or
                Yii::$app->user->can('InqueryCategoryView') or
                Yii::$app->user->can('InqueryCategoryCreate') or
                Yii::$app->user->can('InqueryCategoryUpdate') or
                Yii::$app->user->can('InqueryCategoryDelete') or
                Yii::$app->user->can('InqueryCategoryHelp')
            ) or
            (
                Yii::$app->user->can('InqueryIndex') or
                Yii::$app->user->can('InqueryView') or
                Yii::$app->user->can('InqueryCreate') or
                Yii::$app->user->can('InqueryUpdate') or
                Yii::$app->user->can('InqueryDelete') or
                Yii::$app->user->can('InqueryHelp') or
                Yii::$app->user->can('InqueryConfirm')
            )
        ) {
            $items[7] = [
                'label' => 'استعلام',
                'items' => []
            ];
        }


        if
        (
            Yii::$app->user->can('InqueryCategoryIndex') or
            Yii::$app->user->can('InqueryCategoryView') or
            Yii::$app->user->can('InqueryCategoryCreate') or
            Yii::$app->user->can('InqueryCategoryUpdate') or
            Yii::$app->user->can('InqueryCategoryDelete') or
            Yii::$app->user->can('InqueryCategoryHelp')
        ) {
            $items[7]['items'][] =
                [
                    'label' => 'دسته بندی ها',
                    'icon' => 'share',
                    'url' => ['/inquery/inquery-category']
                ];
        }
        if
        (
            Yii::$app->user->can('InqueryIndex') or
            Yii::$app->user->can('InqueryView') or
            Yii::$app->user->can('InqueryCreate') or
            Yii::$app->user->can('InqueryUpdate') or
            Yii::$app->user->can('InqueryDelete') or
            Yii::$app->user->can('InqueryHelp') or
            Yii::$app->user->can('InqueryConfirm')
        ) {
            $items[7]['items'][] =
                [
                    'label' => 'درخواست ها',
                    'icon' => 'share',
                    'url' => ['/inquery/manage']
                ];
        }


        if
        (
            Yii::$app->user->can('settings')
        ){
            $items[9] = [
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
        }




        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => $items

            ]
        ) ?>

    </section>

</aside>
