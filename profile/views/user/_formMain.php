<?php
/**
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 */

use backend\assets\FileInputAsset;
use common\models\Role;
use common\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $mode string */
/* @var $this View */
FileInputAsset::register($this);
$this->registerJs("

    
        $(\"#Image\").fileinput({
            rtl: false,
            allowedFileExtensions: [\"jpg\", \"png\",\"jpeg\"],
            showUpload: false,
            maxFileCount: 1,
            mainClass: \"input-group-lg\"
        });
    
    
    
    function validate(evt) {
      var theEvent = evt || window.event;
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode( key );
      var regex = /[0-9]|\./;
      if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
      }
    }

");

?>
<div class="users-form col-md-4">



    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>


    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'ایمیل: user@domain.reg', 'type' => "text"]) ?>


    <?= $form->field($model, 'username')->widget(MaskedInput::className(),
        [
            'name' => 'mobile',
            'model' => $model,
            'mask' => '(9999) 99-99-99-9',
            'options' =>
                [
                    'placeholder' => '(0915) 00-00-00-0',
                    'class' => 'text-center form-control',
                    'style'=>'direction:ltr;font-size:20px',
                    'onkeydown'=>'return ( event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )',
                    'disabled'=>'disabled'
                ]
        ]) ?>


</div>
<div class="row">
    <div class="col-md-10">
        <label class="control-label">تصویر پروفایل را بارگذاری کنید</label>
        <input id="Image" name="Images[]" type="file" multiple class="file-loading"></div>
</div>

