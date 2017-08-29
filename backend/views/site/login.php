<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'حساب کاربری';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="account-box">

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true,'style'=>'']) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton('ورود', ['class' => 'btn btn-primary center-block', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            <!--            <a class="forgotLnk" href="index.html"></a>-->
            <!--            <div class="or-box">-->
            <!---->
            <!--                <center><span class="text-center login-with">Login or <b>Sign Up</b></span></center>-->
            <!---->
            <!---->
            <!--            </div>-->
            <!--            <hr>-->
            <!--            <div class="row-block">-->
            <!--                <div class="row">-->
            <!--                    <div class="col-md-12 row-block">-->
            <!--                        <a href="index.html" class="btn btn-primary btn-block">ساخت حساب جدید</a>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
        </div>
    </div>
</div>
