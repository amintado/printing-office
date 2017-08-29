<?php

namespace profile\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Access;
use common\models\Pages;
use common\models\Role;
use common\models\RoleSearch;
//use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class RoleController extends Controller {
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
        if (!Yii::$app->user->can('manageUsers')) {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }
        
        $get = Yii::$app->request->queryParams;
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search($get);
        $dataProvider->pagination->pageSize = (isset($get['per-page']) && is_numeric($get['per-page']) ? $get['per-page'] : 10);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate() {
        if (!Yii::$app->user->can('manageUsers')) {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }
        
        $model = new Role();

        $post=Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {

            $model->save();
            $auth = Yii::$app->authManager;
            
            $role = $auth->createRole($model->name);
            $role->description = $model->description;
            $auth->add($role);
            
            if (isset($post['access'])) {
                foreach ($post['access'] as $access) {
            
                    $model_access=new Access;
                    $model_access->role_id=$model->id;
                    $model_access->page_id=$access;
                    $model_access->save();
                    
                    $page=Pages::findOne($access);
                    $auth->addChild($role, $auth->getPermission($page->name));
                }
            }
            
            return $this->redirect(['index']);
        }

        $pages=Pages::find()->all();
        $access=[];

        return $this->render('create', [
            'model' => $model,
            'pages' => $pages,
            'access' => $access,
        ]);
    }
    public function actionUpdate($id) {
        if (!Yii::$app->user->can('manageUsers')) {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }
        
        $model = $this->findModel($id);
        $lastName=$model->name;
        
        $post=Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {

            $model->name=$lastName;
            $model->save();
            $auth = Yii::$app->authManager;
            $role=$auth->getRole($model->name);
            
            if (!$role) {
                $role=$auth->createRole($model->name);
                $role->description=$model->description;
                $auth->add($role);
            }

            $auth->removeChildren($role);
            Access::deleteAll(['role_id'=>$model->id]);
            
            if (isset($post['access'])) {

                foreach ($post['access'] as $access) {
                    $model_access=new Access;
                    $model_access->role_id=$model->id;
                    $model_access->page_id=$access;
                    $model_access->save();
                    $page=Pages::findOne($access);

                    $auth->addChild($role, $auth->getPermission($page->name));
 
                }
            }
            return $this->redirect(['index']);
        }

        $pages=Pages::find()->all();
        $in_access=Access::find()->where(['role_id' => $model->id])->all();

        $out_access=[];
        foreach ($in_access as $access) {
            $out_access[]=$access->page_id;
        }

        return $this->render('update', [
            'model' => $model,
            'pages' => $pages,
            'access' => $out_access,
        ]);
    }
    protected function findModel($id) {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}