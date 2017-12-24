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

use amintado\slider\widgets\SliderWidget;

/* @var $this yii\web\View */

?>

<?php wp_head(); ?>
<style>
    .wrap {
        margin-left: 0px !important;
        margin-right: 0px !important;
        max-width: 100vw !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    .container {
        padding-right: 0px;
        padding-left: 0px;
        margin-right: 0px;
        margin-left: 0px;
    }
</style>
<?php layerslider(1) ?>


