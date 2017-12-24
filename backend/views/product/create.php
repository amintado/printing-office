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

use common\models\Product;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = Yii::t('backend', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="product-create">
    <div class="row">
        <div class="col-md-9">

            <?php
            $form = ActiveForm::begin(['id' => 'mainform']);
            ?>

            <?= $this->render('_form', [
                'model' => $model,
                'form' => $form,
                'mode'=>'create'
            ]) ?>


        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">مدیریت وضعیت</h3>
                        </div>
                        <div class="panel-body">
                            <?= $form->field($model, 'status')->widget(Select2::className(),
                                [
                                    'data' =>
                                        [
                                            Product::STATUS_ACTIVR => Yii::t('backend', 'Product Status Active'),
                                            Product::STATUS_INACTIVE => Yii::t('backend', 'Product Status INActive'),

                                        ]
                                ]
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">انتشار</h3>
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
                                            <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                        <?php endif; ?>
                                        <?php if (Yii::$app->controller->action->id != 'create'): ?>
                                            <?= Html::submitButton(Yii::t('backend', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
                                        <?php endif; ?>
                                        <?= Html::a(Yii::t('backend', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <?php ActiveForm::end(); ?>


</div>
