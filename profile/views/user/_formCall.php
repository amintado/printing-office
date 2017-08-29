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


    <?= $form->field($model,'tel1')->textInput() ?>

    <?= $form->field($model,'tel2')->textInput() ?>

    <?= $form->field($model,'tel3')->textInput() ?>

    <?= $form->field($model,'mob1')->textInput() ?>

    <?= $form->field($model,'mob2')->textInput() ?>

    <?= $form->field($model,'website')->textInput() ?>





</div>

