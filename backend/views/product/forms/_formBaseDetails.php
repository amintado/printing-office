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

use common\models\Product;
use dosamigos\ckeditor\CKEditor;
use yii\widgets\ActiveForm;

/**
 * @var $model Product
 * @var $form ActiveForm
 *
 */
?>
<?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>



<?= $form->field($model, 'description')->widget(CKEditor::className(),
    [
        'options' => ['rows'=>6],
        'preset' => 'full'
    ]) ?>


<?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

