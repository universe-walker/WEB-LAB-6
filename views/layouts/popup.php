<div class="modal__wrapper hidden">
  <div class="modal">
    <div class="modal__cancel-wrapper">
      <button type="button" name="button" class="modal__cancel">&#10006;</button>
    </div>
    <div class="modal__tabs">
      <nav class="tabs__items">
        <a href="#tab_01" class="tabs__item"><span>Регистрация</span></a>
        <a href="#tab_02" class="tabs__item"><span>Войти</span></a>
      </nav>
      <div class="tabs__body">
        <div class="tabs__sign-up_wrapper tabs_block" id="tab_01">
          <form action="#" class="modal__sign-up modal_form">
            <label for="name">Имя</label>
            <input type="text" name="name" data-validate-field="name" placeholder="Имя">
            <label for="email">Email</label>
            <input type="text" name="email" data-validate-field="email" placeholder="Email">
            <label for="phone">Телефон</label>
            <input type="text" name="phone" data-validate-field="phone" placeholder="Телефон">
            <label for="password">Пароль</label>
            <input type="password" name="password" data-validate-field="password" placeholder="Пароль">
            <label for="password_repeat">Повторите пароль</label>
            <input type="password" name="password_repeat" data-validate-field="password_repeat"
              placeholder="Повторите пароль">
            <label for="personal_data"><input type="checkbox" name="personal_data" data-validate-field="personal_data"
                class="sign-up__personal-data">Согласие на обработку персональных данных</label>
            <button type="submit" name="login" class="sign-up__btn modal_btn">Зарегистрироваться</button>
          </form>
        </div>
        <div class="tabs__log-in_wrapper tabs_block" id="tab_02">
          <form action="#" class="modal__log-in modal_form">
            <label for="name">Email</label>
            <input type="text" name="email" data-validate-field="email" placeholder="Email">
            <label for="password">Пароль</label>
            <input type="password" name="password" data-validate-field="password" placeholder="Пароль">
            <button type="submit" name="log-in" class="log-in__btn modal_btn">Войти</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>