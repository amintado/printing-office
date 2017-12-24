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
/* @var $model common\models\base\product\dimensions\VariableDimensions */
/* @var $form ActiveForm */
$js=<<<JS
$('#mainform').yiiActiveForm('add', 
{
    id: 'variabledimensions-$id-base_width',
    name: 'variabledimensions-$id-base_width',
    container: '.field-variabledimensions-$id-base_width',
    input: '#variabledimensions-$id-base_width',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "عرض پایه باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "عرض پایه نمیتواند خالی باشد"});
    }
});

$('#mainform').yiiActiveForm('add', 
{
    id: 'variabledimensions-$id-base_height',
    name: 'variabledimensions-$id-base_height',
    container: '.field-variabledimensions-$id-base_height',
    input: '#variabledimensions-$id-base_height',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "طول پایه باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "عرض پایه نمیتواند خالی باشد"});
    }
});

$('#mainform').yiiActiveForm('add', 
{
    id: 'variabledimensions-$id-min_height',
    name: 'variabledimensions-$id-min_height',
    container: '.field-variabledimensions-$id-min_height',
    input: '#variabledimensions-$id-min_height',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "حداقل طول باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "حداقل طول نمیتواند خالی باشد"});
    }
});


$('#mainform').yiiActiveForm('add', 
{
    id: 'variabledimensions-$id-min_width',
    name: 'variabledimensions-$id-min_width',
    container: '.field-variabledimensions-$id-min_width',
    input: '#variabledimensions-$id-min_width',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "حداقل عرض باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "حداقل عرض نمیتواند خالی باشد"});
    }
});


$('#mainform').yiiActiveForm('add', 
{
    id: 'variabledimensions-$id-max_height',
    name: 'variabledimensions-$id-max_height',
    container: '.field-variabledimensions-$id-max_height',
    input: '#variabledimensions-$id-max_height',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "حداکثر طول باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "حداکثر طول نمیتواند خالی باشد"});
    }
});


$('#mainform').yiiActiveForm('add', 
{
    id: 'variabledimensions-$id-max_width',
    name: 'variabledimensions-$id-max_width',
    container: '.field-variabledimensions-$id-max_width',
    input: '#variabledimensions-$id-max_width',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "حداکثر عرض باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "حداکثر عرض نمیتواند خالی باشد"});
    }
});


$('#mainform').yiiActiveForm('add', 
{
    id: 'variabledimensions-$id-price',
    name: 'variabledimensions-$id-price',
    container: '.field-variabledimensions-$id-price',
    input: '#variabledimensions-$id-price',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "قیمت باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "قیمت نمیتواند خالی باشد"});
    }
});


JS;
$this->registerJs($js,View::POS_END);
?>
<div class="panel panel-default" id="<?= $id ?>">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-10">
                <div class="form-group field-variabledimensions-<?= $id ?>-perth">

                    <div class="checkbox">
                        <input name="variableDimensions[<?= $id ?>][perth]" value="0" type="hidden">
                        <label>
                            <input id="variabledimensions-<?= $id ?>-perth" name="variableDimensions[<?= $id ?>][perth]" value="1" type="checkbox">استفاده از پرتی کاغذ
                        </label>
                    </div>

                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group field-variabledimensions-prevent_change_in_client">

                    <div class="checkbox"><input name="variableDimensions[<?= $id ?>][prevent_change_in_client]" value="0"
                                                 type="hidden"><label><input id="variabledimensions-prevent_change_in_client"
                                                                             name="variableDimensions[<?= $id ?>][prevent_change_in_client]"
                                                                             value="1" type="checkbox"> جلوگیری از ثبت ابعاد
                            توسط مشتری(پس از انتخاب این گزینه باید لیستی از ابعاد پیشفرض را وارد کنید)</label></div>

                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group field-variabledimensions-<?= $id ?>-base_width required">
                    <label class="control-label" for="variabledimensions-<?= $id ?>-base_width">عرض پایه</label>
                    <div class="input-group">
                        <input id="variabledimensions-<?= $id ?>-base_width" class="form-control" name="variableDimensions[<?= $id ?>][base_width]"
                               aria-required="true" type="text">
                        <span class="input-group-addon">سانت</span>
                    </div>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group field-variabledimensions-<?= $id ?>-base_height required">
                    <label class="control-label" for="variabledimensions-<?= $id ?>-base_height">طول پایه</label>
                    <div class="input-group">
                        <input id="variabledimensions-<?= $id ?>-base_height" class="form-control" name="variableDimensions[<?= $id ?>][base_height]"
                               aria-required="true" type="text">
                        <span class="input-group-addon">سانت</span>
                    </div>

                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group field-variabledimensions-<?= $id ?>-min_height required">
                    <label class="control-label" for="variabledimensions-<?= $id ?>-min_height">حداقل طول</label>
                    <div class="input-group">
                        <input id="variabledimensions-<?= $id ?>-min_height" class="form-control" name="variableDimensions[<?= $id ?>][min_height]"
                               aria-required="true" type="text">
                        <span class="input-group-addon">سانت</span>
                    </div>


                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group field-variabledimensions-<?= $id ?>-min_width required">
                    <label class="control-label" for="variabledimensions-<?= $id ?>-min_width">حداقل عرض</label>
                    <div class="input-group">
                        <input id="variabledimensions-<?= $id ?>-min_width" class="form-control" name="variableDimensions[<?= $id ?>][min_width]"
                               aria-required="true" type="text">
                        <span class="input-group-addon">سانت</span>
                    </div>

                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group field-variabledimensions-<?= $id ?>-max_height required">
                    <label class="control-label" for="variabledimensions-<?= $id ?>-max_height">حداکثر طول</label>
                    <div class="input-group">
                        <input id="variabledimensions-<?= $id ?>-max_height" class="form-control" name="variableDimensions[<?= $id ?>][max_height]"
                               aria-required="true" type="text">
                        <span class="input-group-addon">سانت</span>
                    </div>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group field-variabledimensions-<?= $id ?>-max_width required">
                    <label class="control-label" for="variabledimensions-<?= $id ?>-max_width">حداکثر عرض</label>
                    <div class="input-group">
                        <input id="variabledimensions-<?= $id ?>-max_width" class="form-control" name="variableDimensions[<?= $id ?>][max_width]"
                               aria-required="true" type="text">
                        <span class="input-group-addon">سانت</span>
                    </div>

                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group field-variabledimensions-<?= $id ?>-price required">
                    <label class="control-label" for="variabledimensions-<?= $id ?>-price">قیمت</label>
                    <div class="input-group">
                        <input id="variabledimensions-<?= $id ?>-price" class="form-control" name="variableDimensions[<?= $id ?>][price]"
                               aria-required="true" type="text">
                        <span class="input-group-addon">تومان برای هر عدد</span>
                    </div>

                    <div class="help-block"></div>
                </div>
            </div>
        </div>
    </div>
</div>
