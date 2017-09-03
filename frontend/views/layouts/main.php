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

/* @var $this \yii\web\View */
/* @var $content string */

use airani\bootstrap\BootstrapRtlAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
BootstrapRtlAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'چاپ تابان',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'خانه', 'url' => ['/site/index']],
        ['label' => 'درباره ی ما', 'url' => ['/site/about']],
        ['label' => 'تماس با ما', 'url' => ['/site/contact']],
        ['label' => 'محصولات', 'url' => ['/product']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'ثبت نام/لاگین', 'url' => ['/site/signup']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                ' (' . Yii::$app->user->identity->username . ') '.Yii::t('common', 'Logout'),
                ['class' => 'btn btn-link logout','style'=>'padding-top: 15px;padding-bottom: 15px;']
            )
            . Html::endForm()
            . '</li>';
        $menuItems[]=['label'=> Yii::t('common', 'Profile'),'url'=>\Yii::$app->urlManagerBackend->baseUrl];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container" style="margin-top: 73px">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>


</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
