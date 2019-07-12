<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'about'],
                'rules' => [
                    [
                        'actions' => ['logout','about'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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


    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(array('/users/about','id'=>Yii::$app->user->identity->id));
        }
        $model = new SignupForm(); 
        if ($model->load(Yii::$app->request->post())) { 
            if ($user = $model->signup()) { // Регистрация
                if (Yii::$app->getUser()->login($user)) { 
                    return $this->goHome(); 
            }
        }
        }
        return $this->render('signup', [ 
            'model' => $model,
        ]);
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(array('/users/about','id'=>Yii::$app->user->identity->id));
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user=User::findByEmail($model->email);
            if(!$user->surname){
                return $this->redirect(['users/edit', 'id' => $user->id]);
            }
            else{
                return $this->redirect(['users/about', 'id' => $user->id]);
            }
            return $this->goHome();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
