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

/**
 * @var $id string
 * @var $this View
 */

use yii\web\View;

$js=<<<JS

$('#mainform').yiiActiveForm('add', 
{
    id: 'fixeddimensions-$id-fixed_width',
    name: 'fixeddimensions-$id-fixed_width',
    container: '.field-fixeddimensions-$id-fixed_width',
    input: '#fixeddimensions-$id-fixed_width',
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
    id: 'fixeddimensions-$id-fixed_height',
    name: 'fixeddimensions-$id-fixed_height',
    container: '.field-fixeddimensions-$id-fixed_height',
    input: '#fixeddimensions-$id-fixed_height',
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
    id: 'fixeddimensions-$id-price',
    name: 'fixeddimensions-$id-price',
    container: '.field-fixeddimensions-$id-price',
    input: '#fixeddimensions-$id-price',
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
<div class="panel panel-default" id="fixed-<?= $id ?>">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group field-fixeddimensions-<?= $id ?>-fixed_height required">
                    <label class="control-label" for="fixeddimensions-<?= $id ?>-fixed_height">طول ثابت</label>
                    <div class="input-group">
                        <input id="fixeddimensions-<?= $id ?>-fixed_height" class="form-control" name="FixedDimensions[<?= $id ?>][fixed_height]"
                               aria-required="true" type="text">
                        <span class="input-group-addon">سانت</span>
                    </div>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group field-fixeddimensions-<?= $id ?>-fixed_width required">
                    <label class="control-label" for="fixeddimensions-<?= $id ?>-fixed_width">عرض ثابت</label>
                    <div class="input-group">
                        <input id="fixeddimensions-<?= $id ?>-fixed_width" class="form-control" name="FixedDimensions[<?= $id ?>][fixed_width]"
                               aria-required="true" type="text">
                        <span class="input-group-addon">سانت</span>
                    </div>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group field-fixeddimensions-<?= $id ?>-price required">
                    <label class="control-label" for="fixeddimensions-<?= $id ?>-price">قیمت</label>
                    <div class="input-group">
                        <input id="fixeddimensions-<?= $id ?>-price" class="form-control" name="FixedDimensions[<?= $id ?>][price]"
                               aria-required="true" aria-invalid="true" type="text">
                        <span class="input-group-addon">تومان برای هر عدد</span>
                    </div>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group field-fixeddimensions-<?= $id ?>-invisible_dimensions">

                    <div class="checkbox">
                        <input name="FixedDimensions[<?= $id ?>][invisible_dimensions]" value="0" type="hidden">
                        <label>
                            <input id="fixeddimensions-invisible_dimensions" name="FixedDimensions[<?= $id ?>][invisible_dimensions]"
                                   value="1" type="checkbox">
                            عدم نمایش ابعاد برای کاربر
                        </label>
                    </div>

                    <div class="help-block"></div>
                </div>
            </div>
        </div>

    </div>
</div>
