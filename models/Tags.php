<?php

namespace app\models;

use Yii;


class Tags extends \yii\db\ActiveRecord
{   
    public function addTag(){
        $t = Tags::find()->where(['name'=>$this->name])->one();
        if(!$t){
            $this->save();
        }
        else{
            $this->id=$t->id;
        }
    }
    
    public static function tableName()
    {
        return 'tags';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getElementTags()
    {
        return $this->hasMany(ElementTags::className(), ['tag_id' => 'id']);
    }
}
