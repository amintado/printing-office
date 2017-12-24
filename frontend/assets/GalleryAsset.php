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
 * Time: 6:27 AM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class GalleryAsset extends AssetBundle
{
public $sourcePath='@vendor/bower/photoswipe/dist';
public $js=[
    'photoswipe.min.js',
    'photoswipe-ui-default.js',
];
public $css=[
    'photoswipe.css',
    'default-skin/default-skin.css'
];
public $depends=
    [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}