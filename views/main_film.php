<?php
    require_once "models/models.php";

    $post_id = (int) $_GET['post-id'];
    $post_obj = new Post();
    $post = $post_obj->getPostById($post_id);
?>

<div class="main__film">
    <div class="film__about">
        <div class="film__left">
            <div class="film__poster-wrapper">
                <img src=<?= "/media/".$post['poster'] ?>
                alt="Постер" class="film__poster">
            </div>
        </div>
        <div class="film__right">
            <div class="film__title-wrapper">
                <div class="film__title title"><?= $post['title'] ?><span
                        class="film__year">(<?= $post['release_year'] ?>)</span>
                </div>
                <div class="film__title-original title"><?= $post['original_title'] ?>
                </div>
            </div>
            <div class="film__trailer">
                <?= $post['trailer_link'] ?>
            </div>
        </div>
    </div>
    <article class="film__review-wrapper">
        <div class="review__date"><span class="border"><?= $post['date'] ?></span></div>
        <p class="review__text">
            <?= $post['text_post'] ?>
        </p>
        <div class="review__rating-wrapper">
            Оценка:<span class="review__rating">
                <?php if ($post['rating']): ?>
                <?= $post['rating'] ?></span>/10
            <?php else: ?>
            не выставлена
            <?php endif; ?>
        </div>
        <div class="review__author-wrapper">
            <span class="border">Автор: <span class="review__author"><?= $post['name'] ?></span></span>
        </div>
    </article>
</div>