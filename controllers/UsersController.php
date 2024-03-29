<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\LoginForm;
use app\models\Profession;
use yii\web\UploadedFile;


class UsersController extends Controller
{

    public function actionEdit($id)
    {
    	if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = User::findIdentity($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->image=UploadedFile::getInstance($model, 'image');
            if($model->addInfo()){
                $model = User::findIdentity($id);
                $profession = Profession::find()->where(['user_id' => $id])->all();
                return $this->render('about', ['model' => $model, 'profession'=>$profession,]);
            }
        }
        Yii::$app->view->title =(!empty($model->surname))? 'Изменение информации' : 'Добавление информации';
        return $this->render('edit', [
            'model' => $model,
        ]);
        
    }


    public function actionAbout($id){
        $model = User::find()->where(['id'=>$id])->one();
        $profession = Profession::find()->where(['user_id' => $id])->all();
        if(Yii::$app->user->isGuest || Yii::$app->user->identity->id!=$model->id){
            $profession = Profession::find()->where(['user_id' => $id, 'visibility_id' => '1'])->all();
        }
    	return $this->render('about', [
            'model' => $model, 'profession'=>$profession,
        ]);
    }


}
