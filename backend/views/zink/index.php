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
/* @var $searchModel common\models\ZinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use common\models\base\Zink;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'مدیریت زینک ها';
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
Modal::begin(['id' => 'CreateModal','header' => '<h3>افزودن زینک</h3>']);
echo $this->render('create',['model'=> $model]);
Modal::end();
?>
<style>
    .modal-dialog{
        width: 90vw;
    }
</style>
<div class="zink-index">

    <p>
        <?= Html::a('افزودن زینک', ['#'], ['class' => 'btn btn-success','id'=>'createbtn']) ?>

    </p>
    <?php 
    $gridColumn = [
        'name',
        'mode',
        [
            'attribute'=>'status',
            'value'=>function($model){
                switch ($model->status){
                    case Zink::STATUS_ACTIVE:
                        return '<span class="label label-success">فعال</span>';
                        break;
                    case Zink::STATUS_INACTIVE:
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
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-zink']],
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
