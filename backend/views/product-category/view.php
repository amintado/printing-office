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

use common\models\base\ProductCategory;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\base\ProductCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Product Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-view">

    <div class="row">
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4" style="margin-top: 15px">

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

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'name',
            [
                'attribute' => 'description',
                'format' => 'html'
            ],

            [
                'attribute' => 'status',
                'value' => function ($model) {
                    if ($model->status == 1) {
                        return '<span class="label label-success">فعال</span>';
                    } else {
                        return '<span class="label label-info">غیر فعال</span>';
                    }
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'product_model',
                'value' => function ($model) {
                    if ($model->product_model == ProductCategory::MODEL_CHAPI) {
                        return 'محصول چاپی';
                    } else {
                        return 'محصول فروشگاهی';
                    }
                }
            ],
            [
                'attribute' => 'picture',
                'value' => function ($model) {
                        return '<img src="/dl/productcategory/'.$model->picture.'" class="img-responsive" alt="Image">';
                },'format'=>'html'
            ]
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>
