<?php

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
    public function actionCreate() {
        if (!Yii::$app->user->can('manageUsers')) {
            throw new ForbiddenHttpException('You are not allowed to edit this article.');
        }
        
        $model = new User();
//        $model->scenario = 'create';
        $model_userinfo = new Userinfo();
        $model_education = new Education();

        $model->status = User::status_active;
        $model->IsPrivate = User::IsPrivate_yes;
        $model->created_at = functions::getdatetime();
        $model->updated_at = functions::getdatetime();
        $model_education->RegisterTime = functions::getdatetime();

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model_userinfo->load($post) && $model_education->load($post)) {

            $model_education->inDate = functions::convertdate($model_education->inDate, 1);
            $model_education->outDate = functions::convertdate($model_education->outDate, 1);
            $model_userinfo->birthday = functions::convertdate($model_userinfo->birthday, 1);
            $model_userinfo->favorites = (isset($post['favorites']) && is_array($post['favorites']) ? implode(',', $post['favorites']) : null);

            $model->fullname = $model_userinfo->name . ' ' . $model_userinfo->family;
            $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->password_hash);
            $model->Image = UploadedFile::getInstance($model, 'Image');

            if ($model->Image) {
                $fileName = functions::getfilename();
                $model->Image->saveAs(Yii::getAlias('@users_image') . '/' . $fileName . '.' . $model->Image->extension, false);
                $model->Image = $fileName . '.' . $model->Image->extension;
            }

            if ($model->validate()) {

                $model->save();
                
                $role=Role::findOne($model->RoleID);
                if ($role) {
                    $auth = Yii::$app->authManager;
                    $roleObj = $auth->getRole($role->name);
                    if ($roleObj) {
                        $auth->revokeAll($model->id);
                        $auth->assign($roleObj, $model->id);
                    }
                }
                
                $model_userinfo->uid = $model->id;
                $model_education->uid = $model->id;

                $model_userinfo->save();
                $model_education->save();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        $model_education->inDate = functions::convertdate($model_education->inDate);
        $model_education->outDate = functions::convertdate($model_education->outDate);
        $model_userinfo->birthday = functions::convertdate($model_userinfo->birthday);
        $model->password_hash = null;
        $roles = Role::find()->asArray()->all();
        $categories = Category::find()->asArray()->all();
        $status_login = [User::status_active => Yii::t('backend', 'status_active'), User::status_deactive => Yii::t('backend', 'status_deactive')];
        $isprivate_login = [User::IsPrivate_no => Yii::t('backend', 'no'), User::IsPrivate_yes => Yii::t('backend', 'yes')];
        return $this->render('create', [
                    'model' => $model,
                    'roles' => $roles,
                    'model_userinfo' => $model_userinfo,
                    'model_education' => $model_education,
                    'categories' => $categories,
                    'status_login' => $status_login,
                    'isprivate_login' => $isprivate_login,
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

        if ($model->HandleUserPost($post) && $InfoModel->HandleUserInfoPost($post)) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('update', [
                'model' => $model,
                'InfoModel' => $InfoModel
            ]);
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