<?php

namespace app\models;

use Yii;
use app\models\PhotoElements;


class Elements extends \yii\db\ActiveRecord
{
    
    public $image;
    public $photos;
    public $tags;
    
    public static function tableName()
    {
        return 'elements';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['profession_id'], 'integer'],
            [['main_photo', 'about'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'profession_id' => 'Профессия',
            'main_photo' => 'Фото',
            'about' => 'Описание',
        ];
    }
    
    public function addInfo(){
        if(!$this->validate()){
            return null;
        }
        if($this->image!=null){
            $newfilename = date('dmYHis').'_'.str_replace(" ", "", $this->image->name);
            $this->main_photo='files/elements/'.$newfilename;
            $this->image->saveAs(Yii::getAlias('@webroot') . '/files/elements/' . $newfilename);
        }
        if($this->save()){
            if($this->photos!=null){
                foreach($this->photos as $ph){
                    $newfilename = date('dmYHis').'_'.str_replace(" ", "", $ph->name);
                    $photoElement = new PhotoElements();
                    $photoElement->element_id = $this->id;
                    $photoElement->link = 'files/elements/'.$newfilename;
                    $photoElement->save();
                    $ph->saveAs(Yii::getAlias('@webroot') . '/files/elements/' . $newfilename);
                }
            }
            $this->setElementTags();
        }
        else{
            return null;
        }
        return true;
    }
    
    
    public function setElementTags()
    {
        $tags=explode(',', $this->tags);
        ElementTags::deleteAll(['element_id' => $this->id]);
        foreach($tags as $value){
            $t=new Tags();
            $t->name=trim($value);
            $t->addTag();
            $elementTag=new ElementTags();
            $elementTag->element_id=$this->id;
            $elementTag->tag_id=$t->id;
            $elementTag->save();
        }
    }
    
    
    public function getTags(){
        $str="";
        $tags=ElementTags::find()->Where(['element_id'=>$this->id])->all();
        for($i=0;$i<count($tags);++$i){
            if($i>0 && $i<(count($tags))){
                $str.=", ";
            }
            $str.=$tags[$i]->tag->name;
        }
        return $str;
    }
    
    
    public function getElementTags()
    {
        return $this->hasMany(ElementTags::className(), ['element_id' => 'id']);
    }

    public function getProfession()
    {
        return $this->hasOne(Profession::className(), ['id' => 'profession_id']);
    }

    public function getPhotoElements()
    {
        return $this->hasMany(PhotoElements::className(), ['element_id' => 'id']);
    }
}
