<?php

require_once "validation.php";


$sign_up_rules = [
    "name" => [
        "required"  => true,
        "isString"  => true,
        "maxLength" => 20,
        "minLength" => 6,
        //"regexpCheck" => '/^[^ -d][А-Яа-яЁё -]+$/m'
    ],
    "email" => [
        "required" => true,
        "isString" => true,
    ],
    "phone" => [
        "required"  => true,
        "isString"  => true,
        "maxLength" => 10,
        "minLength" => 10,
    ],
    "personal_data" => [
        "isTrue" => true
    ],
    "password" => [
        "required"  => true,
        "isString"  => true,
        "maxLength" => 20,
        "minLength" => 6,
        "passwordConfirmation" => "password_repeat",
    ],
    "password_repeat" => [
        "required" => true,
    ]
];

$sign_up_messages = [
    "name" => [
        "required"  => "Поле имя обязательно",
        "isString"  => "Имя должно быть строкой",
        "maxLength" => "Имя должно быть не длинее 20 символов",
        "minLength" => "Имя должно быть не короче 6 симовлов",
        //"regexpCheck" => "Имя может содержать только русские буквы, пробелы, дефисы"
    ],
    "email" => [
        "required" => "Поле email обязательно",
        "isString" => "Email должен быть строкой",
    ],
    "phone" => [
        "required"  => "Поле телефон обязательно",
        "isString"  => "Телефон должен быть строкой",
        "maxLength" => "Поле телефон должно быть не длинее 10 символов",
        "minLength" => "Поле телефон должно быть не короче 10 символов",
    ],
    "personal_data" => [
        "isTrue" => "Поле персональные данные должно быть выбрано"
    ],
    "password" => [
        "required"             => "Пароль обязателен",
        "isString"             => "Пароль должен быть строкой",
        "maxLength"            => "Пароль должен быть не длинее 20 символов",
        "minLength"            => "Пароль должен быть не короче 6 симовлов",
        "passwordConfirmation" => "Пароли должны совпадать",
    ],
    "password_repeat" => [
        "required" => "Повторите пароль",
        "isString" => "Повторный пароль должен быть строкой",
    ]
];
