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

use common\assets\FileInputAsset;
use common\models\Role;
use common\models\User;
use kartik\select2\Select2;
use kartik\widgets\FileInput;
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

    

    $('#input-fa').fileinput(
    {
    language: '" . Yii::$app->systemCore->product['images']['language'] . "',
    rtl: true,
    'showUpload':false,
     'previewFileType':'" . Yii::$app->systemCore->product['images']['previewFileType'] . "',
     theme: 'fa',
      maxFileCount: " . Yii::$app->systemCore->product['images']['maxFileCount'] . ",
      showRemove: true,
      maxFileSize: " . Yii::$app->systemCore->product['images']['maxFileSize'] . ",
     }
    );

    
    
    
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

    <?= $form->field($model, 'username')->widget(MaskedInput::className(),
        [
            'name' => 'username',
            'model' => $model,
            'mask' => '(0999) 99-99-99-9',
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
                    || (event.keyCode==46) )'
                ]
        ]) ?>

    <?= $form->field($model, 'RoleID')->widget(Select2::className(),
        [
            'data' => ArrayHelper::map(Role::find()->all(), 'id', 'name')
        ]); ?>

    

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'ایمیل: user@domain.reg', 'type' => "text"]) ?>



    <?= $form->field($model, 'status')->widget(Select2::className(), [
        'data' => User::statuses_select2(),
    ]) ?>
    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' =>
            [
                'accept' => 'image/*',
                'multiple' => true,
//            'name' => 'images[]',
                'enctype'=>'multipart/form-data'
            ],
    ]); ?>

</div>


