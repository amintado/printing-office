<?php
/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 8/27/2017
 * Time: 9:13 AM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class FileInputAsset extends AssetBundle
{
    public $sourcePath = '@vendor//kartik-v/bootstrap-fileinput';
    public $css = [
        'css/fileinput-rtl.min.css',
    ];
    public $js=[
      'themes/fa/theme.js' ,
        'js/locales/fa.js',
        'js/fileinput.min.js',
        'js/plugins/purify.min.js',
        'js/plugins/sortable.min.js',
        'js/plugins/piexif.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}