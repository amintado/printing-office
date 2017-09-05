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

use common\models\ProductGallery;
use RuntimeException;
use Yii;
use common\models\base\Product;
use common\models\ProductSearch;
use yii\helpers\ArrayHelper;
use yii\redactor\controllers\UploadController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{

    public $gallery_dir = '../../../dl/product/';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'upload' => ['post'],
                    'delete-pic' => ['post']
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new', 'add-product-gallery', 'add-product-specifications', 'add-product-step-property', 'add-product-technical-specification', 'upload', 'delete-pic'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id == 'upload') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->hash();


            $images = UploadedFile::getInstances($model, 'images');
            if (!empty($images)) {
                foreach ($images as $key => $value) {
                    /**
                     * @var UploadedFile $value
                     */
                    {
                        //---------------- validate value name -------------------
                        $value->name = str_replace(' ', '', $value->name);
                    }
                    if (!realpath(__DIR__ . $this->gallery_dir . $model->id)) {
                        mkdir(realpath(__DIR__ . '../../../') . '/dl/product/' . $model->id, 0700, true);
                    };
                    if (
                    $value->saveAs(realpath(__DIR__ . $this->gallery_dir) . '/' . $model->id . '/' . $value->name)
                    ) {
                        $gallery = new ProductGallery();
                        $gallery->product_id = $model->id;
                        $gallery->url = $model->hash_id;
                        $gallery->img_name = $value->name;
                        $gallery->save();
                        $gallery->hash();
                    }
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);

        }


        return $this->render('create', [
            'model' => $model,
        ]);

    }


    public function actionDeletePic($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $pic = ProductGallery::find()->andWhere(['hash_id' => $id])->one();
        if (!empty($pic)) {
            if ($pic->delete()) {
                unlink(realpath(__DIR__ . $this->gallery_dir) . '/' . $pic->product_id . '/' . $pic->img_name);
                if (count(scandir(realpath(__DIR__ . $this->gallery_dir) . '/' . $pic->product_id ))<=2){
                    rmdir(realpath(__DIR__ . $this->gallery_dir) . '/' . $pic->product_id );
                }
                return ['message' => 'ok'];
            } else {
                return ['message' => 'failed'];
            }
        }
        return ['message'=>'failed'];
    }

/**
 * Updates an existing Product model.
 * If update is successful, the browser will be redirected to the 'view' page.
 * @param integer $id
 * @return mixed
 */
public
function actionUpdate($id)
{
    if (Yii::$app->request->post('_asnew') == '1') {
        $model = new Product();
    } else {
        $model = $this->findModel($id);
    }

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        $images = UploadedFile::getInstances($model, 'images');
        if (!empty($images)) {
            foreach ($images as $key => $value) {
                /**
                 * @var UploadedFile $value
                 */
                {
                    //---------------- validate value name -------------------
                    $value->name = str_replace(' ', '', $value->name);
                }
                if (!realpath(__DIR__ . '../../..//dl/product/' . $model->id)) {
                    mkdir(realpath(__DIR__ . '../../../') . '/dl/product/' . $model->id, 0700, true);
                };
                if (
                $value->saveAs(realpath(__DIR__ . '../../../dl/product') . '/' . $model->id . '/' . $value->name)
                ) {
                    $gallery = new ProductGallery();
                    $gallery->product_id = $model->id;
                    $gallery->url = $model->hash_id;
                    $gallery->img_name = $value->name;
                    $gallery->save();
                    $gallery->hash();
                }
            }
        }
        return $this->redirect(['view', 'id' => $model->id]);
    } else {
        return $this->render('update', [
            'model' => $model,
        ]);
    }
}

/**
 * Deletes an existing Product model.
 * If deletion is successful, the browser will be redirected to the 'index' page.
 * @param integer $id
 * @return mixed
 */
public
function actionDelete($id)
{
    $this->findModel($id)->deleteWithRelated();

    return $this->redirect(['index']);
}

/**
 *
 * Export Product information into PDF format.
 * @param integer $id
 * @return mixed
 */
