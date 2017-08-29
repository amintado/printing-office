<?php

use common\config\components\functions;
use common\models\User;

use function PHPSTORM_META\type;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('backend', 'User') . ' ' . Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">

            <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'username',
            'fullname',
            [
                'attribute' => 'Role.name',
                'label' => Yii::t('backend', 'Role - Name')
            ],

            'email:email',
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


            [
                'attribute' => 'Image',
                'format' => 'html',
                'value' => function ($model) {
                    return '<img src="' . functions::ImageReturn($model->id) . '" alt="..." class="img-thumbnail">';
                }
            ],
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>

    <div class="row">


    </div>

    <div class="row">
        <?php
        if ($providerInquery->totalCount) {
            $gridColumnInquery = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'qdescription',
                'qfile',
                'qdate',
                'adate',
                'afile',
                'adescription',
                [
                    'attribute' => 'category0.id',
                    'label' => Yii::t('backend', 'Category')
                ],
                'UUID',
                ['attribute' => 'lock', 'visible' => false],
                'restored_by',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerInquery,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-taban-inquery']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('backend', 'Inquery')),
                ],
                'export' => false,
                'columns' => $gridColumnInquery
            ]);
        }
        ?>

    </div>

    <div class="row">
        <?php
        if ($providerNotification->totalCount) {
            $gridColumnNotification = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'resiverID',
                'module',
                'type',
                'description:ntext',
                'visited',
                'time',
                'UUID',
                ['attribute' => 'lock', 'visible' => false],
                'restored_by',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerNotification,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-taban-notification']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('backend', 'Notification')),
                ],
                'export' => false,
                'columns' => $gridColumnNotification
            ]);
        }
        ?>

    </div>

    <div class="row">
        <?php
        if ($providerOrderStatusLog->totalCount) {
            $gridColumnOrderStatusLog = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'status',
                'date',
                'description',
                [
                    'attribute' => 'order.id',
                    'label' => Yii::t('backend', 'Order')
                ],
                'UUID',
                ['attribute' => 'lock', 'visible' => false],
                'restored_by',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerOrderStatusLog,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-taban-order-status-log']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('backend', 'Order Status Log')),
                ],
                'export' => false,
                'columns' => $gridColumnOrderStatusLog
            ]);
        }
        ?>

    </div>

    <div class="row">
        <?php
        if ($providerTicketHead->totalCount) {
            $gridColumnTicketHead = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'department',
                'topic',
                'status',
                'date_update',
                'restored_by',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTicketHead,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-taban-ticket-head']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('backend', 'Ticket Head')),
                ],
                'export' => false,
                'columns' => $gridColumnTicketHead
            ]);
        }
        ?>

    </div>

    <div class="row">
        <?php
        if ($providerTransaction->totalCount) {
            $gridColumnTransaction = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'date',
                'price',
                'description',
                'invoice',
                'UUID',
                ['attribute' => 'lock', 'visible' => false],
                'restored_by',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTransaction,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-taban-transaction']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('backend', 'Transaction')),
                ],
                'export' => false,
                'columns' => $gridColumnTransaction
            ]);
        }
        ?>

    </div>

    <div class="row">
        <?php
        if ($providerUserInfo->totalCount) {
            $gridColumnUserInfo = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'name',
                'family',
                'workname',
                'state',
                'city',
                'tel1',
                'tel2',
                'tel3',
                'mob1',
                'mob2',
                'birthday',
                'website',
                'nationCode',
                'postalcode',
                'jobcategory',
                'address',
                'file',
                'lat',
                'lng',
                'charge',

                ['attribute' => 'lock', 'visible' => false],
                'restored_by',
                'gender',
                'vocation',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerUserInfo,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-taban-user-info']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('backend', 'User Info')),
                ],
                'export' => false,
                'columns' => $gridColumnUserInfo
            ]);
        }
        ?>

    </div>
</div>
