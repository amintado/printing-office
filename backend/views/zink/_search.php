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
/* @var $model common\models\ZinkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-zink-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'mode')->textInput(['placeholder' => 'Mode']) ?>

    <?= $form->field($model, 'status')->textInput(['placeholder' => 'Status']) ?>

    <?= $form->field($model, 'width')->textInput(['placeholder' => 'Width']) ?>

    <?php /* echo $form->field($model, 'height')->textInput(['placeholder' => 'Height']) */ ?>

    <?php /* echo $form->field($model, 'max_width')->textInput(['placeholder' => 'Max Width']) */ ?>

    <?php /* echo $form->field($model, 'max_height')->textInput(['placeholder' => 'Max Height']) */ ?>

    <?php /* echo $form->field($model, 'tag')->textInput(['maxlength' => true, 'placeholder' => 'Tag']) */ ?>

    <?php /* echo $form->field($model, 'description')->textarea(['rows' => 6]) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
