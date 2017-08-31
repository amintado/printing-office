<?php
/**
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 */

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserMode */

$this->title = Yii::t('backend', 'Save As New {modelClass}: ', [
    'modelClass' => 'Taban User Mode',
]). ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Taban User Modes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Save As New');
?>
<div class="taban-user-mode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
