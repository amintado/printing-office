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

use common\models\UserInfo;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        require(__DIR__.'/../../cms/wp-load.php');
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
//        } else {
//            return $this->render('login', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
//        } else {
//            return $this->render('contact', [
//                'model' => $model,
//            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionProfile()
    {
        return $this->redirect(Yii::$app->urlManagerBackend->createUrl('//'));
    }


    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        //Port number from masked to original
        $post = Yii::$app->request->post();
        if (!empty($post['SignupForm']['username'])) {
            $post['SignupForm']['username'] = str_replace(['(', ')', ' ', '-'], '', $post['SignupForm']['username']);
        }

        $model = new SignupForm();
        if ($model->load($post)) {


            if ($user = $model->GetMobile()) {
                $model->scenario = SignupForm::SCENARIO_GET_CODE;
                return $this->render('getCode', ['model' => $model]);
            }
        }
        if (!empty($model->username)) {
            $model->username = substr($model->username, 1, strlen($model->username));
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionVerify()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        //Port number from masked to original
        $post = Yii::$app->request->post();
        if (!empty($post['SignupForm']['VerificationCode'])) {
            $post['SignupForm']['VerificationCode'] = str_replace(['(', ')', ' ', '-'], '', $post['SignupForm']['VerificationCode']);
        }

        $model = new SignupForm();


        $model->scenario = SignupForm::SCENARIO_GET_CODE;
        if ($model->load($post)) {

            switch ($model->GetCode()) {
                case null:
                    return $this->render('notVerify');
                case 'signup':

                    return $this->render('signupForm2', ['model' => $model]);
                case 'login':
                    return $this->redirect('/frontend');
            }
        }
        if (!empty($model->username)) {
            $model->username = substr($model->username, 1, strlen($model->username));
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionSignupStep2()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $post = Yii::$app->request->post();
        $model = new SignupForm();
        $model->scenario = SignupForm::SCENARIO_GET_USER_DETAIL;
        if ($model->load($post)) {

            if ($model->GetDetail()) {
               return $this->redirect('/frontend');
            }else{
                return $this->render('signupForm2', ['model' => $model]);
            }

        }
    }
}
