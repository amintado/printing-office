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

use common\models\base\Product;
use common\models\ProductGallery;
use yii\helpers\Html;

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
 */
?>


    <div class="row">
        <h4>محصولات</h4 class="center-block">

    </div>
    <div class="row">

        <!----------- Product Card ---------->
        <?php
        foreach ($model as $key => $value) {
            /**
             * @var $value Product
             */
            ?>
            <a href="<?= Yii::$app->urlManager->createUrl('/product/'.$value->hash_id) ?>">
                <div class="col-md-3" style="max-height: 200px;">
                    <?php

                    if (!empty($value->productGalleries)) {


                        ?>

                        <div class="row text-center" style="color:#555a61;font-size: 18px"><?= $value->title ?></div>
                        <div class="row">
                            <img src="<?= Yii::$app->systemCore->downloadURL . '/product/' . $value->id . '/' . $value->productGalleries[0]->img_name ?>"
                                 alt="..." class="img-thumbnail center-block" style="max-height: 200px">
                        </div>
                        <div class="row" style="color: #555a61;">
                            <?= strip_tags($value->description,'br') ?>
                        </div>

                        <?php

                    }
                    ?>
                </div>
            </a>
            <?php
        }

        ?>

    </div>

