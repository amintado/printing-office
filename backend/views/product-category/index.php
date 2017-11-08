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

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductCategorySearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use common\models\base\ProductCategory;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\web\View;

$this->title = 'مدیریت دسته بندی محصولات';
$this->params['breadcrumbs'][] = $this->title;
$j=<<<JS
$('#createbtn').click(function(e) {
  e.preventDefault();
  $('#CreateModal').modal('show');
});
$('#cancel').click(function(e) {
  e.preventDefault();
  $('#CreateModal').modal('hide');
});
JS;
$this->registerJs($j,View::POS_END);
Modal::begin(['id' => 'CreateModal']);
echo $this->render('create',['model'=> $model]);
Modal::end();
?>
<div class="product-category-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('افزودن دسته', ['#'], ['class' => 'btn btn-success','id'=>'createbtn']) ?>
    </p>

    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',

        [
            'attribute' => 'status',
            'value' => function ($model) {
                if ($model->status == 1) {
                    return '<span class="label label-success">فعال</span>';
                } else {
                    return '<span class="label label-info">غیر فعال</span>';
                }
            },
            'format'=>'html'
        ],
        [
            'attribute' => 'product_model',
            'value' => function ($model) {
                if ($model->product_model==ProductCategory::MODEL_CHAPI){
                    return 'محصول چاپی';
                }else{
                    return 'محصول فروشگاهی';
                }
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{save-as-new} {view} {update} {delete}',
            'buttons' => [
                'save-as-new' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-copy"></span>', $url, ['title' => 'Save As New']);
                },
            ],
        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-product-category']],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => false,
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => false
    ]); ?>

</div>
