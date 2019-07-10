<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;
use app\models\Profession;
use yii\web\UploadedFile;
use app\models\Elements;
use yii\data\ActiveDataProvider;

class ProfessionController extends Controller
{
    public function actionIndex($id)
    {
    	$profession = Profession::find()->where(['user_id' => $id])->all();
        return $this->renderPartial('index', ['models' => $profession,]);
    }
    
    //Create new profession
    public function actionCreate(){
        $model=new Profession();
        if ($model->load(Yii::$app->request->post())) {
        	$model->image=UploadedFile::getInstance($model,'image');
        	if($model->addInfo()){
            	return $this->redirect(['users/about', 'id' => Yii::$app->user->identity->id,]);
        	}
        }
        Yii::$app->view->title="Добавление рода деятельности";
        return $this->render('create',['model'=>$model]);
    }
    
    //Edit profession
    public function actionEdit($id){
        $model=Profession::find()->where(['id'=>$id])->one();
        if ($model->load(Yii::$app->request->post())) {
        	$model->image=UploadedFile::getInstance($model,'image');
        	if($model->addInfo()){
            	return $this->redirect(['users/about', 'id' => Yii::$app->user->identity->id,]);
        	}
        }
        Yii::$app->view->title="Редактирование рода деятельности";
        return $this->render('create',['model'=>$model]);
    }

    
    //Details of profession
    public function actionView($id){
    	$model=Profession::find()->where(['id'=>$id])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => Elements::find()->where(['profession_id'=>$id]),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);
        if(!isset($session['br_user_name'])){
            $session = Yii::$app->session;
            $session['br_user_name']=$model->user->SetBreadcrumbs();
        }
    	return $this->render('view',['model'=>$model,'dataProvider'=>$dataProvider]);
    }

}
