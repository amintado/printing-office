<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\redactor\widgets\Redactor;
use yii\widgets\ActiveForm;

?>

<div class="role-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?php
            if ($type==='create') {
                echo $form->field($model, 'name')->textInput(['maxlength' => true]);
            }
            else {
                echo '<label>'.Yii::t('backend', 'Role - Name').':&nbsp;&nbsp;</label>'.$model->name;   
            }
            ?>
        </div>

        <div class="clearfix"></div>
            
        <div class="col-lg-8">
            <?=
            $form->field($model, 'description')->widget(Redactor::className(), [
                'clientOptions' => [
                    'direction' => 'rtl',
                    'plugins' => ['clips', 'fontcolor', 'imagemanager']
                ]
            ])
            ?>
        </div>
        
        <div class="clearfix"></div>
            
        <div class="col-lg-8">
            <div class="form-group">
                <label class="control-label"><?= Yii::t('backend', 'Role - access') ?></label>
                <?=
                Select2::widget([
                    'name'=>'access',
                    'data' => ArrayHelper::map($pages, 'id', 'desc'),
                    'value' => $access,
                    'options' => [
                        'placeholder' => Yii::t('app', 'Choose...'),
                        'multiple' => true,
                        'dir' => 'rtl'
                    ],
                ])
                ?>
            </div>
        </div>
    
    </div>
    
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Submit'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
