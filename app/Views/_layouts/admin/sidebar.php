<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Dashboard</div>
            <a class="nav-link" href="<?=route_to('Admin\Dashboard::index')?>">
                <div class="sb-nav-link-icon"><i class="ri-dashboard-line"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">API's</div>
            <a class="nav-link" href="<?=route_to('Admin\Contact::index')?>">
                <div class="sb-nav-link-icon"><i class="ri-briefcase-5-line"></i></div>
                Project
            </a>
            <a class="nav-link" href="<?=route_to('Admin\Contact::index')?>">
                <div class="sb-nav-link-icon"><i class="ri-contacts-book-2-line"></i></div>
                Contact
            </a>

            <div class="sb-sidenav-menu-heading">Account</div>
            <a class="nav-link collapsed" href="<?= route_to('Admin\UserManagement::index')?>" >
                <div class="sb-nav-link-icon"><i class="ri-account-box-line"></i></div>
                Account
            </a>
            <?php // if (in_groups('admin')) : ?>
            <div class="sb-sidenav-menu-heading">Admin</div>

            <a class="nav-link" href="<?=route_to('Admin\UserManagement::index')?>">
                <div class="sb-nav-link-icon"><i class="ri-user-3-line"></i></div>
                User Management
            </a>

            <a class="nav-link" href="<?= route_to('Admin\Dashboard::phpinfo') ?>">
                <div class="sb-nav-link-icon"><i class="ri-question-mark"></i></div>
                PHPInfo
            </a>

            <a class="nav-link" href="<?=route_to('Admin\Dashboard::settings')?>">
                <div class="sb-nav-link-icon"><i class="ri-settings-5-line"></i></div>
                Settings
            </a>
            <?php // endif; ?>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        <span class="fw-medium"><?= auth()->user()->username ?></span>
    </div>
</nav>
