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
/* @var $searchModel common\models\ProductPropertyGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use common\models\base\ProductPropertyGroups;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'مدیریت گروه های ویژگی محصولات';
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
Modal::begin(['id' => 'CreateModal','header' => '<h3>افزودن گروه</h3>']);
echo $this->render('create',['model'=> $model]);
Modal::end();
?>
<div class="product-property-groups-index">

    <p>
        <?= Html::a('اقزودن گروه', ['#'], ['class' => 'btn btn-success','id'=>'createbtn']) ?>

    </p>
    <?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        [
            'attribute'=>'status',
            'value'=>function($model){
                switch ($model->status){
                    case ProductPropertyGroups::STATUS_ACTIVE:
                        return '<span class="label label-success">فعال</span>';
                        break;
                    case ProductPropertyGroups::STATUS_INACTIVE:
                        return '<span class="label label-success">غیر فعال</span>';
                        break;
                }
            },
            'format'=>'html'
        ],        [
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
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-product-property-groups']],
        'panel' => [
            'type' => GridView::TYPE_ACTIVE,
            'heading' => false,
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => false,
    ]); ?>

</div>
