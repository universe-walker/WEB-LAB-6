<nav class="nav">
  <div class="nav__row">
    <div class="nav__left">
      <div class="nav__logo">
        <img class="logo" src="/img/logo.png" alt="Лого">
      </div>
      <div class="nav__name nav_item">
        <a class="nav_link link" href="/">КиноТекст</a>
      </div>
    </div>
    <div class="nav__right">
      <?php if ($params['user']): ?>
      <div class="nav__hello nav_item">Привет,&#32;<span class="nav__username"><?= $params['user']['name'] ?></span>
      </div>
      <div class="nav__logout nav_item">
        <a href=<?= "/log-out/?next=" . $_SERVER['REQUEST_URI'] ?>
          class="nav__logout nav_link link">Выйти</a>
      </div>
      <?php else: ?>
      <div class="nav__login nav_item">
        <a href="#" id="login_link" class="nav_link link">Войти/Регистрация</a>
      </div>
      <?php endif; ?>
    </div>
  </div>
</nav>