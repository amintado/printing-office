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
use kartik\widgets\Select2;
use yii\helpers\Html;
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
 * @var $form ActiveForm
 */

?>

<?= $form->field($model, 'topic')->textInput() ?>
<?= $form->field($model, 'department')->widget(Select2::className(),
    [
        'data' => \common\models\base\TicketHead::departments()
    ]
) ?>
<?= $form->field($body, 'text')->textarea() ?>

