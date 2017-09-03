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

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DatePickerAsset extends AssetBundle
{
    public $sourcePath='@vendor//bower/persian-datepicker';
    public $css = [
        'src/css/persian-datepicker.css',
        'dist/css/theme/persian-datepicker-cheerup.css'
    ];
    public $js = [
        'lib/persian-date.js',
        'src/js/mousewheel.js',
        'src/js/plugin.js',
        'src/js/constant.js',
        'src/js/config.js',
        'src/js/template.js',
        'src/js/base-class.js',
        'src/js/compat-class.js',
        'src/js/helper.js',
        'src/js/monthgrid.js',
        'src/js/monthgrid-view.js',
        'src/js/datepicker-view.js',
        'src/js/datepicker.js',
        'src/js/navigator.js',
        'src/js/daypicker.js',
        'src/js/monthpicker.js',
        'src/js/yearpicker.js',
        'src/js/toolbox.js',
        'src/js/timepicker.js',
        'src/js/state.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',

    ];
}
