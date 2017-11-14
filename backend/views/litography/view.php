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
/* @var $model common\models\base\Litography */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Litographies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="litography-view">

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
            ) ?>
            <?= Html::a('ایجاد یک کپی', ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a('بروزرسانی', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('حذف', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'این آیتم حذف خواهد شد،از این بابت اطمینان دارید؟',
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
            'telephone',
            'address',
            [
                'attribute' => 'descriptions',
                'format' => 'html'
            ]
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>
