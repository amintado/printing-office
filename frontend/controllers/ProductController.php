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


use common\models\Product;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class ProductController extends Controller
{

    public function actionIndex(){
        $model=Product::find()->active()->all();
        return  $this->render('index',
            [
              'model'=>$model
            ]
            );
    }

    public function actionView($id){
        $model=Product::find()->andWhere(['hash_id'=>$id])->one();
        if (empty($model)){
            throw new BadRequestHttpException('This Product Is Unavailable');
        }
        return $this->render('view',
            [
              'model'=>$model
            ]
            );
    }
}