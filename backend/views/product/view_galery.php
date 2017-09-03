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

use common\assets\MasonaryGalleryAsset;
use common\models\base\Product;
use yii\bootstrap\Modal;
use yii\web\AssetBundle;
use yii\web\View;

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

/**
 * @var $model Product
 * @var $this View
 */
$this->registerJs("
      function picRemove(id) {
        $('#PicDeleteAlert').modal('show');

$('.delete-pic').click(function () {

              $.ajax({
                    method: 'POST',
                    url: '" . Yii::$app->urlManager->createUrl('product/delete-pic') . '?id='."' + id,
                    data:{_csrf: '" . Yii::$app->request->csrfToken . "'},
                success: function (data) {
               
                    if (data.message=='ok') {
                        $('#PicDeleteAlert').modal('hide');
                        $('#' + id).remove();
                    }else{
                        $('#PicDeleteAlert').modal('hide');
                       
                    }
                }
            });  

  
        })
        
    }


    $('.modal-close').click(function () {
        $('#PicDeleteAlert').modal('hide');
    });
     

", $this::POS_END);
Modal::begin([
    'id' => 'PicDeleteAlert',
    'header' => '<h4>' . Yii::t('common', 'DELETE ALERT TITLE') . '</h4>',
    'footer' =>
        '
<div class="col-md-3">
<button type="button" class="btn btn-danger delete-pic">' . Yii::t('common', 'DELETE') . '</button>
</div>
<div class="col-md-3">
<button type="button" class="btn btn-default modal-close">.' . Yii::t('common', 'Cancel') . '</button>
</div>

'

]);

echo Yii::t('common', 'Hard Delete Alert Message');

Modal::end();
?>


<script>

</script>
<style>
    .img-thumbnail-size {
        min-height: 156px
    }
</style>
<div class="container-fluid">

    <?php

    if (!empty($model->productGalleries)) {
        $count = 0;
        foreach ($model->productGalleries as $key => $value) {

            if ($count == 0) {
                echo ' <div class="row imagetiles">';
            }

            ?>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 img-thumbnail">
                <div class="row img-thumbnail-size">
                    <img src="<?= Yii::$app->systemCore->downloadURL . '/product/' . $model->id . '/' . $value->img_name ?>"
                         class="img-responsive " alt="Image">
                </div>
                <div class="row">

                    <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2 " id="<?= $value->hash_id ?>">
                        <button type="button" class="btn btn-default deletepic" id="deletepic" aria-label="Left Align"
                                onclick="picRemove('<?= $value->hash_id ?>')">
                            <span class=" glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>

            </div>
            <?php
            if ($count == 2) {
                echo ' </div>';
                $count = 0;
            } else {
                if (empty($model->productGalleries[$key + 1])) {
                    echo '</div>';
                }
                $count++;
            }
        }
    }
    ?>


</div>



