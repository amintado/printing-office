<?php

$this->title = Yii::t('backend', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Menu - User Role'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="role-update">

    <div class="col-lg-12">

        <?=
        $this->render('_form', [
            'model' => $model,
            'pages' => $pages,
            'access' => $access,
            'type' => 'update',
        ])
        ?>

    </div>

    <div class="clearfix"></div>

</div>
