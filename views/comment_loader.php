<?php
$post_id = (int) $_GET['post-id'];
$comment_obj = new Comment();
$comment_obj->setPostId($post_id);
$comments = $comment_obj->getAllActiveComments();
?>

<?php if ($comments->rowCount() < 1): ?>
<h4 class="comment__empty">Комментариев пока нет</h4>
<?php endif; ?>

<?php while ($comment = $comments->fetch(PDO::FETCH_ASSOC)): ?>
<?php require "main_comment.php" ?>
<?php endwhile;
