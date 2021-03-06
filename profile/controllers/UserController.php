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

namespace profile\controllers;

use common\models\Idea;
use kartik\form\ActiveForm;
use const null;
use const SORT_DESC;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\components\functions;
use common\models\Category;
use common\models\Education;
use common\models\Role;
use common\models\Userinfo;
use common\models\User;
use common\models\UserSearch;
use yii\web\UploadedFile;
//use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class UserController extends Controller {
    protected $uid = null;
    protected $image_dir='../../../dl/profiles/';

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
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($get);
        $dataProvider->pagination->pageSize = (isset($get['per-page']) && is_numeric($get['per-page']) ? $get['per-page'] : 10);
        $roles = Role::find()->asArray()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'roles' => $roles,
        ]);
    }
    public function actionView(){
        if (Yii::$app->user->isGuest){
            return $this->redirect(['/profile/index']);
        }

        $user=User::findOne(Yii::$app->user->id);
        $info=UserInfo::find()->where(['uid'=>Yii::$app->user->id])->one();
        return $this->render('view',
            [
                'user'=>$user,
                'info'=>$info
            ]);
    }

    public function actionUpdate()
    {
        $this->uid=Yii::$app->user->id;
        $model = $this->findModel($this->uid);
        $InfoModel = $this->findModelInfo($this->uid);

        $post = Yii::$app->request->post();

        //---------------- Save Lat Lng -------------------
        if (!empty($post['UserInfo']['lat'])) {
            $latLng = explode(',', rtrim(ltrim(Yii::$app->request->post()['UserInfo']['lat'], '('), ')'));
            if (!empty($latLng[0]) and !empty($latLng[1])) {
                $InfoModel->lat = trim($latLng[0]);
                $InfoModel->lng = trim($latLng[1]);
                $InfoModel->save();
            }
        }

        if ($model->HandleUserPostProfile($post) && $InfoModel->HandleUserInfoPost($post)) {
            $this->savePicture($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('update', [
                'model' => $model,
                'InfoModel' => $InfoModel
            ]);
        }
    }

    public function savePicture($model){
        /**
         * @var $model User
         */

        $file=UploadedFile::getInstance($model,'image');

        if (empty($file)){
            return;
        }
        {
            //---------------- validate value name -------------------
            $model->image = str_replace(' ', '', $model->image);
        }
        if (!realpath(__DIR__ . $this->image_dir )) {
            mkdir(realpath(__DIR__ . '../../../') . '/dl/profiles/', 0700, true);
        };
        if (
        $file->saveAs(realpath(__DIR__ . $this->image_dir) . '/' . $model->hash_id .'.'.$file->extension)
        ) {
            $model->Image=$model->hash_id.'.'.$file->extension;
            $model->save();
        }
    }

    protected function findModelInfo($id)
    {
        if (($model = UserInfo::find()->where(['uid'=>$id])->one()) !== null) {
            return $model;
        } else {
            return new UserInfo();
        }
    }
    public function actionDeleteImage($id) {
        if (!Yii::$app->user->can('manageUsers')) {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }
        
        $model=$this->findModel($id);
        if ($model->Image && file_exists(Yii::getAlias('@users_image/' . $model->Image))) {
            unlink(Yii::getAlias('@users_image/' . $model->Image));
            $model->Image=null;
            $model->save();
        }
        return $this->redirect(['/users/update','id'=>$id]);
    }
    public function actionDelete($id) {
        if (!Yii::$app->user->can('manageUsers')) {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}