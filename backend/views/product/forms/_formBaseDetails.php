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

use common\models\base\ProductCategory;
use common\models\Product;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * @var $model Product
 * @var $form ActiveForm
 *
 */
?>
<?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>


<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'description')->widget(CKEditor::className(),
            [
                'options' => ['rows'=>6],
                'preset' => 'full'
            ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <?= $form->field($model,'category')->widget(Select2::className(),
            [
                'data'=>ArrayHelper::map(ProductCategory::find()->where(['status'=>1])->all(),'id','name')
            ]) ?>
    </div>
</div>


<?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

