<?php

namespace app\models;

use Yii;

class PhotoElements extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'photo_elements';
    }

    public function rules()
    {
        return [
            [['element_id', 'link'], 'required'],
            [['element_id'], 'integer'],
            [['link'], 'string'],
            [['element_id'], 'exist', 'skipOnError' => true, 'targetClass' => Elements::className(), 'targetAttribute' => ['element_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'element_id' => 'Element ID',
            'link' => 'Link',
        ];
    }
    
    public function getElement()
    {
        return $this->hasOne(Elements::className(), ['id' => 'element_id']);
    }
}
