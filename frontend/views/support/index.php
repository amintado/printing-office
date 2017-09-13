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

use common\config\components\functions;
use common\models\base\TicketHead;
use common\models\User;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;

/**
 * @var $dataProvider TicketHead
 * @var $searchModel
 *
 */

?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">بخش پشتیبانی</h3>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-2">
                    <a name="" id="" class="btn btn-success" href="<?= Yii::$app->urlManager->createUrl(['/support/create']) ?>"
                       role="button">تیکت جدید</a>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
            </div>

            <div class="row" style="margin-top: 20px">
                <?php
                $columns = [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['attribute' => 'id', 'visible' => false],
//                    [
//                        'attribute' => 'user_id',
//                        'label' => 'کاربر درخواست کننده',
//                        'value' => function ($model) {
//                            /**
//                             * @var $model TicketHead
//                             */
//                            if (!empty($model->user_id)) {
//                                $user = User::findOne($model->user_id);
//                                if (!empty($user)) {
//                                    if (!empty($user->fullname)) {
//                                        return $user->fullname;
//                                    }
//                                }
//                            }
//                        }
//                    ],
                    [
                        'attribute' => 'department',
                        'label' => 'بخش پاسخ گو',
                        'value' => function ($model) {
                            /**
                             * @var $model TicketHead
                             */
                            if (!empty($model->topic)) {
                                return Yii::t('common', 'Ticket Department-' . $model->topic);
                            }
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'وضعیت',
                        'value' => function ($model) {
                            /**
                             * @var $model TicketHead
                             */
                            if (!empty($model->status)) {
                                return Yii::t('common', 'Ticket Status-' . $model->status);
                            }
                        }
                    ],
                    'topic',
//                    [
//                        'attribute' => 'create_at',
//                        'label' => 'تاریخ ایجاد',
//                        'value' => function ($model) {
//                            /**
//                             * @var $model TicketHead
//                             */
//                            if (!empty($model->created_at)) {
//                                return functions::convertdate($model->created_at);
//                            }
//                        }
//                    ],
//                    [
//                        'attribute' => 'updated_at',
//                        'label' => 'ایجاد شده در',
//                        'value' => function ($model) {
//                            /**
//                             * @var    $model TicketHead
//                             */
//                            if (!empty($model->created_at)) {
//                                return functions::convertdate($model->created_at);
//                            }
//                        }
//                    ],
//                    [
//                        'attribute' => 'created_by',
//                        'label' => 'ایجاد شده توسط',
//                        'value' => function ($model) {
//                            /**
//                             * @var $model TicketHead
//                             */
//                            if (!empty($model->created_by)) {
//                                $user = User::find()->andWhere(['id' => $model->created_by])->one();
//                                if (!empty($user->fullname)) {
//
//                                }
//                            }
//                        }
//                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{save-as-new} {view} {update} {delete}',
                        'buttons' => [
                            'save-as-new' => function ($url) {
                                return Html::a('<span class="glyphicon glyphicon-copy"></span>', $url, ['title' => 'Save As New']);
                            },
                        ],
                    ],
                ];
                echo GridView::widget(
                    [

                        'dataProvider' => $dataProvider,


                        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-product']],

                        // your toolbar can include the additional full export menu
                        'toolbar' => [

                        ],
                        'columns' => $columns

                    ]
                );
                ?>
            </div>


        </div>
    </div>
</div>

