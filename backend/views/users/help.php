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

use backend\assets\BackendHelpAsset;
use yii\web\View;

/**
 * @var $this View
 * @var string $asset_dir
 */
$asset = BackendHelpAsset::register($this);
$asset_dir = $asset->baseUrl . '/assets';
$this->title = 'راهنمای اسلایدساز';
?>

<style>

    .content-wrapper, .right-side {

        background-color: hsl(0, 0%, 100%) !important;

    }
</style>
<menu-aside>
    <header>
        <span>مدیریت دسترسی</span>
        <small>v-dev-master - 1396</small>
    </header>
    <nav>
        <ul id="sidebar">
            <li data-hash="introduction" class="active">
                <span>اطلاعات</span>
                <small>راهنمای تنظیم سیستم دسترسی کاربران</small>
            </li>
        </ul>
    </nav>
</menu-aside>

<div id="content">
    <div>

        <!--  Introduction -->
        <section data-target="introduction" class="active">

            <nav>
                <ul>
                    <li><a href="#overview">معرفی</a></li>
                    <li><a href="#about-item">وظایف سیستم مدیریت دسترسی</a></li>
                    <li><a href="#hierarchy">سلسله مراتب</a></li>
                </ul>
            </nav>


            <!-- Introduction: Overview -->
            <article class="active">
                <h1 data-target="overview">معرفی</h1>
                <p>
                    این سیستم یک ابزار کنترل دسترسی برای جلوگیری از دستیابی کاربران غیر مجاز در سازمان یا خارج از سازمان
                    به امکانات حساس سایت مدیریت چاپخانه است.
                </p>
                <p>
                    هر بخش از سایت دارای یک نام برای دسترسی می باشد، برای مثال بخش مدیریت اسلاید،بخش مدیریت کاربران، بخش
                    مدیریت مالی و ...
                </p>
            </article>

            <!--  Introduction: Third party -->
            <article>

                <h2 data-target="third-party">وظایف سیستم مدیریت دسترسی</h2>
                <p>
                    وظایف سیستم مدیریت کاربران به شرح ذیل است:
                </p>
                <div class="table">
                    <table>
                        <thead>
                        <tr>

                            <th>وظیفه</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            <td>تعیین نقش و مجوز</td>
                        </tr>
                        <tr>

                            <td>
                                برقراری روابط بین نقش ها و مجوز ها
                            </td>
                        </tr>
                        <tr>
                            <td>تعریف قوانین</td>
                        </tr>
                        <tr>
                            <td>همکاری قوانین با نقش ها و مجوزها</td>
                        </tr>
                        <tr>
                            <td>اختصاص دادن نقش به کاربران</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </article>

            <article>
                <h1 data-target="hierarchy">سلسله مراتب</h1>
                <p>
                    زمانی که سیستم دسترسی بدرستی تنظیم شود این سلسله مراتب قابل پیاده سازیست:
                </p>
                <figure>
                    <div class="img-holder" style="padding-bottom: 30px;margin-bottom: 26%">
                        <img src="http://www.yiiframework.com/doc-2.0/images/rbac-hierarchy-1.png">
                    </div>
                    <figcaption class="zigzag"> نویسنده می تواند پست ایجاد کند، مدیر می تواند پست را به روزرسانی کند و همه کارهای نویسنده را انجام
                        دهد.</figcaption>
                </figure>
            </article>
        </section>


    </div>
</div>

<?php
$js = <<<JS
$(document).ready(function(){
      $("body").addClass("sidebar-collapse");
      $('.sidebar-toggle').remove();

});
JS;

$this->registerJs($js, View::POS_END);

?>

