<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Responce;
use app\models\Elements;
use app\models\PhotoElements;
use app\models\ElementTags;
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
            $photos=PhotoElements::find()->where(['element_id'=>$id])->all();
            foreach($photos as $photo){
                if (file_exists($photo->link)) {
                    unlink($photo->link);
                }
                $photo->delete();
            }
            $tags=ElementTags::find()->where(['element_id'=>$id])->all();
            foreach($tags as $tag){
                $tag->delete();
            }
            $element=Elements::find()->where(['id'=>$id])->one();
            if (file_exists($element->main_photo)) {
                unlink($element->main_photo);
            }
            $element->delete();
            $session = Yii::$app->session;
            return $this->redirect($session['br_user_profession']['url']);
        }
        $model=Elements::find()->where(['id'=>$id])->one();
        return $this->render('view',['model'=>$model]);
    }
    
    
    public function actionDeletephoto(){
        $id=($_POST) ? htmlspecialchars($_POST['id']) : 0;
        if($id>0){
            $photo=PhotoElements::find()->where(['id'=>$id])->one();
            unlink($photo->link);
            $photo->delete();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
    
    
}