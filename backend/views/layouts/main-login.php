<?php

/* @var $this \yii\web\View */
/* @var $content string */

use amintado\web\ApricotAsset;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

ApricotAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/minus.png">
</head>


<body
<?php $this->beginBody() ?>
<!-- Preloader -->
<!--<div id="preloader">-->
<!--    <div id="status">&nbsp;</div>-->
<!--</div>-->
<div class="container">



    <div class="" id="login-wrapper">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div id="logo-login">
                    <h4 class="text-center">
پنل مدیریت سایت
                    </h4>
                </div>
            </div>

        </div>

<?= $content ?>
    </div>





    <div style="text-align:center;margin:0 auto;">
        <h6 style="color:#fff;"> کارتابل مدیریت تابان (1396)</h6>
    </div>

</div>
<div id="test1" class="gmap3">
</div>



<!--  END OF PAPER WRAP -->












<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
