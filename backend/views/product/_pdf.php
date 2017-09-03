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
        <div class="col-sm-9">
            <h2><?= Yii::t('backend', 'Product').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'title',
        'description:ntext',
        'UUID',
        ['attribute' => 'lock', 'visible' => false],
        'restored_by',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerProductGallery->totalCount){
    $gridColumnProductGallery = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'url:url',
        'img_name',
        'UUID',
        ['attribute' => 'lock', 'visible' => false],
        'restored_by',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerProductGallery,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('backend', 'Product Gallery')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnProductGallery
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerProductSpecifications->totalCount){
    $gridColumnProductSpecifications = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'title',
        'UUID',
        ['attribute' => 'lock', 'visible' => false],
        'restored_by',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerProductSpecifications,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('backend', 'Product Specifications')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnProductSpecifications
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerProductStepProperty->totalCount){
    $gridColumnProductStepProperty = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'type',
        'title',
        'price',
        'mintotal',
        'requre',
                'value',
        'UUID',
        'restored_by',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerProductStepProperty,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('backend', 'Product Step Property')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnProductStepProperty
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerProductTechnicalSpecification->totalCount){
    $gridColumnProductTechnicalSpecification = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'texhnical_specifications',
        'UUID',
        'restored_by',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerProductTechnicalSpecification,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('backend', 'Product Technical Specification')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnProductTechnicalSpecification
    ]);
}
?>
    </div>
</div>
