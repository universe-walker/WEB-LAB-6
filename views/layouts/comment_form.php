<div class="comment__comment-form-wrapper">
    <form action="#" method="POST" class="comment__comment-form">
        <label for="comment">Введите ваш комментарий:</label>
        <textarea name="text" class="comment-form__input" data-validate-field="comment" id="comment" cols="50"
            rows="10"></textarea>
        <input type="hidden" name="post_id" value=<?= $_GET['post-id'] ?>>
        <button class="comment-form__submit" name="submit">Отправить</button>
    </form>
</div>