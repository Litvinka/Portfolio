<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Responce;
use app\models\Elements;
use yii\web\UploadedFile;


class ElementsController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'edit', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create','edit','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    //Add new element for profession
    public function actionCreate($profession_id){
        $model=new Elements();
        if($model->load(Yii::$app->request->post())){
            $model->image=UploadedFile::getInstance($model,'image');
            $model->profession_id=$profession_id;
            if($model->addInfo()){
                return $this->redirect(['profession/view','id'=>$profession_id]);
            }
        }
        return $this->render('create',['model'=>$model]);
    }
    
    //Edit element
    public function actionEdit($id){
        $model=Elements::find()->where(['id'=>$id])->one();
        if($model->load(Yii::$app->request->post())){
            $model->image=UploadedFile::getInstance($model,'image');
            if($model->addInfo()){
                return $this->redirect(['profession/view','id'=>$model->profession_id]);
            }
        }
        return $this->render('create',['model'=>$model]);
    }
    
    public function actionView($id){
        $model=Elements::find()->where(['id'=>$id])->one();
        if(!isset($session['br_user_name'])){
            $session = Yii::$app->session;
            $session['br_user_name']=$model->profession->user->SetBreadcrumbs();
            $session['br_user_profession']=$model->profession->SetBreadcrumbs();
        }
        return $this->render('view',['model'=>$model]);
    }
    
    
    public function actionDelete(){
        $id=htmlspecialchars($_POST['id']);
        if($id){
            Elements::find()->where(['id'=>$id])->one()->delete();
            $session = Yii::$app->session;
            return $this->redirect($session['br_user_profession']['url']);
        }
        $model=Elements::find()->where(['id'=>$id])->one();
        return $this->render('view',['model'=>$model]);
    }
    
}