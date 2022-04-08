<?php
$post = $params['post'];
$user = $params['user'];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>КинтоТекст | <?= $post['title'] ?>
    </title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/base_style.css">
    <link rel="stylesheet" href="/css/detail.css">
    <link rel="stylesheet" href="/css/modal.css">
</head>

<body>
    <div class="wrapper">
        <?php require_once "layouts/header.php"; ?>
        <div class="main">
            <div class="container">
                <div class="main__row">
                    <?php require_once "main_film.php" ?>
                    <div class="main__comment-wrapper">
                        <div class="main__comment">
                            <?php require_once "comment_loader.php" ?>
                        </div>
                        <?php if ($user): ?>
                        <?php require_once "layouts/comment_form.php" ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once "layouts/footer.php"; ?>
        <?php require_once "layouts/popup.php" ?>
    </div>
    <script src="/node_modules/just-validate/dist/js/just-validate.min.js"></script>
    <script src="/js/modal_window.js"></script>
    <script src="/js/check_comment_form.js"></script>
</body>

</html>