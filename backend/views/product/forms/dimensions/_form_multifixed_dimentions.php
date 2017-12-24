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

use kartik\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\base\product\dimensions\MultifixedDimensions */
/* @var $form ActiveForm */
/**
 * @var $id string
 */
$js=<<<JS
$('#mainform').yiiActiveForm('add', 
{
    id: 'multifixeddimensions-$id-fixed_height',
    name: 'multifixeddimensions-$id-fixed_height',
    container: '.field-multifixeddimensions-$id-fixed_height',
    input: '#multifixeddimensions-$id-fixed_height',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "طول ابعاد ثابت باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "طول ابعاد ثابت نمیتواند خالی باشد"});
    }
});
$('#mainform').yiiActiveForm('add', 
{
    id: 'multifixeddimensions-$id-fixed_width',
    name: 'multifixeddimensions-$id-fixed_width',
    container: '.field-multifixeddimensions-$id-fixed_width',
    input: '#multifixeddimensions-$id-fixed_width',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "عرض ابعاد ثابت باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "عرض ابعاد ثابت نمیتواند خالی باشد"});
    }
});
$('#mainform').yiiActiveForm('add', 
{
    id: 'multifixeddimensions-$id-price',
    name: 'multifixeddimensions-$id-price',
    container: '.field-multifixeddimensions-$id-price',
    input: '#multifixeddimensions-$id-price',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "قیمت ابعاد ثابت باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "قیمت ابعاد ثابت نمیتواند خالی باشد"});
    }
});

JS;
$this->registerJs($js,View::POS_END);
?>
<div class="panel panel-default" id="multifix-<?= $id ?>">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-offset-11">
                <button onclick="removeMultifix(<?= $id ?>)" type="button" class="btn btn-danger"><i
                            class="glyphicon glyphicon-trash"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group field-multifixeddimensions-<?= $id?>-fixed_height required">
                    <label class="control-label" for="multifixeddimensions-<?= $id?>-fixed_height">طول ثابت</label>
                    <div class="input-group">
                        <input id="multifixeddimensions-<?= $id?>-fixed_height" class="form-control"
                               name="MultifixedDimensions[<?= $id ?>][fixed_height]" aria-required="true" aria-invalid="true"
                               type="text">
                        <span class="input-group-addon">سانت</span>
                    </div>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group field-multifixeddimensions-<?= $id?>-fixed_width required">
                    <label class="control-label" for="multifixeddimensions-<?= $id?>-fixed_width">عرض ثابت</label>
                    <div class="input-group">

                        <input id="multifixeddimensions-<?= $id?>-fixed_width" class="form-control"
                               name="MultifixedDimensions[<?= $id ?>][fixed_width]" aria-required="true" type="text">
                        <span class="input-group-addon">سانت</span>
                    </div>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group field-multifixeddimensions-<?= $id?>-price required">
                    <label class="control-label" for="multifixeddimensions-<?= $id?>-price">قیمت</label>
                    <div class="input-group">
                        <input id="multifixeddimensions-<?= $id?>-price" class="form-control"
                               name="MultifixedDimensions[<?= $id ?>][price]" aria-required="true" type="text">
                        <span class="input-group-addon">تومان برای هر عدد</span>
                    </div>

                    <div class="help-block"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php


?>
