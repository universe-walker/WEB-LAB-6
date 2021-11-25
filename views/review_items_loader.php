<?php
require_once "models/models.php";

$post_obj = new Post();
$posts = $post_obj->getActivePostsWithOffset(0);
?>

<?php while ($post = $posts->fetch(PDO::FETCH_ASSOC)): ?>
<?php require "review_item.php" ?>
<?php endwhile; ?>