public
function actionPdf($id)
{
    $model = $this->findModel($id);
    $providerProductGallery = new \yii\data\ArrayDataProvider([
        'allModels' => $model->productGalleries,
    ]);
    $providerProductSpecifications = new \yii\data\ArrayDataProvider([
        'allModels' => $model->productSpecifications,
    ]);
    $providerProductStepProperty = new \yii\data\ArrayDataProvider([
        'allModels' => $model->productStepProperties,
    ]);
    $providerProductTechnicalSpecification = new \yii\data\ArrayDataProvider([
        'allModels' => $model->productTechnicalSpecifications,
    ]);

    $content = $this->renderAjax('_pdf', [
        'model' => $model,
        'providerProductGallery' => $providerProductGallery,
        'providerProductSpecifications' => $providerProductSpecifications,
        'providerProductStepProperty' => $providerProductStepProperty,
        'providerProductTechnicalSpecification' => $providerProductTechnicalSpecification,
    ]);

    $pdf = new \kartik\mpdf\Pdf([
        'mode' => \kartik\mpdf\Pdf::MODE_CORE,
        'format' => \kartik\mpdf\Pdf::FORMAT_A4,
        'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
        'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
        'content' => $content,
        'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        'cssInline' => '.kv-heading-1{font-size:18px}',
        'options' => ['title' => \Yii::$app->name],
        'methods' => [
            'SetHeader' => [\Yii::$app->name],
            'SetFooter' => ['{PAGENO}'],
        ]
    ]);

    return $pdf->render();
}

/**
 * Creates a new Product model by another data,
 * so user don't need to input all field from scratch.
 * If creation is successful, the browser will be redirected to the 'view' page.
 *
 * @param mixed $id
 * @return mixed
 */
public
function actionSaveAsNew($id)
{
    $model = new Product();

    if (Yii::$app->request->post('_asnew') != '1') {
        $model = $this->findModel($id);
    }

    if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
        return $this->redirect(['view', 'id' => $model->id]);
    } else {
        return $this->render('saveAsNew', [
            'model' => $model,
        ]);
    }
}

/**
 * Finds the Product model based on its primary key value.
 * If the model is not found, a 404 HTTP exception will be thrown.
 * @param integer $id
 * @return Product the loaded model
 * @throws NotFoundHttpException if the model cannot be found
 */
protected
function findModel($id)
{
    if (($model = Product::findOne($id)) !== null) {
        return $model;
    } else {
        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}

/**
 * Action to load a tabular form grid
 * for ProductGallery
 * @author Yohanes Candrajaya <moo.tensai@gmail.com>
 * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
 *
 * @return mixed
 */
public
function actionAddProductGallery()
{
    if (Yii::$app->request->isAjax) {
        $row = Yii::$app->request->post('ProductGallery');
        if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
            $row[] = [];
        return $this->renderAjax('_formProductGallery', ['row' => $row]);
    } else {
        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}

/**
 * Action to load a tabular form grid
 * for ProductSpecifications
 * @author Yohanes Candrajaya <moo.tensai@gmail.com>
 * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
 *
 * @return mixed
 */
public
function actionAddProductSpecifications()
{
    if (Yii::$app->request->isAjax) {
        $row = Yii::$app->request->post('ProductSpecifications');
        if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
            $row[] = [];
        return $this->renderAjax('_formProductSpecifications', ['row' => $row]);
    } else {
        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}

/**
 * Action to load a tabular form grid
 * for ProductStepProperty
 * @author Yohanes Candrajaya <moo.tensai@gmail.com>
 * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
 *
 * @return mixed
 */
public
function actionAddProductStepProperty()
{
    if (Yii::$app->request->isAjax) {
        $row = Yii::$app->request->post('ProductStepProperty');
        if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
            $row[] = [];
        return $this->renderAjax('_formProductStepProperty', ['row' => $row]);
    } else {
        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}

/**
 * Action to load a tabular form grid
 * for ProductTechnicalSpecification
 * @author Yohanes Candrajaya <moo.tensai@gmail.com>
 * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
 *
 * @return mixed
 */
public
function actionAddProductTechnicalSpecification()
{
    if (Yii::$app->request->isAjax) {
        $row = Yii::$app->request->post('ProductTechnicalSpecification');
        if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
            $row[] = [];
        return $this->renderAjax('_formProductTechnicalSpecification', ['row' => $row]);
    } else {
        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
}
}
