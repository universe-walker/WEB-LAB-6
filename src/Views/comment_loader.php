<?php
$comments = $params['comments'];
?>

<?php if ($comments->rowCount() < 1): ?>
<h4 class="comment__empty">Комментариев пока нет</h4>
<?php endif; ?>

<?php while ($comment = $comments->fetch(PDO::FETCH_ASSOC)): ?>
<?php require "main_comment.php" ?>
<?php endwhile;
