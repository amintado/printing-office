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
 * Date: 11/28/2017
 * Time: 7:28 AM
 */

namespace profile\assets;


use yii\web\AssetBundle;

class MaterialAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'assets/js/bootstrap.js',
        'assets/js/material.min.js',
        'assets/js/material-kit.js',

    ];
    public $css = [
        'assets/css/material-kit.css',
        'assets/css/dropify.min.css'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}