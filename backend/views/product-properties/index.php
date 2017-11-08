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
/* @var $searchModel common\models\ProductPropertiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use common\models\base\ProductProperties;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'مدیریت ویژگی محصولات';
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
$this->registerJs($j);
Modal::begin(['id' => 'CreateModal','header' => '<h3>افزودن ویژگی</h3>']);
echo $this->render('create',['model'=> $model]);
Modal::end();
?>
<div class="product-properties-index">

    <p>
        <?= Html::a('افزودن ویژگی', ['#'], ['class' => 'btn btn-success','id'=>'createbtn']) ?>

    </p>
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
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-product-properties']],
        'panel' => [
            'type' => GridView::TYPE_ACTIVE,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'استخراح همه ی اطلاعات',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">استخراج همه ی اطلاعات</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>
