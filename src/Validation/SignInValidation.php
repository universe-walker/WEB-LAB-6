<?php

namespace App\Validation;

class SignInValidation
{
    public static $sign_in_rules = [
        "email" => [
            "required" => true
        ],
        "password" => [
            "required"  => true,
            "maxLength" => 20,
            "minLength" => 6,
        ]
    ];

    public static $sign_in_messages = [
        "email" => [
            "required" => "Поле email обязательно"
        ],
        "password" => [
            "required"  => "Поле пароль обязатльно",
            "maxLength" => "Пароль должен быть не длинее 20 символов",
            "minLength" => "Пароль должен быть не короче 6 симовлов",
        ]
    ];
}
