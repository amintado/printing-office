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


use common\assets\FileInputAsset;
use yii\web\View;

/**
 *@var $this View
 */

FileInputAsset::register($this);
$this->registerJs("
$(\"#input-fa\").fileinput(
{
language: '".Yii::$app->systemCore->product['images']['language']."',
rtl: true,
'showUpload':false,
 'previewFileType':'".Yii::$app->systemCore->product['images']['previewFileType']."',
 theme: \"fa\",
  maxFileCount: ".Yii::$app->systemCore->product['images']['maxFileCount'].",
  showRemove: true,
  maxFileSize: ".Yii::$app->systemCore->product['images']['maxFileSize'].",
 }
);
",$this::POS_END);
?>
<input id="input-fa" type="file" class="file" multiple name="images[]" class="file-loading" >
