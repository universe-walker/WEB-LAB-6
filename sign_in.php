<?php

require "auth/utils.php";
redirectIfUserLogged();

header("Content-Type: application/json");

require_once "validation/sign_up_validation.php";
require_once "models/models.php";
require_once "validation/sign_in_validation.php";

$data = $_POST;
$validation_obj = new FormValidator($sign_in_rules, $sign_in_messages, $data);
$validation_obj->validate();

$errors = $validation_obj->getErrorMessages();

if (empty($errors)) {
    $user_obj = new User();
    $user = $user_obj->getUserIfPasswordVerify($data['email'], $data['password']);

    if ($user) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['user_id'] = $user['user_id'];
    } else {
        array_push($errors, "Неверный логин или пароль");
    }
}

if (!empty($errors)) {
    echo json_encode(["errors" => $errors]);
} else {
    echo json_encode(["response" => "OK"]);
}
