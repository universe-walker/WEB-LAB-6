<?php
    require_once "models/models.php";

    if (!array_key_exists('page', $_GET)) {
        return;
    }
    $page_num = (int)$_GET['page'];

    $posts_per_page = parse_ini_file('config/site.ini')['posts_per_page'];
    if (!$posts_per_page) {
        $posts_per_page = 2;
    }

    $offset = $page_num * $posts_per_page;

    $post_obj = new Post();
    $posts = $post_obj->getActivePostsWithOffset($offset);
?>
<?php foreach ($posts as $post): ?>
<?php require "views/review_item.php"; ?>
<?php endforeach;
