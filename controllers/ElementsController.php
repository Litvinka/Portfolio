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
    
}