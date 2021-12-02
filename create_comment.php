<?php

require_once "auth/utils.php";
redirectIfUserNotLogged();

header("Content-Type: application/json");

require_once "validation/comment_validation.php";
require_once "validation/validation.php";
require_once "models/models.php";

$data = $_POST;

if (!empty($data)) {
    $comment_validator = new FormValidator($comment_rules, $comment_messages, $data);
    $comment_validator->validate();
    $errors = $comment_validator->getErrorMessages();

    if (empty($errors)) {
        $comment_obj = new Comment();
        $comment_id = $comment_obj->insertNewCommentAndReturnItId((int) $data['post_id'], $data['text'], (int) $_SESSION['user_id']);
        
        error_log(json_encode([(int) $data['post_id'], $data['text'], (int) $_SESSION['user_id']]));
        
        $comment = $comment_obj->getCommentById($comment_id);

        if ($comment) {
            echo json_encode([
                "response" => "OK",
                "comment" => [
                    "date_time" => $comment['date_time'],
                    "user"     => $comment['name'],
                    "avatar"   => $comment['avatar'],
                ]
            ]);
        } else {
            array_push($errors, "Не получилось создать комментарий");
        }
    }

    if (!empty($errors)) {
        echo json_encode(["errors" => $errors]);
    }
} else {
    echo json_encode(["errors" => "Нет переданных данных!!"]);
}