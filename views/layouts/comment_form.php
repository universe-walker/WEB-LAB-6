<div class="comment__comment-form-wrapper">
    <form action="#" method="GET" class="comment__comment-form">
        <label for="comment">Введите ваш комментарий:</label>
        <textarea name="textarea" class="comment-form__input" data-validate-field="comment" id="comment" cols="50"
            rows="10"></textarea>
        <button class="comment-form__submit" name="submit" value=<?= $_GET['post-id'] ?>>Отправить</button>
    </form>
</div>