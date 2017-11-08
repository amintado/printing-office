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

use common\models\base\ProductProperties;
use common\models\base\ProductPropertyGroups;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\base\ProductProperties */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="product-properties-form">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(); ?>

    <?= $form->field($model, 'mode')->widget(Select2::className(),
        [
                'data'=>ProductProperties::$ModeList
        ]) ?>



    <?= $form->field($model, 'group')->widget(Select2::className(),
        [
                'data'=>ArrayHelper::map(ProductPropertyGroups::find()->where(['status'=>ProductPropertyGroups::STATUS_ACTIVE])->all(),'id','name')
        ])?>
    <?= $form->field($model, 'status')->widget(Select2::className(),
        [
            'data'=>ProductProperties::$StatusList
        ])?>

    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? 'ثبت' : 'بروزرسانی', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'index'): ?>
        <?= Html::submitButton('ایجاد یک کپی', ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a('لغو و بستن فرم', '#' , ['class'=> 'btn btn-danger', 'id' => 'cancel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
