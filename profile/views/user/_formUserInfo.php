<div class="form-group col-md-4" id="add-user-info">
    <?php

    use common\assets\DatePickerAsset;
    use common\models\base\UserInfo;
    use common\models\User;
    use kartik\grid\GridView;
    use kartik\builder\TabularForm;
    use yii\data\ArrayDataProvider;
    use yii\helpers\Html;
    use yii\web\View;
    use yii\widgets\ActiveForm;
    use yii\widgets\Pjax;

    /**
     * @var $form ActiveForm
     * @var $model UserInfo
     * @var $this View
     */
    DatePickerAsset::register($this);
    $this->registerJs("
     
                /*
         observer
         */
        $(\"#observer\").persianDatepicker({
            altField: '#observerAlt',
            persianDigit: true,
            autoClose: true,
            altFormat: \"YYYY MM DD HH:mm:ss\",
            observer: true,
            format: 'YYYY/MM/DD'

        });
           
    ", View::POS_END);

    ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'family')->textInput() ?>

    <?= $form->field($model, 'workname')->textInput() ?>



    <div class='input-group date' id='date1'>
        <input id="observer" type="text" class="form-control" name="UserInfo[birthday]"/>
        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>

    <?= $form->field($model, 'nationCode')->textInput() ?>

    <?= $form->field($model, 'jobcategory')->textInput() ?>


</div>

