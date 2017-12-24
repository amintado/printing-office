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
/* @var $model common\models\base\product\file\Files */
/* @var $form ActiveForm */
$js=<<<JS
jQuery('#mainform').yiiActiveForm('add',

{
    "id": "$id-files-name",
    "name": "$id-files-name",
    "container": ".field-$id-files-name",
    "input": "#$id-files-name",
    "validate": function (attribute, value, messages, deferred, \$form) {
        yii.validation.string(value, messages, {"message": "نام فایل باید یک رشته باشد.", "skipOnEmpty": 1});
        yii.validation.required(value, messages, {"message": "نام فایل نمی‌تواند خالی باشد."});

    }
});
JS;
$this->registerJs($js,View::POS_END);
?>
<div class="panel panel-default" id="file-<?= $id ?>">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group field-<?= $id ?>-files-required">

                    <div class="checkbox"><input name="Files[<?= $id ?>][required]" value="0" type="hidden">
                        <label>
                            <input id="files-<?= $id ?>-required" name="Files[<?= $id ?>][required]" value="1" type="checkbox">
                            اجباری</label>
                    </div>

                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-10">
                <div class="form-group field-<?= $id ?>-files-name required">
                    <label class="control-label" for="<?= $id ?>-files-name">نام فایل</label>
                    <input id="<?= $id ?>-files-name" class="form-control" name="Files[<?= $id ?>][name]" aria-required="true"
                           type="text">

                    <div class="help-block"></div>
                </div>
            </div>
            <br>
            <div class="col-md-2" style="margin-top: 5px">
                <button onclick="removeFile(<?= $id ?>)" type="button" id="add-tiraj" class="btn btn-danger"><i
                            class="glyphicon glyphicon-trash"></i></button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group field-files-pdf">

                    <div class="checkbox"><input name="Files[<?= $id ?>][pdf]" value="0" type="hidden"><label><input
                                    id="files-pdf" name="Files[<?= $id ?>][pdf]" value="1" type="checkbox"> Pdf</label></div>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group field-files-cdr">

                    <div class="checkbox"><input name="Files[<?= $id ?>][cdr]" value="0" type="hidden"><label><input
                                    id="files-cdr" name="Files[<?= $id ?>][cdr]" value="1" type="checkbox"> Cdr</label></div>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group field-files-txt">

                    <div class="checkbox"><input name="Files[<?= $id ?>][txt]" value="0" type="hidden"><label><input
                                    id="files-txt" name="Files[<?= $id ?>][txt]" value="1" type="checkbox"> Txt</label></div>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group field-files-jpg">

                    <div class="checkbox"><input name="Files[<?= $id ?>][jpg]" value="0" type="hidden"><label><input
                                    id="files-jpg" name="Files[<?= $id ?>][jpg]" value="1" type="checkbox"> Jpg</label></div>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group field-files-gif">

                    <div class="checkbox"><input name="Files[<?= $id ?>][gif]" value="0" type="hidden"><label><input
                                    id="files-gif" name="Files[<?= $id ?>][gif]" value="1" type="checkbox"> Gif</label></div>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group field-files-png">

                    <div class="checkbox"><input name="Files[<?= $id ?>][png]" value="0" type="hidden"><label><input
                                    id="files-png" name="Files[<?= $id ?>][png]" value="1" type="checkbox"> Png</label></div>

                    <div class="help-block"></div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group field-files-tif">

                    <div class="checkbox"><input name="Files[<?= $id ?>][tif]" value="0" type="hidden"><label><input
                                    id="files-tif" name="Files[<?= $id ?>][tif]" value="1" type="checkbox"> Tif</label></div>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group field-files-psd">

                    <div class="checkbox"><input name="Files[<?= $id ?>][psd]" value="0" type="hidden"><label><input
                                    id="files-psd" name="Files[<?= $id ?>][psd]" value="1" type="checkbox"> Psd</label></div>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group field-files-zip">

                    <div class="checkbox"><input name="Files[<?= $id ?>][zip]" value="0" type="hidden"><label><input
                                    id="files-zip" name="Files[<?= $id ?>][zip]" value="1" type="checkbox"> Zip</label></div>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group field-files-rar">

                    <div class="checkbox"><input name="Files[<?= $id ?>][rar]" value="0" type="hidden"><label><input
                                    id="files-rar" name="Files[<?= $id ?>][rar]" value="1" type="checkbox"> Rar</label></div>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group field-files-pptx">

                    <div class="checkbox"><input name="Files[<?= $id ?>][pptx]" value="0" type="hidden"><label><input
                                    id="files-pptx" name="Files[<?= $id ?>][pptx]" value="1" type="checkbox"> Pptx</label></div>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group field-files-ppt">

                    <div class="checkbox"><input name="Files[<?= $id ?>][ppt]" value="0" type="hidden"><label><input
                                    id="files-ppt" name="Files[<?= $id ?>][ppt]" value="1" type="checkbox"> Ppt</label></div>

                    <div class="help-block"></div>
                </div>
            </div>
        </div>

    </div>
</div>




