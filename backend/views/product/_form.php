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

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
/* @var $mode string */


?>

<div class="product-form">



    <?= $form->errorSummary($model); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Title']) ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">اطلاعات محصول</h3>
        </div>
        <div class="panel-body">




    <?php
    $forms = [

        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('backend', 'Product Base Detail')),
            'content' => $this->render('forms/_formBaseDetails',
                [
                    'model' => $model,
                    'form' => $form
                ]
            ),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('backend', 'Product Specification')),
            'content' => $this->render('forms/_formSpecification',
                [
                    'model' => $model,
                    'form' => $form
                ]
            ),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('backend', 'Product Technical Specification')),
            'content' => $this->render('forms/_formTechnicalSpecifications',
                [
                    'model' => $model,
                    'form' => $form
                ]
            ),
        ],

        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('backend', 'Product Gallery')),
            'content' => $this->render('forms/_formGallery',
                [
                    'model' => $model,
                    'form' => $form,
                    'mode'=> $mode
                ]
            ),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_RIGHT,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
</div>
</div>

</div>
