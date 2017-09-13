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


namespace frontend\controllers;


use common\models\base\TicketHead;
use common\models\base\TicketSearch;
use common\models\TicketBody;
use Yii;
use yii\web\Controller;

class SupportController extends Controller
{

    public function actionIndex()
    {


        $searchModel = new TicketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    public function actionCreate()
    {
        $model = new TicketHead();
        $body = new TicketBody();

        if ($model->load(Yii::$app->request->post()) and $body->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $body->validate();
            if ($model->save()) {
                $model->hash();
                $body->id_head = $model->id;
                if ($body->save()) {
                    return $this->redirect(['view', 'id' => $model->hash_id]);
                }
            }
        } else {
            return $this->render('create',
                [
                    'model' => $model,
                    'body' => $body
                ]
            );
        }
    }
}