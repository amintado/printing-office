<?php
/**
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 */

use common\models\User;
use common\models\UserInfo;
use yii\widgets\DetailView;


/**
 * @var $user User
 * @var $info UserInfo
 * @var $title string
 */
?>

<div class="row">

    <div class="panel panel-info">
        <div class="panel-heading"><?= $title ?></div>
        <div class="panel-body">
            <?php
            $columns =
                [
                    [
                        'attribute' => 'tel1',
                        'format' => 'html',
                        'value' => function ($model) {
                            if (!empty($model->tel1)) {

                                return '<a href="tel:' . $model->tel1 . '" >' . $model->tel1 . '</a>';
                            }
                        }
                    ],
                    [
                        'attribute' => 'tel2',
                        'format' => 'html',
                        'value' => function ($model) {
                            if (!empty($model->tel2)) {

                                return '<a href="tel:' . $model->tel2 . '" >' . $model->tel2 . '</a>';
                            }
                        }
                    ],
                    [
                        'attribute' => 'tel3',
                        'format' => 'html',
                        'value' => function ($model) {
                            if (!empty($model->tel3)) {

                                return '<a href="tel:' . $model->tel3 . '" >' . $model->tel3 . '</a>';
                            }
                        }
                    ],
                    [
                        'attribute' => 'mob1',
                        'format' => 'html',
                        'value' => function ($model) {
                            if (!empty($model->mob1)) {

                                return '<a href="tel:' . $model->mob1 . '" >' . $model->mob1 . '</a>';
                            }
                        }
                    ],
                    [
                        'attribute' => 'mob2',
                        'format' => 'html',
                        'value' => function ($model) {
                            if (!empty($model->mob2)) {

                                return '<a href="tel:' . $model->mob2 . '" >' . $model->mob2 . '</a>';
                            }
                        }
                    ],

                    [
                        'attribute' => 'website',
                        'format' => 'html',
                        'value' => function ($model) {
                            if (!empty($model->website)) {

                                return '<a href="' . $model->website . '" >' . $model->website . '</a>';
                            }
                        }
                    ],
                    [
                        'attribute' => 'email',
                        'label'=> Yii::t('common', 'email'),
                        'format' => 'html',
                        'value' => function ($model) {
                            $model=User::findOne($model->uid);
                            if (!empty($model->email)) {

                                return '<a href="mailto:' . $model->email . '" >' . $model->email . '</a>';
                            }
                        }
                    ],



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
                    zoom: 14,
                    center: new google.maps.LatLng(<?= $info->lat ?>, <?= $info->lng  ?>),
                    styles: [
                        {
                            "featureType": "landscape",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "color": "#f2f2f2"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape.natural.landcover",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": 45
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#d5d5d5"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#dee6e8"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.text",
                            "stylers": [
                                {
                                    "color": "#968c8c"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#151515"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#bad0d6"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "labels.text",
                            "stylers": [
                                {
                                    "color": "#3f4052"
                                },
                                {
                                    "weight": "5.81"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "weight": "1.89"
                                },
                                {
                                    "color": "#010606"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "hue": "#ff0000"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway.controlled_access",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#cadee5"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#206f69"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#f7f7f7"
                                },
                                {
                                    "lightness": "48"
                                },
                                {
                                    "gamma": "4.37"
                                },
                                {
                                    "saturation": "-46"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "gamma": "1.10"
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#c8dde1"
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "labels.text",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#47717e"
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#b1c7c4"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#ffcb00"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "color": "#0fc1de"
                                },
                                {
                                    "visibility": "on"
                                }
                            ]
                        }
                    ]
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



