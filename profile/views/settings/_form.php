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
use yii\redactor\widgets\Redactor;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <div class="col-lg-12">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-lg-4">

                <?= $form->field($model, 'setting_key')->textInput(['maxlength' => true]) ?>



                <?= $form->field($model, 'setting_description')->textarea() ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'setting_value')->widget(Redactor::className()) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('backend', 'Submit'), ['class' => 'btn btn-success circle']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <div class="clearfix"></div>
</div>
