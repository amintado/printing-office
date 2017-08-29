<?php

use common\models\User;
use common\models\UserInfo;
use yii\widgets\DetailView;

/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 8/28/2017
 * Time: 6:07 PM
 */
/**
 * @var $user User
 * @var $info UserInfo
 * @var $title string
 */
?>

<style>
    #map_canvas {
        width: 100%;
        height: 500px;
    }

    #current {
        padding-top: 25px;
    }
</style>
<div class="row">

    <div class="panel panel-info">
        <div class="panel-heading"><?= $title ?></div>
        <div class="panel-body">
            <?php
            $columns =
                [
                    'state',
                    'city',
                    'postalcode',
                    [
                        'attribute' => 'address',
                        'format' => 'html',
                        'value' => function ($model) {
                            /**
                             * @var $model UserInfo
                             */
                            if (!empty($model->address)) {
                                return '
                            <div class="row" >
                                 <div class="col-md-12">
                                     ' . $model->address . '
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-12" style="color: #8a8a8a;font-size: small;margin-top:10px">
                                    ' . Yii::t('common', 'Address Hint') . '
                                </div>
                            </div>
                                
                            ';
                            }
                        }
                    ]
                ];
            echo DetailView::widget([
                'model' => $info,
                'attributes' => $columns
            ]);
            ?>
        </div>

    </div>

</div>
<div class="row">
    <div id='map_canvas'></div>
    <?php if (!empty($info->lat) and !empty($info->lng)) {
        ?>
        <script>

            function initMap() {
                var Markers = [];
                var count = 0;
                var i = 0;
                var csrf = "<?= Yii::$app->request->csrfToken ?>";

                var map = new google.maps.Map(document.getElementById('map_canvas'), {
                    zoom: 15,
                    center: new google.maps.LatLng(<?= $info->lat ?>, <?= $info->lng  ?>)

                });

                var marker = new google.maps.Marker({
                    position: {lat:<?= $info->lat ?>, lng:<?= $info->lng  ?>},
                    map: map,

                    animation: google.maps.Animation.DROP
                });


            }
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=<?= Yii::$app->systemCore->googleMapAPI_key ?>&callback=initMap">
        </script>
        <?php
    } ?>

</div>




