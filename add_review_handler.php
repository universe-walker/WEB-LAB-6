<?php

require_once "auth/utils.php";
require_once "validation/add_review_validation.php";
require_once "validation/file_validatator.php";
require_once "models/models.php";

use App\Validator\FileValidator;
use App\Validator\ReviewValidator;

redirectIfUserNotLogged();
$user = getUserIfUserLogged();

$validator = new ReviewValidator();
$errors = $validator->validate($_POST);

$validator_poster = new FileValidator('poster', ['image/jpeg', 'image/png'], 1);
$errors += $validator_poster->validate();


if (!empty($errors)) {
    unset($_SESSION['errors']);
    $_SESSION['errors'] = $errors;

    header('Location: add_review.php');
}

$path_info = pathinfo($_FILES['poster']['name']);
$ext = $path_info['extension'] ?? "";
$new_path = 'upload' . "/" . uniqid() . "." . $ext;
$from = $_FILES['poster']['tmp_name'];

// получаем код встроенного видео
$url_youtube = "https://www.youtube.com/oembed?url=" . $_POST['trailer_code'] . "&format=json&maxwidth=560&maxheight=315";
$ch = curl_init($url_youtube);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = json_decode(curl_exec($ch), true);
curl_close($ch);

$trailer_code = $response['html'];


if (move_uploaded_file($from, $new_path)) {
    $post_obj = new Post();
    $new_post_id = $post_obj->addPost(
        $user['user_id'],
        htmlspecialchars($_POST['title']),
        htmlspecialchars($_POST['original_title']),
        $new_path,
        $trailer_code,
        htmlspecialchars($_POST['text_post']),
        htmlspecialchars((bool) $_POST['is_publish']),
        htmlspecialchars((int) $_POST['release_year']),
        htmlspecialchars((int) $_POST['rating'])
    );

    header('Location: detail.php?post-id=' . $new_post_id);
} else {
    unset($_SESSION['errors']);
    $_SESSION['errors'] = "Не удалось загрузить файл\n";

    header('Location: add_review.php');
}
