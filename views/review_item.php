<?php
require_once "views/utils.php";
$detail_link = '/detail.php/?post-id='.$post['post_id'];
?>

<div class="review__item">
    <div class="review__film-title">
        <a href="<?= $detail_link ?>"
            class="review__link link"><?= $post['title'] ?>
            (<span class="review__film-original-title"><?= $post['original_title'] ?></span>)
        </a>
    </div>
    <div class="review__poster-wrapper"><img src="
            <?= $post['poster'] ?>" alt="Постер"
            class="review__poster"></div>
    <div class="review__text">
        <?= get_short_string($post['text_post']) ?>
        <span class="review__read-more"><a href="<?= $detail_link ?>"
                class="review__link link link_underline">Читать далее</a></span>
    </div>
    <div class="review__info">
        <div class="review__author"><?= $post['name'] ?>
        </div>
        <div class="review__date"><?= $post['date'] ?>
        </div>
    </div>
</div>