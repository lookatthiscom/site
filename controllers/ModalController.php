<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\RegistrationForm;
use yii\base\Controller;

class ModalController extends Controller
{
    public function actionShow(){
        $modal = \Yii::$app->request->getQueryParam('modal', 'error');
        switch($modal){
            case 'login':
                $loginForm = new LoginForm();
                $registrationForm = new RegistrationForm();
                $response = [
                    'view' => $this->renderPartial('login',['model' => $loginForm, 'registration' => $registrationForm])
                ];
                return json_encode($response);
            \Yii::$app->end();
            default:
                $response = [
                    'view' => $this->renderPartial('default')
                ];
                return json_encode($response);
                \Yii::$app->end();
        }
    }
}