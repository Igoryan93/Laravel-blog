<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Validate extends Model
{
    public static function check($request, $rules) {
        $messages = [
            'required' => 'Поле :attribute обязательно для заполнения',
            'same'     => 'Поле :attribute и :other не совпадают',
            'email'    => 'Поле :attribute должно быть в формате example@gmail.com',
            'min'      => 'Поле :attribute должно иметь минимум :min символа',
            'max'      => 'Поле :attribute не должно превышать :max символа',
            'unique'   => 'Пользователь с таким :attribute уже занят',
            'numeric'  => 'Поле :attribute должно быть в формате телефонного номера',
            'mimes'    => 'Поле :attribute должно быть в форматах jpg, jpeg, png',
            'remember.required' => 'Пункт соглашения с правилами обязателен для заполнения'
        ];
        $renameInput = [
            'email' => 'E-mail',
            'name'  => 'Имя',
            'job'   => 'Место работы',
            'phone' => 'Номер телефон',
            'address' => 'Адрес',
            'image'   => 'Выберите аватар',
            'password'       => 'Пароль',
            'password_again' => 'Повторите пароль',
            'password_new'   => 'Новый пароль',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->setAttributeNames($renameInput);

        return $validator;
    }
}
