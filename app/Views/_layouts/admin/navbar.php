<nav id="mainNavbar" class="sb-topnav navbar navbar-expand">
  <div class="container-fluid">
    <button class="btn btn-ghost btn-circle me-2" id="sidebarToggle" href="#"><i class="ri-menu-fill"></i></button>
    <a class="navbar-brand d-flex gap-2 align-items-center fw-semibold" href="<?= base_url() ?>">
      <img class="rounded-circle" src="<?= base_url('assets/img/logo.webp') ?>" alt="Logo" width="40" height="40">
      <span style="line-height: 1.17rem;">
        <?= setting('App.sitename') ?><br>
        <span class="fw-normal small">Just for fun</span>
      </span>
    </a>
    <ul class="navbar-nav ms-auto">
      <li id="profileInfo" class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="rounded-circle" src="<?= "https://gravatar.com/avatar/" . md5(strtolower(auth()->user()->email)) . "?s=100&d=mp" ?>" height="32" width="32" alt="Rendio Simamora" />
        </a>
        <ul class="dropdown-menu shadow-sm dropdown-menu-end" aria-labelledby="navbarDropdown">
          <h6 class="dropdown-header d-flex align-items-center gap-2">
            <img class="dropdown-user-picture rounded-circle" height="40" width="40" src="<?= "https://gravatar.com/avatar/" . md5(strtolower(auth()->user()->email)) . "?s=100&d=mp" ?>" />
            <div class="dropdown-user-profile">
              <div class="text-dark text-truncate"><?= auth()->user()->name ?></div>
              <div class="small text-truncate"><?= auth()->user()->email ?></div>
            </div>
          </h6>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item has-icon" href="<?= base_url('dashboard/account') ?>"><i class="ri-settings-3-line"></i>Account</a></li>
          <li><a class="dropdown-item has-icon text-danger" href="<?= base_url('logout') ?>"><i class="ri-logout-box-r-line"></i>Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>