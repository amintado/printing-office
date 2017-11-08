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

use common\models\base\Zink;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\base\Zink */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="zink-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>
    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>
    <div class="row">
    <div class="col-md-6">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'height')->textInput(['placeholder' => 'Height']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'width')->textInput(['placeholder' => 'Width']) ?>
    </div>
</div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'mode')->widget(Select2::className(),
                [
                    'data' => Zink::$ModeList
                ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'status')->widget(Select2::className(),
                [
                    'data'=>Zink::$StatusList
                ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'max_height')->textInput(['placeholder' => 'Max Height']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'max_width')->textInput(['placeholder' => 'Max Width']) ?>
        </div>
    </div>












    <?= $form->field($model, 'tag')->textInput(['maxlength' => true, 'placeholder' => 'Tag']) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className()) ?>

    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? 'ثبت' : 'بروزرسانی', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton('ایجاد یک کپی', ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a('لغو و بستن فرم', '#' , ['class'=> 'btn btn-danger', 'id' => 'cancel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
