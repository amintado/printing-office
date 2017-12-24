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

use kartik\form\ActiveForm;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model common\models\base\product\tiraj\Tiraj */
/* @var $form ActiveForm */
$js=<<<JS
$('#mainform').yiiActiveForm('add', 
{
    id: '$id-stair-from',
    name: '$id-stair-from',
    container: '.field-$id-stair-from',
    input: '#$id-stair-from',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "تیراژ دلخواه باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "تیراژ دلخواه نمیتواند خالی باشد"});
    }
});
$('#mainform').yiiActiveForm('add', 
{
    id: '$id-stair-to',
    name: '$id-stair-to',
    container: '.field-$id-stair-to',
    input: '#$id-stair-to',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "تیراژ دلخواه باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "تیراژ دلخواه نمیتواند خالی باشد"});
    }
});
$('#mainform').yiiActiveForm('add', 
{
    id: '$id-stair-price',
    name: '$id-stair-price',
    container: '.field-$id-stair-price',
    input: '#$id-stair-price',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "قیمت تیراژ دلخواه باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "قیمت تیراژ دلخواه نمیتواند خالی باشد"});
    }
});
$('#mainform').yiiActiveForm('add', 
{
    id: '$id-stair-factor',
    name: '$id-stair-factor',
    container: '.field-$id-stair-factor',
    input: '#$id-stair-factor',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "ضریب تیراژ دلخواه باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "ضریب تیراژ دلخواه نمیتواند خالی باشد"});
    }
});

JS;
$this->registerJs($js,View::POS_END);
?>

<div class="panel panel-default" id="stair-<?= $id ?>">
	<div class="panel-body">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group field-<?= $id ?>-stair-from required">
                            <label class="control-label sr-only" for="<?= $id ?>-stair-from">تیراژ از</label>
                            <div class="input-group">
                                <input id="<?= $id ?>-stair-from" class="form-control" name="Stair[<?= $id ?>][from]" placeholder="تیراژ از" aria-required="true" type="text">
                                <span class="input-group-addon">عدد</span>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group field-<?= $id ?>-stair-to required">
                            <label class="control-label sr-only" for="<?= $id ?>-stair-to">تیراژ تا</label>
                            <div class="input-group">
                                <input id="<?= $id ?>-stair-to" class="form-control" name="Stair[<?= $id ?>][to]" placeholder="تیراژ تا" aria-required="true" type="text">
                                <span class="input-group-addon">عدد</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group field-<?= $id ?>-stair-price required">
                            <label class="control-label sr-only" for="<?= $id ?>-stair-price">قیمت نهایی</label>
                            <div class="input-group">
                                <input id="<?= $id ?>-stair-price" class="form-control" name="Stair[<?= $id ?>][price]" placeholder="قیمت نهایی" aria-required="true" type="text" value="0">
                                <span class="input-group-addon">تومان برای هر عدد</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group field-<?= $id ?>-stair-factor required">
                            <label class="control-label sr-only" for="<?= $id ?>-stair-factor">ضریب</label>
                            <div class="input-group">
                                <input id="<?= $id ?>-stair-factor" class="form-control" name="Stair[<?= $id ?>][factor]" placeholder="ضریب" aria-required="true" type="text" value="1">
                                <span class="input-group-addon">عدد</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="col-md-2">
                    <button onclick="removeStair(<?= $id ?>)" type="button" id="add-tiraj" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                </div>
            </div>
        </div>

    </div>
</div>