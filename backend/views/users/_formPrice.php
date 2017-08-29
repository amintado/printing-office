<div class="form-group col-md-4" id="add-user-info">
    <?php
    use common\models\base\UserInfo;
    use common\models\User;
    use kartik\grid\GridView;
    use kartik\builder\TabularForm;
    use yii\data\ArrayDataProvider;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\widgets\Pjax;

    /**
     * @var $form ActiveForm
     * @var $model UserInfo
     */

    ?>

    <?= $form->field($model,'charge')->textInput(['placeholder'=>'مبلغی(ریال) به شارژ پول می افزاید']) ?>







</div>

