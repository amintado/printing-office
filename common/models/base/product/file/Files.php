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

namespace common\models\base\product\file;


use yii\base\Model;

/**
 * Class FixedDimensions
 * @package common\models\base\product\dimensions
 * @property string $name
 * @property boolean $cdr
 * @property boolean $txt
 * @property boolean $pdf
 * @property boolean $ppt
 * @property boolean $pptx
 * @property boolean $rar
 * @property boolean $zip
 * @property boolean $psd
 * @property boolean $tif
 * @property boolean $png
 * @property boolean $gif
 * @property boolean $jpg
 * @property boolean $required
 */
class Files extends Model
{
    public $cdr, $txt, $pdf, $ppt, $pptx, $rar, $zip, $psd, $tif, $png, $gif, $jpg, $name,$required;

    public function rules()
    {
        return
            [
                [['cdr', 'txt', 'pdf', 'ppt', 'pptx', 'rar', 'zip', 'psd', 'tif', 'png', 'gif', 'jpg','required'], 'boolean'],
                [['name'], 'string', 'max' => 255],
                [['name'], 'required']
            ];
    }

    public function attributeLabels()
    {
        return
            [
                'name' => 'نام فایل',
                'required' => 'اجباری',

            ];
    }
}