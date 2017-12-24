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

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Menu - Settings');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@assets/js/page_number.js');
?>
<div class="settings-index">
    <?=
    TabsX::widget([
        'items' =>
            [
                [
                    'label' => 'تنظیمات سیستم پرداخت آنلاین',
                    'content' => amintado\pay\widgets\PaymentsettingsWidget::widget()
                ],
                [
                    'label' => 'تنظیمات سیستم انبار داری',
                    'content' => amintado\pinventory\widgets\SettingsWidget::widget()
                ]

            ]
    ])
    ?>


</div>

