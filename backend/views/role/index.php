<?php

use yii\helpers\Html;
use yii\grid\GridView;
use jDate\DatePicker;
use common\components\functions;

$this->title = Yii::t('backend', 'Menu - User Role');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@assets/js/page_number.js');
?>
<div class="role-index">

    <div class="col-lg-2">
        <?= Html::a(Yii::t('backend', 'Create Role'), ['create'], ['class' => 'btn btn-success btn-block']) ?>
    </div>
    <div class="col-lg-2">
        <?= Html::dropDownList('per-page', $dataProvider->pagination->pageSize, [5 => 5, 10 => 10, 20 => 20, 50 => 50, 100 => 100, 500 => 500], ['class' => 'form-control', 'onchange' => 'page_number(this);', 'prompt' => Yii::t('backend', 'Display Num')]) ?>
    </div>
    <div class="clearfix"></div><br/>
    
    <div class="col-lg-12">


        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'name',
                [
                    'attribute' => 'description',
                    'format' => 'html',
                    'contentOptions'=>['style'=>'white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width:200px;'],
                ],
                [
                    'attribute' => 'RegisterTime',
                    'filter' => DatePicker::widget(['model'=>$searchModel,'attribute'=>'RegisterTime','options' => ['class'=>'form-control','style'=>'text-align:center;']]),
                    'contentOptions'=>['style'=>'direction:ltr;text-align:center;width:180px;'],
                    'value' => function ($model) {
                            return functions::convertdatetime($model->RegisterTime);
                    },
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}',
                ],
            ],
        ])
        ?>

    </div>

    <div class="clearfix"></div>

</div>
