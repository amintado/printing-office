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

use common\models\Product;

/**
 * wizard widget must install from composer
 * install with require:
 * "drsdre/yii2-wizardwidget": "*"
 * @var $user User
 * @var $product Product
 */

$wizard_config = [
    'id' => 'stepwizard',
    'steps' => [
        1 => [
            'title' => 'مشخصات کالا',
            'icon' => 'fa fa-home',
            'content' => $this->render('steps/start.php',
                [
                    'product'=> $product,
                    'user'=>$user
                ]),
            'buttons' => [
                'next' => [
                    'title' => 'Forward',
                    'options' => [
                        'class' => 'disabled',
                    ],
                ],
            ],
        ],
        2 => [
            'title' => 'Step 2',
            'icon' => 'glyphicon glyphicon-cloud-upload',
            'content' => $this->render('steps/step1.php',
                [
                    'product'=> $product,
                    'user'=>$user
                ]),
            'skippable' => true,
        ],
        3 => [
            'title' => 'Step 3',
            'icon' => 'glyphicon glyphicon-transfer',
            'content' => $this->render('steps/step2.php',
                [
                    'product'=> $product,
                    'user'=>$user
                ]),
        ],
    ],
    'complete_content' => "You are done!", // Optional final screen
    'start_step' => 1, // Optional, start with a specific step
];
?>
<style>
    .nav-tabs > li > a {
        opacity: 1 !important;
    }
    .input-group-addon:first-child {
        border-left: 0px;
        border-right: 0px solid;
    }
    .pmd-textfield .input-group .input-group-addon:first-child {
        padding-right: 0;
        padding-left: 16px;
    }
</style>
<?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>
