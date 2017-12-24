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
use common\models\User;
use common\models\UserInfo;

?>

<ul class="nav navbar-nav navbar-right">


    <li>
        <a href="<?= Yii::$app->urlManager->createUrl(['/payment/default/create']) ?> ">
            <i class="fa fa-money"></i>
            <?= Yii::t('common', 'account balance').':' ?>
            <?=

            number_format(intval(  \common\models\base\UserInfo::find()->where(['uid'=>Yii::$app->user->id])->one()->balance ), 0, ',', ',');
            ?>
            ریال
        </a>
    </li>
    <li>
        <img src="<?= functions::ImageReturn(Yii::$app->user->getId()) ?>" class="img-circle" alt="User Image"
             style="height: 45px;width: 45px"/>

        <?= User::findOne(Yii::$app->user->getId())->fullname ?>

    </li>
</ul>










