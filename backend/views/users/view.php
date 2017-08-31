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
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 8/28/2017
 * Time: 4:09 PM
 */
/**
 * @var $user User
 * @var $info UserInfo
 */
$this->title= Yii::t('common', 'User Profile View');

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->username, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'view');
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <img src="<?= functions::ImageReturn(Yii::$app->user->id) ?>" alt="..." class="img-circle center-block">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="center-block text-center">
                        <?php
                        if (!empty($user->fullname)) {
                            echo $user->fullname;
                        }
                        ?>
                    </h4>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="<?= Yii::$app->urlManager->createUrl(['/users/update','id'=>$user->id]) ?>" type="button" class="btn btn-primary center-block" style="width: 100px"><?= Yii::t('common', 'Edit') ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            $forms =
                [
                    //---------------- User Main Data -------------------
                    [
                        'label' => '<i class="glyphicon glyphicon-cloud"></i> ' . Html::encode(Yii::t('common', 'Account Details')),
                        'content' => $this->render('profile/_viewAccount', [
                            'user' => $user,
                            'info' => $info,
                            'title' => '<i class="glyphicon glyphicon-cloud"></i> ' . Html::encode(Yii::t('common', 'Account Details')),
                        ]),
                    ],
                    [
                        'label' => '<i class="glyphicon glyphicon-user"></i> ' . Html::encode(Yii::t('backend', 'UserInfo')),
                        'content' => $this->render('profile/_viewMain', [
                            'user' => $user,
                            'info' => $info,
                            'title' => '<i class="glyphicon glyphicon-user"></i> ' . Html::encode(Yii::t('backend', 'UserInfo')),
                        ]),
                    ],




            [
                'label' => '<i class="glyphicon glyphicon-map-marker"></i> ' . Html::encode(Yii::t('common', 'User Address Detail')),
                'content' => $this->render('profile/_viewAddress', [
                    'user' => $user,
                    'info' => $info,
                    'title' => '<i class="glyphicon glyphicon-map-marker"></i> ' . Html::encode(Yii::t('common', 'User Address Detail')),
                ]),
            ],



                    [
                        'label' => '<i class="glyphicon glyphicon-earphone"></i> ' . Html::encode(Yii::t('common', 'User Call Detail')),
                        'content' => $this->render('profile/_viewCall', [
                            'user' => $user,
                            'info' => $info,
                            'title' => '<i class="glyphicon glyphicon-earphone"></i> ' . Html::encode(Yii::t('common', 'User Call Detail')),
                        ]),
                    ],



                ];

            //---------------- Echo User View Tabs -------------------
            echo kartik\tabs\TabsX::widget([
                'items' => $forms,
                'position' => kartik\tabs\TabsX::POS_ABOVE,
                'encodeLabels' => false,
                'pluginOptions' => [
                    'bordered' => true,
                    'sideways' => true,
                    'enableCache' => false,
                ],
            ]);

            ?>
        </div>
    </div>
</div>