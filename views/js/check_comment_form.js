/* работа с формой комментария */
   
new window.JustValidate('.comment__comment-form', {
    rules: {
        comment: {
          required: true,
          minLength: 1,
          maxLength: 5000
       }
    },
    messages: {
       comment: {
          required: 'Это поле обязательно',
          maxLength: 'Поле должно содержать максимум :value символов',
          minLength: 'Поле должно содержать минимум :value символов',
       }
    },
    submitHandler: function (form, values) {
        console.log(values);
        fetch(`/create_comment.php`, {
            method: 'POST',
            body: new FormData(form)
        })
        .then(response => response.json())
        .then((result) => {
          if (result.errors) {
             showErrors('.comment-form__submit', result.errors);
          } else {
              comment = result.comment;
             showComment(form, comment.user, comment.date_time, comment.avatar);
          }
        })
        .catch(error => console.log(error));
    }
 });


 function showComment(form, user, date_time, avatar)
 {
    let textarea = form.elements.text;
    let commentText = textarea.value;
    let commentAuthor = user;
    textarea.value = '';

    let comment = document.createElement('div');
    comment.className = 'comment__item';
    comment.innerHTML = `
       <div class="comment__header">
          <div class="comment_avatar-wrapper">
             <img src=${avatar} alt="" class="comment__avatar">
          </div>
          <div class="comment__author">${commentAuthor}</div>
       </div>
       <div class="comment__text">${commentText}</div>
       <div class="comment__datetime">${date_time}</div>
    </div>
    `
    let mainComment = document.querySelector('.main__comment');
    mainComment.append(comment);
 }