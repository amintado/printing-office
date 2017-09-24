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

/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 9/24/2017
 * Time: 2:48 PM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class BackendHelpAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css =
        [
            'assets/css/dashicons.css',
            'assets/css/doc.css',
            'assets/css/css.css',
            'assets/css/shCoreKreatura.css',
            'assets/css/shThemeKreatura.css',
        ];
    public $js=
        [

            'assets/js/shCore.js',

            'assets/js/shBrushCss.js',
            'assets/js/shBrushJscript.js',
            'assets/js/shBrushPhp.js',
            'assets/js/shBrushXml.js',
            'assets/js/doc.js',
        ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}