<?php

use common\models\base\UserInfo;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $InfoModel UserInfo */
/* @var $mode string */



?>


    <?php
    $forms = [

            //---------------- Main -------------------
        [
            'label' => '<i class="glyphicon glyphicon-cloud"></i> ' . Html::encode(Yii::t('backend', 'UserInfo - Account')),
            'content' => $this->render('_formMain', [
                'model' => $model,
                'form'=>$form,
                'mode'=> $mode
            ]),
        ],
            //---------------- User Info -------------------
        [
            'label' => '<i class="glyphicon glyphicon-user"></i> ' . Html::encode(Yii::t('backend', 'UserInfo')),
            'content' => $this->render('_formUserInfo', [
                'model' => $InfoModel,'form'=>$form
            ]),
        ],


            //---------------- User Map Place -------------------
        [
            'label' => '<i class="glyphicon glyphicon-map-marker"></i> ' . Html::encode(Yii::t('backend', 'UserInfo - Place')),
            'content' => $this->render('_formPlace', [
                'model' => $InfoModel,
                'form'=>$form,
                'mode'=>$mode
            ]),
        ],

            //---------------- User Call -------------------
        [
            'label' => '<i class="glyphicon glyphicon-earphone"></i> ' . Html::encode(Yii::t('backend', 'UserInfo - Call')),
            'content' => $this->render('_formCall', [
                'model' => $InfoModel,'form'=>$form
            ]),
        ],

            //---------------- User Charge -------------------
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('backend', 'UserInfo - Price')),
            'content' => $this->render('_formPrice', [
                'model' => $InfoModel,'form'=>$form
            ]),
        ],
    ];

    //---------------- Echo User Edit Tabs -------------------
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>




