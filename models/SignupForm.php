<?php

namespace app\models;

use Yii;
use yii\base\Model;


class SignupForm extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'string', 'max' => 100],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такой email уже есть в базе данных.'],
            ['email', 'trim'],
            ['email', 'email'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels() // Используется для локализации
    {
        return [
            'email' => 'Электронная почта',
            'password' => 'Пароль',
        ];
    }

    public function signup() // Регистрация
    {

        if (!$this->validate()) { // Если валидация вернула false то возвращаем null
            return null;
        }
        $user = new User(); // Используем AcriveRecord User
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->created_at = date("Y-m-d H:i:s");
        $user->updated_at = date("Y-m-d H:i:s");
        $user->role_id=2;
        $user->status_id=1;
        return $user->save() ? $user : null; // Сохраняем свойства в таблицу(метод ActivityRecord) user если переменная не равна null
    }

}
