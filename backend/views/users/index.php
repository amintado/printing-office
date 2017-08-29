<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use common\models\Role;
use common\models\User;

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = Yii::t('backend', 'User');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="users-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php // Html::a(Yii::t('backend', 'Advance Search'), '#', ['class' => 'btn btn-info search-button']) ?>
    </p>
    <div class="search-form" style="display:none">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        //---------------- UserName -------------------
        'username',
        //---------------- FullName -------------------
        'fullname',
        [
            'attribute' => 'RoleID',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' =>
                ArrayHelper::map(Role::find()->all(), 'id', 'name'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => Yii::t('common', 'Select'), 'id' => 'grid-User-Role-ID'
            ]


            ,
            'value' => function ($model) {
                /**
                 * @var $model User
                 */
                return $model->getRoleName();
            }

        ],
        //---------------- UserImage -------------------
//        'Image',


        //---------------- UserEmail -------------------
        'email:email',

        //---------------- UserMobileNumber -------------------
//        'mobile',
        //---------------- UserStatus -------------------
        [
            'attribute' => 'status',
            'filter' =>
                User::statuses_select2(),
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => Yii::t('common', 'Select'), 'id' => 'grid-User-state'
            ],

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

        ['attribute' => 'lock', 'visible' => false],
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-users']],
        'panel' => [

            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'export' => false,
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">'.Yii::t('common','Grid Export All').'</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]),
        ],
    ]); ?>

</div>
