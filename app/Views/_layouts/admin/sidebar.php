<nav class="sb-sidenav accordion sb-sidenav-light bg-white" id="sidenavAccordion">
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
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutss"
                aria-expanded="false" aria-controls="collapseLayoutss">
                <div class="sb-nav-link-icon"><i class="ri-account-box-line"></i></div>
                Account
                <div class="sb-sidenav-collapse-arrow"><i class="ri-arrow-down-s-line"></i></div>
            </a>
            <div class="collapse" id="collapseLayoutss" aria-labelledby="headingOne">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="<?= route_to('Admin\AccountManagement::index') ?>">Profile</a>
                    <a class="nav-link" href="<?= route_to('Admin\AccountManagement::security') ?>">Security</a>
                </nav>
            </div>
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
        <span class="fw-medium"><?= '' //user()->fullname?></span>
    </div>
</nav>
