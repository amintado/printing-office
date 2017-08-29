<?php

$this->title = Yii::t('backend', 'Create Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Menu - Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="settings-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
