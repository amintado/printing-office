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
/* @var $model common\models\Inquery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inquery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'qdescription')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qfile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qdate')->textInput() ?>

    <?= $form->field($model, 'adate')->textInput() ?>

    <?= $form->field($model, 'afile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adescription')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->textInput() ?>

    <?= $form->field($model, 'UUID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lock')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deleted_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'restored_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success circle' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
