<?php

/* @var $this yii\web\View */
/* @var $model common\models\Settings */

$this->title = Yii::t('backend', 'Update') . ' ' . Yii::t('backend', 'Menu - Settings') . ' | ' . $model->setting_key;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Menu - Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->setting_key;
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="settings-update">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
