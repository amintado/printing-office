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

use airani\AdminLteRtlAsset;
use dmstr\web\AdminLteAsset;
use profile\assets\MaterialAsset;
use rmrevin\yii\fontawesome\FontAwesome;
use yii\helpers\Html;
use yii\web\View;

/* @var $this \yii\web\View */
/* @var $content string */

if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (Yii::$app->user->isGuest){
        header("Location: ".Yii::$app->homeUrl);
        die();
    }


    if (class_exists('backend\assets\AppAsset')) {
        $asset=profile\assets\AppAsset::register($this);
    } else {
        $asset=profile\assets\AppAsset::register($this);
    }
    MaterialAsset::register($this);
    rmrevin\yii\fontawesome\AssetBundle::register($this);
    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link href="https://fonts.googleapis.com/css?family=Harmattan" rel="stylesheet">
    </head>
<style>
    .navigation-example {
        background-image: url('<?= $asset->baseUrl ?>/assets/image/material-1.jpg');
        background-position: center center;
        background-size: cover;
        margin-top: 0;
        min-height: 300px;
    }
    .panel.panel-primary > .panel-heading {
        background-color: hsl(166.5, 37.3%, 16.3%);
    }
    .nav-tabs {
        background: hsl(166.5, 37.3%, 16.3%);

    }

    .panel.panel-info > .panel-heading {
        background-color: hsla(166.5, 37.3%, 16.3%, 0.6);
    }

    .section {
        padding: 38px 0;
    }
    a, a:hover, a:focus {
        color: hsl(166.5, 37.3%, 16.3%);
    }
    .circle {
        border-radius: 95px;
        position: fixed;
        bottom: 46px;
        right: 46px;
        height: 55px;
        z-index: 55555;
        max-width: 55px;
    }
    .nav-tabs > li {
        float: right;
    }
    th {
        text-align: right;
    }
    .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
        float: right;
    }
    .krajee-default .file-drag-handle, .krajee-default .file-upload-indicator {
        float: left;
        margin: 20px 17px -4px;
        width: 16px;
        height: 16px;
    }
    .btn-kv {
        padding: 0;
    }
    .file-zoom-fullscreen .modal-dialog {
       margin-top: 0px;
    }
    .file-zoom-fullscreen.modal {
       padding-right: 0px !important;
    }
    .circle-btn {

        right: 56px;
    }
    .modal-backdrop {
        width: 0px;
        height: 0px;
    }
    .main-raised {
 
        margin-bottom: 333px;
    }
</style>
    <body class="hold-transition skin-blue sidebar-mini" style="direction: rtl !important;text-align: right !important;font-family: 'Harmattan', sans-serif !important;">
    <?php $this->beginBody() ?>


    <div class="navigation-example">


        <!-- End Navbar Danger -->

        <!-- Navbar Transparent -->
        <nav class="navbar navbar-transparent">
            <div class="container">



                <div class="collapse navbar-collapse" id="example-navbar-transparent">
                    <?= $this->render(
                        'left.php',
                        ['directoryAsset' => $directoryAsset]
                    )
                    ?>
                </div>
                <h3 style="margin-left: auto;
margin-right: auto;
display: block;
text-align: center;
color: white;">
                    <?php
                    if ($this->title !== null) {
                        echo \yii\helpers\Html::encode($this->title);
                    } else {
                        echo \yii\helpers\Inflector::camel2words(
                            \yii\helpers\Inflector::id2camel($this->context->module->id)
                        );
                        echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                    } ?>
                </h3>
            </div>
        </nav>
        <!-- End Navbar Transparent-->
    </div>
    <div class="main main-raised">
        <div class="section">
            <?= $this->render(
                'content.php',
                ['content' => $content, 'directoryAsset' => $directoryAsset]
            ) ?>
        </div>
    </div>



    <div class="wrapper">

        <?php $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>





    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
