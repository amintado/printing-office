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
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $InfoModel common\models\UserInfo */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => Yii::t('common', 'User'),
    ]) . ' ' . $model->username;

$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="users-update">


    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <?= $this->render('_form', [
            'model' => $model,
            'InfoModel' => $InfoModel,
            'mode' => 'update',
            'form' => $form

        ]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary circle']) ?>
        <?= Html::a(Yii::t('common', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
