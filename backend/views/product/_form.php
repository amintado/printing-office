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

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
/* @var $mode string */
$_url_file = Yii::$app->urlManager->createUrl(['/product/add-file']);
$_url_tiraj = Yii::$app->urlManager->createUrl(['/product/add-tiraj']);
$_url_tiraj_stair = Yii::$app->urlManager->createUrl(['/product/add-stair-tiraj']);
$_url_property = Yii::$app->urlManager->createUrl(['/product/add-property']);
$_csrf = Yii::$app->request->csrfToken;
$js = <<<JS
var file=0;
var tiraj=0;
var stair=0;
function addFilePanel() {
  $.ajax({
          method: 'POST',
          url: '$_url_file',
          data: {_csrf: '$_csrf',id:file},
  
          success: function (data) {
            $('#file-forms').append(data);
              file++;
          }
      });
}
function addTirajPanel() {
  $.ajax({
          method: 'POST',
          url: '$_url_tiraj',
          data: {_csrf: '$_csrf',id:tiraj},
  
          success: function (data) {
            $('#tiraj-forms').append(data);
              stair=0;
              tiraj++;
          }
      });
}
function addStairPanel() {
  $.ajax({
          method: 'POST',
          url: '$_url_tiraj_stair',
          data: {_csrf: '$_csrf',id:stair},
  
          success: function (data) {
            $('#tiraj-forms').append(data);
            tiraj=0;  
            stair++;
          }
      });
}
$('#fixed').click(function() {
    $('#tiraj-forms').html('<button onclick="addTirajPanel()" type="button" id="add-tiraj" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></button>');
    removeTiraj(null);
    addTirajPanel();
});

$('#stair').click(function() {
    $('#tiraj-forms').html('<button onclick="addStairPanel()" type="button" id="add-tiraj" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></button>');
    removeTiraj(null);
    addStairPanel();
});
$('button[type="submit"]').click(function(e) {
    var forms=$('form').toArray();
    $.each(forms,function(i,l) {
        if(l.id=='mainform'){
            console.log('W0 form:');
            console.log(i);
             console.log(l);
        }else{
            $(l).replaceTag('<div>', true);
        }
      
    });
    console.log(forms);
  var inputs=$('[aria-required="true"]').toArray();
    $.each(inputs,function(i,l) {
        // console.log(l);
         var id=l.id;
         var el=$('#'+id);
         // console.log('tagnem:'+el.prop('tagName'));
        switch (el.prop('tagName')){
            case 'INPUT':               
                if(el.val()==null | el.val()==''){
                   e.preventDefault();
                   error(id);
                     console.log('null');
                }
                break;
                case 'TEXTAREA':
               
                if(el.val()==null | el.val()==''){
                  e.preventDefault();
                    // console.log('null');
                    error(id);
                }
                break;
        }
    })
});

function addProperty(){
 $.ajax({
          method: 'POST',
          url: '$_url_property',
          data: {_csrf: '$_csrf'},
  
          success: function (data) {
            $('#property-forms').append(data);
              
          }
      });
}

function error(id){
    var el=$('#'+id);
    var name=$('.control-label[for="'+id+'"]').text();
    var fg=$('.field-'+id);
    var es=$('.error-summary');
    fg.addClass('has-error');
    fg.css('color','red');
    el.css('border-color','red');
    fg.find('.help-block').text('این فیلد نمیتواند خالی باشد');
    es.find('p').text('لطفا خطاهای داخل فرم را رفع نمایید:');
   console.log("$.isEmptyObject($('#error-"+id+"')");
   console.log( $('#error-'+id));
   console.log($('#error-'+id));
   if(0 in $('#error-'+id)){
       console.log('finded');
       es.find('ul').remove();
       es.append('<ul></ul>');
   }
       es.attr('style','display:block');


}

