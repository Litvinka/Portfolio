<?php

namespace app\models;

use Yii;
use app\models\PhotoElements;


class Elements extends \yii\db\ActiveRecord
{
    
    public $image;
    public $photos;
    
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
        $elements=new Elements();
        $elements->name=$this->name;
        $elements->profession_id=$this->profession_id;
        $elements->about=$this->about;
        if($this->image!=null){
            $newfilename = date('dmYHis').'_'.str_replace(" ", "", $this->image->name);
            $elements->main_photo='files/elements/'.$newfilename;
            $this->image->saveAs(Yii::getAlias('@webroot') . '/files/elements/' . $newfilename);
        }
        if($elements->save()){
            if($this->photos!=null){
                foreach($this->photos as $ph){
                    $newfilename = date('dmYHis').'_'.str_replace(" ", "", $ph->name);
                    $photoElement = new PhotoElements();
                    $photoElement->element_id = $elements->id;
                    $photoElement->link = 'files/elements/'.$newfilename;
                    $photoElement->save();
                    $ph->saveAs(Yii::getAlias('@webroot') . '/files/elements/' . $newfilename);
                }
            }
        }
        else{
            return null;
        }
        return $elements;
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
