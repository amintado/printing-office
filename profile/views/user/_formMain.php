<?php
use backend\assets\FileInputAsset;
use common\models\Role;
use common\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\View;

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

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true, 'placeholder' => 'مثال : 09353466620','onkeydown'=>'return ( event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )']) ?>


</div>
<div class="row">
    <div class="col-md-10">
        <label class="control-label">تصویر پروفایل را بارگذاری کنید</label>
        <input id="Image" name="Images[]" type="file" multiple class="file-loading"></div>
</div>

