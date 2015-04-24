<?php

namespace app\controllers;

use app\models\RegistrationForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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

    public function actionIndexTwo()
    {
        return $this->render('index_two');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if(Yii::$app->request->isAjax){
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            } else {
                $response = [
                    'status' => 'error',
                    'errors' => $model->getErrors()
                ];
                echo json_encode($response);
                Yii::$app->end();
            }
        }else {
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            } else {
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionRegistration(){
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegistrationForm();

        if(Yii::$app->request->isAjax){
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $user = new User();
                $user->username = $model->username;
                $user->email = $model->email;
                $user->setPassword($model->password);

                if ($user->save()) {
                    /*Yii::$app->mailer->compose('confirmEmail', ['user' => $user])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                        ->setTo($model->email)
                        ->setSubject('Email confirmation for ' . Yii::$app->name)
                        ->send();*/
                    Yii::$app->user->login($user, $model->rememberMe ? 3600 * 24 * 30 : 0);
                    return $this->goHome();
                } else {
                    $response = [
                        'status' => 'error',
                        'errors' => $model->getErrors()
                    ];
                    echo json_encode($response);
                    Yii::$app->end();
                }
            } else {
                $response = [
                    'status' => 'error',
                    'errors' => $model->getErrors()
                ];
                echo json_encode($response);
                Yii::$app->end();
            }
        }else {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $user = new User();
                $user->username = $model->username;
                $user->email = $model->email;
                $user->setPassword($model->password);

                if ($user->save()) {
                    /*Yii::$app->mailer->compose('confirmEmail', ['user' => $user])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                        ->setTo($model->email)
                        ->setSubject('Email confirmation for ' . Yii::$app->name)
                        ->send();*/
                    Yii::$app->user->login($user, $model->rememberMe ? 3600 * 24 * 30 : 0);
                    return $this->goHome();
                } else {
                    return $this->render('registration', [
                        'model' => $model,
                    ]);
                }
            } else {
                return $this->render('registration', [
                    'model' => $model,
                ]);
            }
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

    public function actionAbout()
    {
        return $this->render('about');
    }
}
