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
use yii\widgets\MaskedInput;

$form=ActiveForm::begin(
    [
    'id' => 'verify-form',
        'action' => ['verify']
    ]
);
/**
 * @var $model SignupForm
 */

?>
<div class="container">
    <div class="row" style="margin-top: 20vh">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-center" style="direction: rtl">کد ارسال شده به تلفن همراهتان را وارد کنید:</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model,'VerificationCode')->widget(MaskedInput::className(),
                        [
                            'name' => 'VerificationCode',
                            'model' => $model,
                            'mask' => '9-9-9-9',
                            'options' =>
                                [
                                    'placeholder' => 'X-X-X-X',
                                    'class' => 'text-center form-control',
                                    'style'=>'direction:ltr;font-size:30px;height: 50px'
                                ]
                        ]
                        ) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->errorSummary($model); ?>
                    <?= Html::submitButton('بررسی کد', ['class' => 'btn btn-primary center-block', 'name' => 'signup-button']) ?>
                </div>

            </div>
        </div>

        <div class="col-md-4"></div>
    </div>
</div>
<?php ActiveForm::end() ?>

