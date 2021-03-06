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

use common\config\components\functions;
use common\models\User;
use common\models\UserInfo;
use yii\widgets\DetailView;


/**
 * @var $user User
 * @var $info UserInfo
 * @var $title string
 */
?>

<style>
    #map_canvas {
        width: 100%;
        height: 500px;
    }

    #current {
        padding-top: 25px;
    }
</style>
<div class="row">

    <div class="panel panel-info">
        <div class="panel-heading"><?= $title ?></div>
        <div class="panel-body">
            <?php
            $columns =
                [
                    'nationCode',
                    'name',
                    'family',
                    [
                        'attribute'=>'birthday',
                        'value'=>function($model){
                            if (!empty($model->birthday)){
                                return functions::convertdate($model->birthday);
                            }
                        }
                    ],
                    'jobcategory',
                    'workname'

                ];
            echo DetailView::widget([
                'model' => $info,
                'attributes' => $columns
            ]);
            ?>
        </div>

    </div>

</div>


