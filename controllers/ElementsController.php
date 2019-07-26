<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Responce;
use app\models\Elements;
use app\models\PhotoElements;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;


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
            $model->photos=UploadedFile::getInstances($model,'photos');
            $model->tags=htmlspecialchars(trim($_POST['Elements']['tags']));
            $model->profession_id=$profession_id;
            if($model->addInfo()){
                return $this->redirect(['profession/view','id'=>$profession_id]);
            }
        }
        Yii::$app->view->title="Добавление элемента";
        return $this->render('create',['model'=>$model]);
    }
    
    //Edit element
    public function actionEdit($id){
        $model=Elements::find()->where(['id'=>$id])->one();
        if($model->load(Yii::$app->request->post())){
            $model->image=UploadedFile::getInstance($model,'image');
            $model->photos=UploadedFile::getInstances($model,'photos');
            $model->tags=htmlspecialchars(trim($_POST['Elements']['tags']));
            if($model->addInfo()){
                return $this->redirect(['profession/view','id'=>$model->profession_id]);
            }
        }
        Yii::$app->view->title="Редактирование элемента";
        return $this->render('create',['model'=>$model]);
    }
    
    
    public function actionView($id){
        $model=Elements::find()->where(['id'=>$id])->one();
        if(!isset($session['br_user_name'])){
            $session = Yii::$app->session;
            $session['br_user_name']=$model->profession->user->SetBreadcrumbs();
            $session['br_user_profession']=$model->profession->SetBreadcrumbs();
        }
        $dataProvider = new ActiveDataProvider([
            'query' => PhotoElements::find()->where(['element_id'=>$id]),
            'pagination' => [
                'pageSize' => 28,
            ],
        ]);
        return $this->render('view',['model'=>$model, 'dataProvider'=>$dataProvider]);
    }
    
    
    public function beforeAction($action)
    {            
        if ($action->id == 'upload') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
    
    
    public function actionUpload(){
        $id=Yii::$app->request->post('id');
        $model=Elements::find()->where(['id'=>$id])->one();
        $file=$_FILES['file'];
        $newfilename = date('dmYHis').'_'.str_replace(" ", "", $file['name']);
        $filesize = $file['size'];
        $location = Yii::getAlias('@webroot') . '/files/elements/' . $newfilename;
        $src='files/elements/'.$newfilename;
        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
            $photoElement = new PhotoElements();
            $photoElement->element_id = $id;
            $photoElement->link = $src;
            $photoElement->save();
        }
        echo json_encode($src);
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