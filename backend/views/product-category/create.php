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


/* @var $this yii\web\View */
/* @var $model common\models\base\ProductCategory */


?>
<div class="product-category-create">

    <h1>ثبت دسته بندی محصول</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
