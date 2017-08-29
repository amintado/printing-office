<?php

use common\config\components\functions;
use common\models\User;
use common\models\UserInfo;
use yii\widgets\DetailView;

/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 8/28/2017
 * Time: 6:07 PM
 */
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


