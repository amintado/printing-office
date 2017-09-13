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

use common\models\TicketBody;
use common\models\TicketHead;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

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

/**
 * @var $model TicketHead
 * @var $body TicketBody
 * @var $this View
 */
$form=ActiveForm::begin();
echo $this->render('_form',
    [
        'model'=>$model,
        'body'=>$body,
        'form'=>$form
    ]
    );


echo  Html::submitButton('ارسال',['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);

ActiveForm::end();