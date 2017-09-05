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
use kartik\tabs\TabsX;
use yii\helpers\Html;
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
?>
<style>
    .img-thumbnail-size {
        min-height: 80px;
        min-width: 80px;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <h4><?= $model->title ?></h4>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">


                <div class="col-md-5">


                    <!----------- Gallery ---------->
                    <?php

                    if (!empty($model->productGalleries)) {
                        $count = 0;
                        foreach ($model->productGalleries as $key => $value) {

                            if ($count == 0) {
                                echo ' <div class="row imagetiles">';
                            }

                            ?>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 img-thumbnail">
                                <div class=" img-thumbnail-size">
                                    <img src="<?= Yii::$app->systemCore->downloadURL . '/product/' . $model->id . '/' . $value->img_name ?>"
                                         class="img-responsive img-thumbnail" alt="Image">
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
                    <!----------- End Gallery ---------->


                </div>
                <div class="col-md-7">
                    <?= Html::decode($model->description) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= TabsX::widget(
                    [
                        'id' => 'details',
                        'position' => TabsX::POS_ABOVE,
                        'items' =>
                            [
                                [
                                    'label' => 'مشخصات ',
                                    'content' => $this->render('_viewSpecification', ['model' => $model]),
                                ],
                                [
                                    'label' => 'مشخصات فنی',
                                    'content' => $this->render('_viewTSpcification', ['model' => $model]),
                                ]
                            ]
                    ]
                ) ?>
            </div>
        </div>
    </div>
</div>
