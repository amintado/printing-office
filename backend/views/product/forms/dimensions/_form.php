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

use common\models\base\product\dimensions\MultifixedDimensions;
use yii\web\View;

/**
 * @var $this View
 */
$_url_multiple = Yii::$app->urlManager->createUrl(['/product/dimension-form-multiple']);
$_url_fixed = Yii::$app->urlManager->createUrl(['/product/dimension-form-fixed']);
$_url_variable = Yii::$app->urlManager->createUrl(['/product/dimension-form-variable']);
$_csrf = Yii::$app->request->csrfToken;
$js = <<<JS
var sc='';
var total=1;
$('input[type=radio]').on('click',function() {
   
  
  
  switch ($('input[name=dimensions]:checked').val()){
      case 'variable':
          
          $.ajax({
                  method: 'POST',
                  url: '$_url_variable',
                  data: {_csrf: '$_csrf',id:0},
                  success: function (data) {
                      
                      removeMultifix(null);
                      $('#dimension-form').html(data);
                      
                  }
              });
         
          break;
      case 'fixed':
           $.ajax({
                  method: 'POST',
                  url: '$_url_fixed',
                  data: {_csrf: '$_csrf',id:0},
                  success: function (data) {
                      removeMultifix(null);
                      $('#dimension-form').html(data);

                  }
              });
          break;
      case 'multiple':
          
           $.ajax({
                  method: 'POST',
                  url: '$_url_multiple',
                  data: {_csrf: '$_csrf',id:0},
                  success: function (data) {
                      removeMultifix(null);
                      $('#dimension-form').html(data);
                      $('#dimension-form').prepend('<button onclick="addDimensionPanel()" type="button" id="add-dimention" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></button>');
                  }
              });
          break;
  }
});
function removeMultifix(num){
  if(num==null){
     if(total>0){
                 for (var i = 0; i < total; i++){
                     console.log('id:'+i);
                     $('#mainform').yiiActiveForm('remove','multifixeddimensions-'+i+'-fixed_height');  
                     $('#mainform').yiiActiveForm('remove','multifixeddimensions-'+i+'-fixed_width');  
                     $('#mainform').yiiActiveForm('remove','multifixeddimensions-'+i+'-price'); 
                 }

     }
     $('#mainform').yiiActiveForm('remove','fixeddimensions-0-fixed_width'); 
     $('#mainform').yiiActiveForm('remove','fixeddimensions-0-fixed_height'); 
     $('#mainform').yiiActiveForm('remove','fixeddimensions-0-price');

      
      $('#mainform').yiiActiveForm('remove','variabledimensions-0-base_width');  
      $('#mainform').yiiActiveForm('remove','variabledimensions-0-base_height');  
      $('#mainform').yiiActiveForm('remove','variabledimensions-0-min_height');  
      $('#mainform').yiiActiveForm('remove','variabledimensions-0-min_width');  
      $('#mainform').yiiActiveForm('remove','variabledimensions-0-max_height');  
      $('#mainform').yiiActiveForm('remove','variabledimensions-0-max_width');  
      $('#mainform').yiiActiveForm('remove','variabledimensions-0-price');  

  } else{
     $('#mainform').yiiActiveForm('remove','multifixeddimensions-'+num+'-fixed_width'); 
     $('#mainform').yiiActiveForm('remove','multifixeddimensions-'+num+'-fixed_height'); 
     $('#mainform').yiiActiveForm('remove','multifixeddimensions-'+num+'-price');  
     $('#multifix-'+num).remove();
  }
};
function addDimensionPanel() {
   $.ajax({
                  method: 'POST',
                  url: '$_url_multiple',
                  data: {_csrf: '$_csrf',id:total},
                  success: function (data) {
                      $('#dimension-form').append(data);
                      
                      total++;
                  }
              });
};
JS;
$this->registerJs($js, View::POS_END);

?>
<div class="row">
    <div class="col-md-3">
        <div class="radio">
            <label>
                <input type="radio" name="dimensions" id="dimensions-fixed" value="fixed">
                ابعاد ثابت
            </label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="radio">
            <label>
                <input type="radio" name="dimensions" id="dimensions-multiple" value="multiple">
                چندین ابعاد ثابت
            </label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="radio">
            <label>
                <input type="radio" name="dimensions" id="dimensions-variable" value="variable">
ابعاد در بازه خاص
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div id="dimension-form"></div>
    </div>
</div>





