<nav class="navbar navbar-expand-lg bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= url('/') ?>"><?= APP_NAME ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
      <?php if(auth()->check()):?>
        <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link " href="<?= url('/home') ?>">Home</a>
          </li>
        </ul>
        <?php endif?>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if (auth()->check()) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= auth()->user()->name ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="<?= url('/profile') ?>">Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form action="<?= url('/logout') ?>" method="post">
                  <button class="dropdown-item" type="submit">Logout</button>
                </form>
              </li>
            </ul>
          </li>


        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link " href="<?= url('/login') ?>">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= url('/register') ?>">Register</a>
          </li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>