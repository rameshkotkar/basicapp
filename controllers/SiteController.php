<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\ResetPasswordForm;
use app\models\ForgotPasswordForm;

class SiteController extends Controller 
{

    public function behaviors() 
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'profile', 'changepassword', 'generateApiKey'],
                'rules' => [
                    [
                        'actions' => ['logout', 'profile', 'changepassword', 'generateApiKey'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
                /* 'verbs' => [
                  'class' => VerbFilter::className(),
                  'actions' => [
                  'logout' => ['post'],
                  ],
                  ],

                 */
        ];
    }

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

    public function actionIndex() 
    {
        //Guest redirect to login page
        if (Yii::$app->user->isGuest) {
            $this->redirect(array('site/login'));
        }
        return $this->render('index');
    }

    public function actionLogin() 
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() 
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact() 
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /*
     * view/update profile details
     */

    public function actionProfile() 
            
    {
        $model = User::findById(Yii::$app->user->identity->id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // $model->setPassword($model->password);
                // form inputs are valid, do something here
                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Your profile has been successfully updated !');
                } else {
                    Yii::$app->getSession()->setFlash('danger', 'Error while updating the profile !');
                }
                return Yii::$app->getResponse()->redirect(['site/profile']);
            }
        }
        return $this->render('profile', [
                    'model' => $model,
        ]);
    }

    /*
     * change password of the user
     */

    public function actionChangepassword() 
    {
        $model = new \app\models\ChangePasswordForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $user = User::findById(Yii::$app->user->identity->id);
                $user->setPassword($model->new_password);
                // form inputs are valid, do something here
                if ($user->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Your password has been successfully updated !');
                } else {
                    Yii::$app->getSession()->setFlash('danger', 'Error while updating the password !');
                }
                return Yii::$app->getResponse()->redirect(['site/changepassword']);
            }
        }
        return $this->render('changepassword', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionForgotpassword() 
    {
        $model = new ForgotPasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
                //return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('danger', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('forgotpassword', [
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
    public function actionResetpassword($token) 
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }
        return $this->render('resetpassword', [
                    'model' => $model,
        ]);
    }

    /**
     * Generate random Api Key
     */
    public function actionGenerateApiKey() 
    {
        $user = new User();
        $user->generateAccessToken();
        echo $user->access_token;
    }

}
