<?php

session_start();
if (!$_SESSION['user_id']) {
    header("Location: /");
}

header("Content-Type: application/json");

require_once "validation/sign_up_validation.php";
require_once "models/models.php";

$data = $_POST;
$validation_obj = new FormValidator($sign_up_rules, $sign_up_messages, $data);
$validation_obj->validate();

$errors = $validation_obj->getErrorMessages();

if (!$errors) {
    $user_obj = new User();

    if ($user_obj->isEmailFree($data['email'])) {
        $save_result = $user_obj->save($data['name'], $data['email'], $data['phone'], $data['password']);

        if ($save_result) {
            $_SESSION['user_id'] = $user_obj->getUserIdByEmail($data['email']);
        } else {
            array_push($errors, "Не удалось создать пользователя");
        }
    } else {
        array_push($errors, "Пользователь с таким email уже существует");
    }
}

if (!empty($errors)) {
    echo json_encode(["errors" => $errors]);
} else {
    echo json_encode(["response" => "OK"]);
}