function removeFile(num){
 $('#mainform').yiiActiveForm('remove',num+'-files-name');
 $('#file-'+num).remove();
};
function removeTiraj(num){
     if(num==null){
     if(tiraj>0){
                 for (var i = 0; i < tiraj; i++){
                     console.log('id:'+i);
                     $('#mainform').yiiActiveForm('remove',i+'-tiraj-tiraj');  
                     $('#mainform').yiiActiveForm('remove',i+'-tiraj-price');   
                 }

     }
    if(stair>0){
                 for (var i = 0; i < stair; i++){
                     console.log('id:'+i);
                     $('#mainform').yiiActiveForm('remove',i+'-stair-from');  
                     $('#mainform').yiiActiveForm('remove',i+'-stair-to');   
                     $('#mainform').yiiActiveForm('remove',i+'-stair-price');   
                     $('#mainform').yiiActiveForm('remove',i+'-stair-factor');   
                 }
    
     }

      
  } else{
     $('#mainform').yiiActiveForm('remove',num+'-tiraj-tiraj'); 
     $('#mainform').yiiActiveForm('remove',num+'-tiraj-price'); 
 
     $('#ritaj-'+num).remove();
  }
};
function removeStair(num){
     if(num==null){
     if(tiraj>0){
                 for (var i = 0; i < tiraj; i++){
                     console.log('id:'+i);
                     $('#mainform').yiiActiveForm('remove',i+'-tiraj-tiraj');  
                     $('#mainform').yiiActiveForm('remove',i+'-tiraj-price');   
                 }
                 tiraj=0;

     }
    if(stair>0){
                 for (var i = 0; i < stair; i++){
                     console.log('id:'+i);
                     $('#mainform').yiiActiveForm('remove',i+'-stair-from');  
                     $('#mainform').yiiActiveForm('remove',i+'-stair-to');   
                     $('#mainform').yiiActiveForm('remove',i+'-stair-price');   
                     $('#mainform').yiiActiveForm('remove',i+'-stair-factor');   
                 }
                 stair=0;
    
     }

      
  } else{
     $('#mainform').yiiActiveForm('remove',num+'-stair-from'); 
     $('#mainform').yiiActiveForm('remove',num+'-stair-to'); 
     $('#mainform').yiiActiveForm('remove',num+'-stair-price'); 
     $('#mainform').yiiActiveForm('remove',num+'-stair-factor'); 
     $('#stair-'+num).remove();
  }
};
JS;
$this->registerJs($js, View::POS_END);
?>

<div class="product-form">


    <?= $form->errorSummary($model); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Title']) ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">اطلاعات محصول</h3>
        </div>
        <div class="panel-body">


            <?php
            $forms = [

                [
                    'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('backend', 'Product Base Detail')),
                    'content' => $this->render('forms/_formBaseDetails',
                        [
                            'model' => $model,
                            'form' => $form
                        ]
                    ),
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('backend', 'Product Specification')),
                    'content' => $this->render('forms/_formSpecification',
                        [
                            'model' => $model,
                            'form' => $form
                        ]
                    ),
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('backend', 'Product Technical Specification')),
                    'content' => $this->render('forms/_formTechnicalSpecifications',
                        [
                            'model' => $model,
                            'form' => $form
                        ]
                    ),
                ],

                [
                    'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('backend', 'Product Gallery')),
                    'content' => $this->render('forms/_formGallery',
                        [
                            'model' => $model,
                            'form' => $form,
                            'mode' => $mode
                        ]
                    ),
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('ابعاد'),
                    'content' => $this->render('forms/dimensions/_form',
                        [
                            'model' => $model,
                            'form' => $form,
                            'mode' => $mode
                        ]
                    ),
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('فایل'),
                    'content' => '<div class="row"><div class="col-md-12"><div id="file-forms">
<button onclick="addFilePanel()" type="button" id="add-File" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></button>
</div></div></div>'
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('تیراژ
            '),
                    'content' => '
                        <div class="row">
                            <div class="col-md-3">'.Html::radio('tiraj',true,['label'=>'ثابت','id'=>'fixed','value'=>'fixed']).'</div>
                            <div class="col-md-3">'.Html::radio('tiraj',false,['label'=>'دلخواه','id'=>'stair','value'=>'stair']).'</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="tiraj-forms">
                                    <button onclick="addTirajPanel()" type="button" id="add-tiraj" class="btn btn-success">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>'
                ],
                [
                    'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('ویژگی ها
            '),
                    'content' => '
                        <div class="row">
                            <div class="col-md-12">
                                <div id="property-forms">
                                    <button onclick="addProperty()" type="button" id="add-property" class="btn btn-success">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>'
                ],
            ];
            echo kartik\tabs\TabsX::widget([
                'items' => $forms,
                'position' => kartik\tabs\TabsX::POS_ABOVE,
                'encodeLabels' => false,
                'pluginOptions' => [
                    'bordered' => true,
                    'sideways' => true,
                    'enableCache' => false,
                ],
            ]);
            ?>
        </div>
    </div>

</div>
