<?php

namespace app\models;

use Yii;
use function Symfony\Component\String\s;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $fio
 * @property string $login
 * @property string $email
 * @property string $password
 * @property int $admin
 *
 * @property Problem[] $problems
 */
class RegForm extends User
{
    public $passwordConfirm;
    public $agree;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'login', 'email', 'password','agree'], 'required','message'=>'Обязательно для заполнения'],
            ['fio', 'match', 'pattern' => '#[А-Яа-я\- ]+#', 'message' => 'Только кириллица, пробелы и дефисы'],
            ['login', 'match', 'pattern' => '/^[a-zA-Z]{1,}$/u', 'message' => 'Только латинские буквы!'],
            ['login', 'unique', 'message' => 'Такой логин уже используется!'],
            ['email', 'email', 'message' => 'Некорректный email!'],
            ['email', 'unique', 'message' => 'Такой email уже используется!'],
            ['passwordConfirm', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли должны сопадать!'],[['agree'], 'boolean'],[['agree'], 'compare', 'compareValue' => true, 'message' => 'Необходимо дать согласие!'],
            [['admin'], 'integer'],
            [['fio', 'email','login', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'login' => 'Логин',
            'email' => 'Почта',
            'password' => 'Пароль',
            'admin' => 'Admin',
            'passwordConfirm' => 'Подтвердите пароль',
            'agree' => 'Даю согласие на обработку данных',
        ];
    }
}

//sssssssssssssssssssssssssss
