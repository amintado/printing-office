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


namespace common\assets;


use yii\web\AssetBundle;

class MasonaryGalleryAsset extends AssetBundle
{
    public $sourcePath = '@vendor//bower/masonry';
    public $js =
        [
            'dist/masonary.pkgd.min.js'
        ];
}