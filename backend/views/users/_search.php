<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Username']) ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true, 'placeholder' => 'Fullname']) ?>

    <?= $form->field($model, 'RoleID')->textInput(['placeholder' => 'RoleID']) ?>

    <?= $form->field($model, 'Image')->textInput(['maxlength' => true, 'placeholder' => 'Image']) ?>

    <?php /* echo $form->field($model, 'auth_key')->textInput(['maxlength' => true, 'placeholder' => 'Auth Key']) */ ?>

    <?php /* echo $form->field($model, 'access_token')->textInput(['maxlength' => true, 'placeholder' => 'Access Token']) */ ?>

    <?php /* echo $form->field($model, 'password_hash')->textInput(['maxlength' => true, 'placeholder' => 'Password Hash']) */ ?>

    <?php /* echo $form->field($model, 'password_reset_token')->textInput(['maxlength' => true, 'placeholder' => 'Password Reset Token']) */ ?>

    <?php /* echo $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) */ ?>

    <?php /* echo $form->field($model, 'mobile')->textInput(['maxlength' => true, 'placeholder' => 'Mobile']) */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['placeholder' => 'Status']) */ ?>

    <?php /* echo $form->field($model, 'IsPrivate')->textInput(['placeholder' => 'IsPrivate']) */ ?>

    <?php /* echo $form->field($model, 'LastLoginIP')->textInput(['maxlength' => true, 'placeholder' => 'LastLoginIP']) */ ?>

    <?php /* echo $form->field($model, 'imei')->textInput(['maxlength' => true, 'placeholder' => 'Imei']) */ ?>

    <?php /* echo $form->field($model, 'UUID')->textInput(['maxlength' => true, 'placeholder' => 'UUID']) */ ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
