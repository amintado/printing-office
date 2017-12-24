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

use common\models\Product;
use kartik\helpers\Html;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\View;

/**
 * @var $user User
 * @var $product Product
 * @var $this View
 */
$params = Json::decode($product->settings);
//echo '<pre>';
//var_dump($params);
//die();

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3>
                دریافت اطلاعات سفارش
            </h3>
        </div>
    </div>
    <form action="">
        <div class="row">
            <!--Media and Description area -->

            <div class="col-md-6">
                <div class="form-group pmd-textfield">
                    <label for="inputError1" class="control-label pmd-input-group-label">عنوان سفارش</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
                        <input type="text" class="form-control" id="exampleInputAmount"
                               placeholder="عنوان سفارش را وارد نمایید">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php
                if ($params['face'] == 'one') {
                    ?>
                    <div class="col-md-6">
                        <div class="radio">
                            <label class="pmd-radio pmd-radio-ripple-effect">
                                <input type="radio" name="face" id="one" value="one" checked>
                                <span for="one">چاپ یکرو</span>
                            </label>
                        </div>
                    </div>
                    <?php
                }
                ?>


                <?php
                if ($params['face'] == 'two') {
                    ?>
                    <div class="col-md-6">
                        <div class="radio">
                            <label class="pmd-radio pmd-radio-ripple-effect">
                                <input type="radio" name="face" id="two" value="two">
                                <span for="two">چاپ دورو</span>
                            </label>
                        </div>
                    </div>
                    <?php
                }
                ?>


                <!-- Radio button checked -->


            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">فایل ها</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <?php
                            foreach ($params['Files'] as $key => $value) {
                                ?>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3><?php echo $value['name'];
                                                if (!empty($value['required'])) echo '<span style="color:red">(اجباری)</span>';
                                                ?></h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="file" id="file-<?= $key ?>" class="dropify"
                                                   data-default-file="<?= $value['name'] ?> "
                                                   data-allowed-file-extensions="<?php

                                                   if (!empty($value['pdf'])) echo 'pdf ';
                                                   if (!empty($value['cdr'])) echo 'cdr ';
                                                   if (!empty($value['txt'])) echo 'txt ';
                                                   if (!empty($value['jpg'])) echo 'jpg ';
                                                   if (!empty($value['gif'])) echo 'gif ';
                                                   if (!empty($value['tif'])) echo 'tif ';
                                                   if (!empty($value['psd'])) echo 'psd ';
                                                   if (!empty($value['zip'])) echo 'zip ';
                                                   if (!empty($value['rar'])) echo 'rar ';
                                                   if (!empty($value['pptx'])) echo 'pptx ';
                                                   if (!empty($value['ppt'])) echo 'ppt ';
                                                   ?>"
                                            />
                                        </div>
                                    </div>

                                </div>
                                <?php
                                $js = <<<JS
$('#file-$key').dropify({
    messages: {
        'default': 'کیلک کنید یا فایل را اینجا رها کنید',
        'replace': 'کیلک کنید یا فایل را اینجا رها کنید',
        'remove':  'حذف',
        'error':   'فرمت فایل انتخاب شده قابل قبول نیست'
    }
});
JS;
                                $this->registerJs($js, View::POS_END);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">تیراژ</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <?php
                            switch ($params['tiraj']) {
                                case  'fixed' : {
                                    if (count($params['Tiraj']) == 1) {

                                        echo 'این محصول فقط در تیراژ ' . $params['Tiraj'][key($params['Tiraj'])]['tiraj'] . ' تایی چاپ میشود';
                                    } else {
                                        ?>
                                        <div class="col-md-3">
                                            <?php
                                            echo Select2::widget([
                                                    'data' => ArrayHelper::map($params['Tiraj'], 'tiraj', 'price'),
                                                'name' => 'Tiraj',
                                                'theme' => "bootstrap",
                                                'options' =>
                                                    [
                                                            'placeholder' => 'انتخاب تعداد تیراژ',
                                                    ],
                                                'hideSearch' => true,
                                                'addon' => [
                                                    'prepend' => [
                                                        'content' => Html::icon('globe')
                                                    ],
                                                    'append' => [
                                                        'content' => Html::button(Html::icon('map-marker'), [
                                                            'class' => 'btn btn-primary',
                                                            'title' => 'عدد',
                                                            'data-toggle' => 'tooltip'
                                                        ]),
                                                        'asButton' => true
                                                    ]
                                                ],
                                                'size' => Select2::SMALL
                                                ]);
                                            ?>
                                        </div>
                                        <?php
                                    }

                                }
                                    break;
                                case  'stair' : {

                                }
                                    break;

                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
