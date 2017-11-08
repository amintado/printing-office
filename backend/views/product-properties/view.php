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

use common\models\base\ProductProperties;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\base\ProductProperties */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-properties-view">

    <div class="row">
        <div class="col-sm-8">

        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'یک فایل PDF از داده های انتخابی در پنجره ی جدید نمایش داده خواهد شد'
                ]
            )?>
            <?= Html::a('ایجاد کپی', ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a('بروزرسانی', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('حذف', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' =>'برای حذف این مورد اطمینان دارید؟',
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
            'attribute'=>'mode',
            'value'=>function($model){
                switch ($model->mode){
                    case ProductProperties::MODE_CHAPI:
                        return 'محصولات چاپی';
                        break;
                    case ProductProperties::MODE_SHOP:
                        return 'محصولات فروشگاهی';
                        break;

                }
            }
        ],
        [
            'attribute'=>'group',
            'value'=>function($model){

                return $model->groupname;
            }
        ],
        [
            'attribute'=>'status',
            'value'=>function($model){
                switch ($model->status){
                    case ProductProperties::STATUS_ACTIVE:
                        return '<span class="label label-success">فعال</span>';
                        break;
                    case ProductProperties::STATUS_INACTIVE:
                        return '<span class="label label-success">غیر فعال</span>';
                        break;
                }
            },
            'format'=>'html'
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
</div>
