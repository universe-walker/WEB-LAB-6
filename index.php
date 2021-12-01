<?php
    require_once "auth/utils.php";
    $user = getUserIfUserLogged();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>КинтоТекст | Главная</title>
    <link rel="stylesheet" href="views/css/reset.css" type="text/css">
    <link rel="stylesheet" href="views/css/base_style.css" type="text/css">
    <link rel="stylesheet" href="views/css/index_style.css" type="text/css">
    <link rel="stylesheet" href="/views/css/modal.css">
</head>

<body>
    <div class="wrapper">
        <?php require_once "views/layouts/header.php"; ?>
        <div class="main">
            <div class="container">
                <div class="main__row">
                    <div class="main__title">Рецензии наших авторов:</div>
                    <div class="main__review">
                        <?php require_once "views/review_items_loader.php" ?>
                        <div class="main__load-more-wrapper">
                            <a class="main__load-more link" next-page-num="1" href="more_posts.php">Больше рецензий</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once "views/layouts/footer.php" ?>
        <?php require_once "views/layouts/popup.php" ?>
    </div>
    <script src="node_modules/just-validate/dist/js/just-validate.min.js"></script>
    <script src="views/js/load_more_posts.js"></script>
    <script src="views/js/modal_window.js"></script>
</body>

</html>