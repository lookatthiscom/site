<?php

namespace app\controllers;

use app\models\Article;
use app\models\ArticleForm;
use app\models\ArticleShow;
use Yii;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Helper;

class ArticleController extends Controller
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

    public function actionNew(){
        $article = new Article();
        $article->save();
        return $this->redirect(['article/create', 'public_id' => $article->public_id]);
    }

    public function actionPreview($public_id){
        //$this->layout = 'small_panels';
        $article = new Article();
        $article = $article->findByPublicId($public_id);
        return $this->render('preview', ['article' => $article]);
    }

    public function actionCreate($public_id){
        //$this->layout = 'small_panels';
        $modelForm = new ArticleForm();
        $article = new Article();
        $article = $article->findByPublicId($public_id);

        if($modelForm->load(Yii::$app->request->post()) && $modelForm->validate()){
            /*foreach( $modelForm->attributes as $key => $value){
                $article->$key = $value;
            }*/
            $article->title = $modelForm->title;
            $article->description = $modelForm->description;
            $article->part1 = $modelForm->part1;
            $article->part2 = $modelForm->part2;
            $article->save();
            return $this->redirect(['article/show', 'public_title' => $article->public_title]);

        }else{
            $modelForm->attributes = $article->attributes;
            return $this->render('new',['model' => $modelForm, 'article' => $article]);
        }
    }

    public function actionShow($public_title){
        //$this->layout = 'small_panels';
        $article = new Article();
        $article = $article->findByPublicTitle($public_title);

        //send message to admin about create article
        /*\Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo(\Yii::$app->params['adminEmail'])
            ->setSubject('Test message subject')
            ->setTextBody('Plain text content LOOK AT THIS')
            ->setHtmlBody('<b>HTML content from lookatthis.com</b>')
            ->send();*/
        //add show count only for unique overview
        $article->isNewObserver(Helper::getUserLocation());

        return $this->render('show', ['article' => $article]);
    }

    public function actionAjaxPreview($public_id){
        $modelForm = new ArticleForm();
        $article = new Article();
        $article = $article->findByPublicId($public_id);
        if($modelForm->load(Yii::$app->request->post()) && $modelForm->validate()){
            /*foreach( $modelForm->attributes as $key => $value){
                $article->$key = $value;
            }*/
            $article->title = $modelForm->title;
            $article->description = $modelForm->description;
            $article->part1 = $modelForm->part1;
            $article->part2 = $modelForm->part2;
            $article->save();
            $response = [
                'status' => 'ok',
                'url' => Url::to(['article/preview', 'public_id' => $public_id])
            ];
            echo json_encode($response);
            Yii::$app->end();
        }else{
            $response = [
                'status' => 'error',
                'errors' => $modelForm->getErrors()
            ];
            echo json_encode($response);
            Yii::$app->end();
        }
    }
}
