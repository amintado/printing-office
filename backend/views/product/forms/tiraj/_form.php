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
use yii\helpers\Html;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model common\models\base\product\tiraj\Tiraj */
/* @var $form ActiveForm */
$js=<<<JS
$('#mainform').yiiActiveForm('add', 
{
    id: '$id-tiraj-tiraj',
    name: '$id-tiraj-tiraj',
    container: '.field-$id-tiraj-tiraj',
    input: '#$id-tiraj-tiraj',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "تعداد تیراژ ثابت باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "تعداد تیراژ ثابت نمیتواند خالی باشد"});
    }
});
$('#mainform').yiiActiveForm('add', 
{
    id: '$id-tiraj-price',
    name: '$id-tiraj-price',
    container: '.field-$id-tiraj-price',
    input: '#$id-tiraj-price',
    error: '.help-block',
    validate:  function (attribute, value, messages, deferred, \$form) {
        yii.validation.number(value, messages, {
            "pattern": /^\s*[+-]?\d+\s*$/,
            "message": "قیمت تیراژ ثابت باید یک عدد صحیح باشد.",
            "skipOnEmpty": 1
        });
        yii.validation.required(value, messages, {message: "قیمت تیراژ ثابت نمیتواند خالی باشد"});
    }
});

JS;
$this->registerJs($js,View::POS_END);
?>

<div class="panel panel-default" id="ritaj-<?= $id ?>">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group field-<?= $id ?>-tiraj-tiraj required">
                    <label class="control-label sr-only" for="<?= $id ?>-tiraj-tiraj">تیراژ</label>
                    <div class="input-group">
                        <input id="<?= $id ?>-tiraj-tiraj" class="form-control" name="Tiraj[<?= $id ?>][tiraj]" placeholder="تیراژ" aria-required="true" aria-invalid="true" type="text">
                        <span class="input-group-addon">عدد</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group field-<?= $id ?>-tiraj-price required">
                    <label class="control-label sr-only" for="<?= $id ?>-tiraj-price">قیمت نهایی</label>
                    <div class="input-group">
                        <input id="<?= $id ?>-tiraj-price" class="form-control" name="Tiraj[<?= $id ?>][price]" placeholder="قیمت نهایی" aria-required="true" type="text" value="0">
                        <span class="input-group-addon">تومان برای هر عدد</span>
                    </div>


                </div>
            </div>
            <div class="col-md-2">
                <button onclick="removeTiraj(<?= $id ?>)" type="button" id="add-tiraj" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
            </div>
        </div>
    </div>
</div>