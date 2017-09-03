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

/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 8/31/2017
 * Time: 8:55 PM
 */

namespace common\assets;


use yii\web\AssetBundle;

class FineUploaderAsset extends AssetBundle
{
    public $sourcePath = '@vendor//bower/fine-uploader';
    public $css = [
        'dist/fine-uploader-gallery.css',
    ];
    public $js=[
        'dist/fine-uploader.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}