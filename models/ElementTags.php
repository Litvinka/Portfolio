<?php

namespace app\models;

use Yii;

class ElementTags extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'element_tags';
    }

    public function rules()
    {
        return [
            [['element_id', 'tag_id'], 'required'],
            [['element_id', 'tag_id'], 'integer'],
            [['element_id'], 'exist', 'skipOnError' => true, 'targetClass' => Elements::className(), 'targetAttribute' => ['element_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'element_id' => 'Element ID',
            'tag_id' => 'Tag ID',
        ];
    }

    public function getElement()
    {
        return $this->hasOne(Elements::className(), ['id' => 'element_id']);
    }

    public function getTag()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }
}
