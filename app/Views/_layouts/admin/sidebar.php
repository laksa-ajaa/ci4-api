<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
  <div class="sb-sidenav-menu">
    <div class="nav">
      <div class="sb-sidenav-menu-heading">Dashboard</div>
      <a class="nav-link <?= url_is('dashboard') ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">
        <div class="sb-nav-link-icon"><i class="ri-dashboard-line"></i></div>
        Dashboard
      </a>
      <div class="sb-sidenav-menu-heading">API's</div>
      <a class="nav-link <?= url_is('dashboard/contact*') ? 'active' : '' ?>" href="<?= base_url('dashboard/contact') ?>">
        <div class="sb-nav-link-icon"><i class="ri-contacts-book-2-line"></i></div>
        Contact
      </a>
      <a class="nav-link collapsed <?= url_is('dashboard/project*') ? 'active' : '' ?>" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#collapseProject">
        <div class="sb-nav-link-icon"><i class="ri-briefcase-5-line"></i></div>
        Project
      </a>
      <div class="collapse" id="collapseProject">
        <div class="sb-sidenav-menu-nested">
          <a class="nav-link <?= url_is('dashboard/project') ? 'active' : '' ?>" href="<?= base_url('dashboard/project') ?>" style="font-size: .9rem">
            <div class="sb-nav-link-icon"><i class="ri-list-check-2"></i></div>
            Project List
          </a>
          <a class="nav-link <?= url_is('dashboard/project/category*') ? 'active' : '' ?>" href="<?= base_url('dashboard/project/category') ?>" style="font-size: .9rem">
            <div class="sb-nav-link-icon"><i class="ri-stack-line"></i></div>
            Project Category
          </a>
          <a class="nav-link <?= url_is('dashboard/project/techstack*') ? 'active' : '' ?>" href="<?= base_url('dashboard/project/techstack') ?>" style="font-size: .9rem">
            <div class="sb-nav-link-icon"><i class="ri-archive-stack-line"></i></div>
            Project Techstack
          </a>
        </div>
      </div>

      <div class="sb-sidenav-menu-heading">Account</div>
      <a class="nav-link <?= url_is('dashboard/account*') ? 'active' : '' ?>" href="<?= base_url('dashboard/account') ?>">
        <div class="sb-nav-link-icon"><i class="ri-account-box-line"></i></div>
        Account
      </a>

      <div class="sb-sidenav-menu-heading">Admin</div>
      <a class="nav-link d-none <?= url_is('dashboard/userman*') ? 'active' : '' ?>" href="<?= base_url('dashboard/userman') ?>">
        <div class="sb-nav-link-icon"><i class="ri-user-3-line"></i></div>
        User Management
      </a>

      <a class="nav-link <?= url_is('dashboard/phpinfo*') ? 'active' : '' ?>" href="<?= base_url('dashboard/phpinfo') ?>">
        <div class="sb-nav-link-icon"><i class="ri-question-mark"></i></div>
        PHPInfo
      </a>

      <a class="nav-link d-none <?= url_is('dashboard/settings*') ? 'active' : '' ?>" href="<?= base_url('dashboard/settings') ?>">
        <div class="sb-nav-link-icon"><i class="ri-settings-5-line"></i></div>
        Settings
      </a>
    </div>
  </div>
  <div class="sb-sidenav-footer">
    <div class="small">Logged in as:</div>
    <span class="fw-medium"><?= auth()->user()->name ?></span>
  </div>
</nav>