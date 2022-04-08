<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>КинтоТекст | Главная</title>
    <link rel="stylesheet" href="css/reset.css" type="text/css">
    <link rel="stylesheet" href="css/base_style.css" type="text/css">
    <link rel="stylesheet" href="css/index_style.css" type="text/css">
    <link rel="stylesheet" href="css/modal.css">
</head>

<body>
    <div class="wrapper">
        <?php require_once "layouts/header.php"; ?>
        <div class="main">
            <div class="container">
                <div class="main__row">
                    <div class="main__title">Рецензии наших авторов:</div>
                    <div class="main__review">
                        <?php require_once "review_items_loader.php" ?>
                        <div class="main__load-more-wrapper">
                            <a class="main__load-more link" next-page-num="1" href="more_posts">Больше рецензий</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once __DIR__ . "/layouts/footer.php"?>
        <?php require_once __DIR__ . "/layouts/popup.php"?>
    </div>
    <script src="node_modules/just-validate/dist/js/just-validate.min.js"></script>
    <script src="/js/load_more_posts.js"></script>
    <script src="/js/modal_window.js"></script>
</body>

</html>