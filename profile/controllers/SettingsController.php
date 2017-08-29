<?php

namespace profile\controllers;

use common\models\Settings;
use common\models\SettingsSearch;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
//use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class SettingsController extends Controller {
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionIndex() {
        if (!Yii::$app->user->can('manageSettings')) {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }
        
        $get = Yii::$app->request->queryParams;
        $searchModel = new SettingsSearch();
        $dataProvider = $searchModel->search($get);
        $dataProvider->pagination->pageSize = (isset($get['per-page']) && is_numeric($get['per-page']) ? $get['per-page'] : 10);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id) {
        if (!Yii::$app->user->can('manageSettings')) {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionCreate() {
        if (!Yii::$app->user->can('manageSettings')) {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }
        
        $model = new Settings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id) {
        if (!Yii::$app->user->can('manageSettings')) {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionDelete($id) {
        if (!Yii::$app->user->can('manageSettings')) {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    protected function findModel($id) {
        if (($model = Settings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionGenerateUserDates(){

        ini_set('memory_limit','-1');
        set_time_limit(0);
        $model=User::find()->All();
        foreach ($model as $key => $value){
            /**
             * @var User $value
             */
            if ($value->created_at=='0000-00-00 00:00:00'){

                $value->created_at='2012-07-12 00:00:00';
                $value->save(false);
            }
        }

    }

}