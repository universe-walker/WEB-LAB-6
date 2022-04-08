<div class="comment__item">
  <div class="comment__header">
    <div class="comment__avatar-wrapper">
      <img src="картинка заглушка" alt="" class="comment__avatar">
    </div>
    <div class="comment__author"><?= $comment['name'] ?></div>
  </div>
  <div class="comment__text"><?= $comment['text'] ?>
  </div>
  <div class="comment__datetime"><?= $comment['date_time'] ?>
  </div>
</div>