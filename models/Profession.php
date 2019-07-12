<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


class Profession extends \yii\db\ActiveRecord
{
    public $image;

    public static function tableName()
    {
        return 'profession';
    }

    //set breadcrumbs profession
    public function SetBreadcrumbs(){
        return ['label'=>$this->name, 'url'=>['profession/view','id'=>$this->id]];
    }
    
    
    public function rules()
    {
        return [
            [['name','visibility_id'], 'required'],
            [['user_id', 'experience_id', 'visibility_id'], 'integer'],
            [['skills', 'main_photo', 'about'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['image'],'file','extensions'=>'jpg'],
            [['experience_id'], 'exist', 'skipOnError' => true, 'targetClass' => Experience::className(), 'targetAttribute' => ['experience_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['visibility_id'], 'exist', 'skipOnError' => true, 'targetClass' => Visibility::className(), 'targetAttribute' => ['visibility_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Род деятельности',
            'experience_id' => 'Опыт',
            'skills' => 'Навыки',
            'main_photo' => 'Картинка',
            'about' => 'Описание',
            'visibility_id'=>'Видимость'
        ];
    }


    public function addInfo(){
        if(!$this->validate()){
            return null;
        }
        $profession=new Profession();
        $profession->user_id=Yii::$app->user->identity->id;
        $profession->name=$this->name;
        $profession->experience_id=$this->experience_id;
        $profession->skills=$this->skills;
        $profession->visibility_id=$this->visibility_id;
        $profession->about=$this->about;
        if($this->image!=null){
            $newfilename = date('dmYHis').'_'.str_replace(" ", "", $this->image->name);
            $profession->main_photo='files/profession/'.$newfilename;
            $this->image->saveAs(Yii::getAlias('@webroot') . '/files/profession/'.$newfilename);
        }
        return ($profession->save()) ? $profession : null;
    }

    
    public function allExperience(){
        return ArrayHelper::map(Experience::find()->all(),'id','name');
    }

    public function allVisibility(){
        return ArrayHelper::map(Visibility::find()->all(),'id','name');
    }
    

    public function getElements()
    {
        return $this->hasMany(Elements::className(), ['profession_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperience()
    {
        return $this->hasOne(Experience::className(), ['id' => 'experience_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisibility()
    {
        return $this->hasOne(Visibility::className(), ['id' => 'visibility_id']);
    }
}
