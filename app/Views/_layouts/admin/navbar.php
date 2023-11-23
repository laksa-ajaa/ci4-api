<nav id="mainNavbar" class="navbar navbar-expand shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-ghost btn-circle me-2" id="sidebarToggle" href="#"><i class="ri-menu-fill"></i></button>
        <a class="navbar-brand text-truncate" href="<?=base_url()?>">RND API</a>
        <ul class="navbar-nav ms-auto">
            <li id="profileInfo" class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="rounded-circle" src="<?= base_url("assets/img/avatar.webp") ?>" height="32" width="32" alt="Rendio Simamora"/>
                </a>
                <ul class="dropdown-menu shadow-sm dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <h6 class="dropdown-header d-flex align-items-center gap-2">
                        <img class="dropdown-user-picture rounded-circle" height="40" width="40" src="<?=base_url("assets/img/avatar.webp") ?>"/>
                        <div class="dropdown-user-profile">
                            <div class="text-dark text-truncate"><?= ''// user()->fullname ?></div>
                            <div class="small text-truncate"><?=''// user()->email ?></div>
                        </div>
                    </h6>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item has-icon" href="<?=route_to('Admin\AccountManagement::index')?>"><i class="ri-settings-3-line"></i>Account</a></li>
                    <li><a class="dropdown-item has-icon text-danger" href="<?=base_url('logout')?>"><i class="ri-logout-box-r-line"></i>Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>