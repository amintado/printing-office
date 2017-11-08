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

use common\models\base\ProductCategory;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\base\ProductCategory */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="product-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'نام مورد نظر را بنویسید...']) ?>
    <?= $form->field($model, 'parent')->widget(Select2::className(),
        [
                'data' => ArrayHelper::map(ProductCategory::find()->all(),'id','name'),
            'pluginOptions' => [
                'allowClear' => true
            ],
            'options' => ['placeholder' => 'در صورت نیاز انتخاب کنید...'],
        ]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className()) ?>

    <?= $form->field($model, 'status')->widget(Select2::className(),
        [
            'data' =>
                [
                    1 => 'فعال',
                    2 => 'غیر فعال'
                ]
        ]) ?>

    <?= $form->field($model, 'product_model')->widget(Select2::className(),
        [
            'data' =>
                [
                    ProductCategory::MODEL_CHAPI => 'محصول چاپی',
                    ProductCategory::MODEL_SHOP => 'محصول فروشگاهی'
                ]
        ]) ?>

    <?= $form->field($model, 'picture')->widget(FileInput::className(),
        [
            'options' => ['accept' => 'image/*','multiple'=>false],
        ])?>

    <div class="form-group">
        <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
            <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
        <?= Html::a(Yii::t('backend', 'Cancel'), '#', ['class' => 'btn btn-danger', 'id' => 'cancel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
