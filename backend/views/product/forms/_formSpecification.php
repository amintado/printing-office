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

use common\models\base\Product;
use dosamigos\ckeditor\CKEditor;
use yii\widgets\ActiveForm;

/**
 * @var $form ActiveForm
 * @var $model Product
 */
?>
<?= $form->field($model, 'specification')->widget(CKEditor::className(),
    [
        'options' => ['rows'=>6],
        'preset' => 'custom',
        'clientOptions' => [
            'height' => 400,
            'toolbarGroups' => [
                '/',
                ['name' => 'basicstyles', 'groups' => ['basicstyles', 'colors','cleanup']],
                ['name' => 'paragraph', 'groups' => [ 'list', 'indent', 'blocks', 'align', 'bidi' ]],


                '/',



            ],
        ]
    ]) ?>
