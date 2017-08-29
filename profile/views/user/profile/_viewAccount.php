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


<div class="row">

    <div class="panel panel-info">
        <div class="panel-heading"><?= $title ?></div>
        <div class="panel-body">
            <?php
            $columns =
                [
                    'fullname',
                    'email',
                    [
                        'attribute' => 'Role.name',
                        'label' => Yii::t('backend', 'Role - Name')
                    ],
                    'mobile',
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



