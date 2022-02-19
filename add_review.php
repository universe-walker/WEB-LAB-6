<?php

require_once "auth/utils.php";

redirectIfUserNotLogged();
$user = getUserIfUserLogged();

$errors = $_SESSION['errors'] ?? array();

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление обзора</title>
    <link rel="stylesheet" href="views/css/reset.css" type="text/css">
    <link rel="stylesheet" href="views/css/base_style.css" type="text/css">
    <link rel="stylesheet" href="views/css/add_review.css" type="text/css">
</head>

<body>
    <div class="wrapper">
        <?php require_once "views/layouts/header.php"; ?>
        <div class="main">
            <div class="container">
                <div class="main__row">
                    <h3 class="main__title">Добавление обзора</h3>
                    <div class="main__form-wrapper">
                        <form action="add_review_handler.php" class="main__form" method="POST"
                            enctype="multipart/form-data">
                            <label>Название</label>
                            <input type="text" name="title">
                            <label>Оригинальное название</label>
                            <input type="text" name="original_title">
                            <label>Год выхода</label>
                            <input type="number" name="release_year" min="1895">
                            <label>Постер</label>
                            <input type="file" name="poster">
                            <label>Ссылка на трейлер (youtube)</label>
                            <input type="text" name="trailer_link">
                            <label>Текст обзора</label>
                            <textarea name="text_post" cols="30" rows="10"></textarea>
                            <label>Оценка</label>
                            <input type="number" name="rating">
                            <label>Опубликовать сейчас <input type="checkbox" name="is_publish" class="form__is-publish"
                                    value="false"></label>

                            <?php foreach ($errors as $e): ?>
                            <div class="error"><?= $e ?>
                            </div>
                            <?php endforeach ?>

                            <button class="form__submit" type="submit">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once "views/layouts/footer.php" ?>
    </div>
</body>

</html>