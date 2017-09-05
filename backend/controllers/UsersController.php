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

namespace backend\controllers;

use common\config\components\functions;
use common\models\UserInfo;
use common\models\Role;
use function date;
use Exception;
use const false;
use const FILTER_VALIDATE_FLOAT;
use function filter_var;
use function GuzzleHttp\Psr7\str;
use function intlcal_field_difference;
use mikehaertl\tmp\File;
use const null;
use function pos;
use function trim;
use const true;
use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UsersController implements the CRUD actions for users model.
 */
class UsersController extends Controller
{
    protected $EncryptionKey = 'chap_mjkj';
    protected $uid = null;
    protected $image_dir='../../../dl/profiles/';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'add-auth-assignment', 'add-inquery', 'add-notification', 'add-order-status-log', 'add-ticket-head', 'add-transaction', 'add-user-info'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $user=User::findOne($id);
        $info=UserInfo::find()->where(['uid'=>$id])->one();
        return $this->render('view',
            [
                'user'=>$user,
                'info'=>$info
            ]);
    }

    /**
     * Creates a new users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $InfoModel = new UserInfo();
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

        if ($model->HandleUserPost($post) ) {
            $InfoModel->uid=$model->id;
            if ($InfoModel->HandleUserInfoPost($post)){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            $this->savePicture($model);
        } else {

            return $this->render('create', [
                'model' => $model,
                'InfoModel' => $InfoModel
            ]);
        }
    }

    /**
     * Updates an existing users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->uid=$id;
        $model = $this->findModel($id);
        $InfoModel = $this->findModelInfo($id);

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

        if ($model->HandleUserPost($post) ) {
            $InfoModel->uid=$model->id;
            if ($InfoModel->HandleUserInfoPost($post)){

                $this->savePicture($model);


                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->username=substr($model->username,1,strlen($model->username));
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
    /**
     * Deletes an existing users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }


    /**
     * Finds the users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
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

    /**
     * Action to load a tabular form grid
     * for AuthAssignment
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddAuthAssignment()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('AuthAssignment');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formAuthAssignment', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for Inquery
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddInquery()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Inquery');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formInquery', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for Notification
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddNotification()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Notification');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formNotification', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for OrderStatusLog
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddOrderStatusLog()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('OrderStatusLog');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formOrderStatusLog', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for TicketHead
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddTicketHead()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('TicketHead');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formTicketHead', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for Transaction
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddTransaction()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Transaction');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formTransaction', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for UserInfo
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddUserInfo()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('UserInfo');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formUserInfo', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
        }
    }






}
