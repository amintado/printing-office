<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Menu - Settings');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@assets/js/page_number.js');
?>
<div class="settings-index">

    <div class="col-lg-2">
        <?= Html::a(Yii::t('backend', 'Create Settings'), ['create'], ['class' => 'btn btn-success btn-block']) ?>
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

                'setting_id',
                'setting_key',
                'setting_value',
                'setting_description',

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
