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

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\base\product\property\Property */
/* @var $form ActiveForm */
?>
<div class="panel panel-default">
    <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'property') ?>
    <?= $form->field($model, 'priceMode') ?>
    <?= $form->field($model, 'calculateMode') ?>

    <?php ActiveForm::end(); ?>


    </div>
</div>
