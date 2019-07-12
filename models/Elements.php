<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "elements".
 *
 * @property int $id
 * @property string $name
 * @property int $profession_id
 * @property string $main_photo
 * @property string $about
 *
 * @property ElementTags[] $elementTags
 * @property Profession $profession
 * @property PhotoElements[] $photoElements
 */
class Elements extends \yii\db\ActiveRecord
{
    
    public $image;
    
    public static function tableName()
    {
        return 'elements';
    }

    /**
     * {@inheritdoc}
     */
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
        return ($elements->save()) ? $elements : null;
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElementTags()
    {
        return $this->hasMany(ElementTags::className(), ['element_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfession()
    {
        return $this->hasOne(Profession::className(), ['id' => 'profession_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoElements()
    {
        return $this->hasMany(PhotoElements::className(), ['element_id' => 'id']);
    }
}
