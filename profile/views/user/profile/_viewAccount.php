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


<div class="row">

    <div class="panel panel-info">
        <div class="panel-heading"><?= $title ?></div>
        <div class="panel-body">
            <?php
            $columns =
                [
                    'username',
                    'fullname',
                    [
                        'attribute' => 'Role.name',
                        'label' => Yii::t('backend', 'Role - Name')
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            /**
                             * @var $model User
                             */
                            switch ($model->status) {
                                case User::STATUS_ACTIVE:
                                    return Yii::t('common', 'User Active');
                                    break;
                                case User::STATUS_DELETED:
                                    return Yii::t('common', 'User Deleted');

                            }
                        }
                    ],

                    'LastLoginIP',
                    'created_at',
                ];
            echo DetailView::widget([
                'model' => $user,
                'attributes' => $columns
            ]);
            ?>
        </div>

    </div>

</div>



