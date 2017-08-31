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

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup" style="direction: rtl">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h1 class="center-block"><?= Html::encode($this->title) ?></h1>

            <p class="pull-right" style="direction: rtl"><?= Yii::t('common', 'SinUp-1') ?></p>
        </div>
        <div class="col-md-4"></div>
    </div>


    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(
                    [
                            'id' => 'form-signup',
                        'action' => ['signup']
                    ]
            ); ?>

            <?= $form->field($model, 'username')->widget(MaskedInput::className(),
                [
                    'name' => 'username',
                    'model' => $model,
                    'mask' => '(0999) 99-99-99-9',
                    'options' =>
                        [
                            'placeholder' => '(0915) 00-00-00-0',
                            'class' => 'text-center form-control',
                            'style'=>'direction:ltr;font-size:20px',
                            'onkeydown'=>'return ( event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )'
                        ]
                ]) ?>


            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <div class="col-md-4"></div>


            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <p class="center-block">&copy; <?= Yii::$app->systemCore->companyName ?> <?= date('Y') ?></p>
        </div>
        <div class="col-md-4"></div>


        <p class="pull-right"><?php // Yii::powered() ?></p>
    </div>
</footer>
