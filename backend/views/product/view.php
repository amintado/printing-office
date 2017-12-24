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
use kartik\tabs\TabsX;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <div class="row">
        <div class="col-sm-8">
            <h3>هش : <?= $model->hash_id ?> </h3>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
            <?php
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('backend', 'PDF'),
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('backend', 'Will open the generated PDF file in a new window')
                ]
            ) ?>
            <?= Html::a(Yii::t('backend', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>


    <!----------- Content ---------->
    <div class="row" style="margin-top: 30px">
        <div class="container-fluid">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= Yii::t('common', 'Product Details') ?></h3>
                    </div>
                    <div class="panel-body">
                        <?php

                        echo TabsX::widget(
                            [
                                'encodeLabels' => false,
                                'pluginOptions' => [
                                    'bordered' => true,
                                    'sideways' => true,
                                    'enableCache' => false,
                                ],
                                'position' => TabsX::POS_RIGHT,
                                'items' =>
                                    [
                                        [
                                            'label' => Yii::t('backend', 'Product Base Detail'),
                                            'icon' => 'inbox',
                                            'format' => 'html',
                                            'content' => Html::decode($model->description)
                                        ],
                                        [
                                            'label' => Yii::t('backend', 'Product Technical Specification'),
                                            'content' =>
                                                !empty($model->technical_specification) ? Html::decode($model->technical_specification) : ''
                                        ],
                                        [
                                            'label' => Yii::t('backend', 'Product Specification'),
                                            'content' => !empty($model->specification) ? Html::decode($model->specification) : ''
                                        ],
                                        [
                                            'label' => Yii::t('backend', 'Product Gallery'),
                                            'content' => $this->render('view_galery', ['model' => $model])
                                        ]

                                    ]
                            ]
                        )

                        ?>


                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <?= $model->showSidePanel() ?>
            </div>

        </div>
    </div>


</div>
