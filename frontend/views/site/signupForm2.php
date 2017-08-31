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

use frontend\models\SignupForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var SignupForm $model
 */
$form=ActiveForm::begin(
    [
        'id' => 'signUp-step-2',
        'action' => ['signup-step2']
    ]
)
?>

<div class="container">
    <div class="row" style="margin-top: 40vh">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">جهت تکمیل ثبت نام، اطلاعات زیر را وارد کنید:</h3>
                </div>
                <div class="panel-body">
                    <?= $form->errorSummary($model) ?>

                    <?= $form->field($model,'id')->hiddenInput()->label(false) ?>

                    <?= $form->field($model,'name')->textInput() ?>

                    <?= $form->field($model,'family')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= Html::submitButton('ارسال',['class'=>'btn btn-primary','name' => 'signup-button']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<?php ActiveForm::end() ?>