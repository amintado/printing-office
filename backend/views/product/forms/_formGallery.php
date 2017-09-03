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
use common\models\Product;
use kartik\widgets\FileInput;
use yii\web\View;

/**
 * @var $this View
 * @var $model Product
 */

FileInputAsset::register($this);
$this->registerJs("
$(\"#input-fa\").fileinput(
{
language: '" . Yii::$app->systemCore->product['images']['language'] . "',
rtl: true,
'showUpload':true,
 'previewFileType':'" . Yii::$app->systemCore->product['images']['previewFileType'] . "',
 theme: \"fa\",
  maxFileCount: " . Yii::$app->systemCore->product['images']['maxFileCount'] . ",
  showRemove: true,
  maxFileSize: " . Yii::$app->systemCore->product['images']['maxFileSize'] . ",
 }
);
", $this::POS_END);


echo $form->field($model, 'images[]')->widget(FileInput::classname(), [
    'options' =>
        [
            'accept' => 'image/*',
            'multiple' => true,
//            'name' => 'images[]',
            'enctype'=>'multipart/form-data'
        ],
]);
if (!empty($mode) and $mode=='update'){
        echo $this->render('@backend/views/product/view_galery',
            [
                'form'=>$form,
                'model'=>$model
            ]
            );
}
?>
