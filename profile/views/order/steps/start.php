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

use common\models\Product;
use frontend\assets\GalleryAsset;
use yii\web\View;
GalleryAsset::register($this);
/**
 * @var $user User
 * @var $product Product
 * @var $this View
 */
$this->title='سفارش چاپ '.$product->title;
?>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-12">
            <!--Media and Description area -->
            <div class="pmd-card pmd-card-default pmd-z-depth">

            	<!-- Card media -->
                <div class="pmd-card-media">
                    <h2 class="center-block text-center">توضیحات محصول</h2>
                </div>

                <!-- Card body -->
                <div class="pmd-card-body">
                    <?= $product->description ?>
                </div>
            </div>

        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <!--Media and Description area -->
            <div class="pmd-card pmd-card-default pmd-z-depth">

            	<!-- Card media -->
                <div class="pmd-card-media">
                    <h2 class="center-block text-center">مشخصات محصول</h2>
                </div>
                <!-- Card body -->
                <div class="pmd-card-body">
                    <?= $product->specification ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!--Media and Description area -->
            <div class="pmd-card pmd-card-default pmd-z-depth">

            	<!-- Card media -->
                <div class="pmd-card-media">
                   <h2 class="center-block text-center">مشخصات فنی محصول</h2>
                </div>

                <!-- Card body -->
                <div class="pmd-card-body">
                   <?= $product->technical_specification ?>
                </div>
            </div>
        </div>
    </div>
</div>
