<div class="headerbar">

    <!-- LOGO -->
    <div class="headerbar-left">
        <a href="<?= site_url() ?>" class="logo"><img alt="logo" src="<?= base_url('icon.svg') ?>" class="pb-1" /> <span>ScanMaster</span></a>
    </div>

    <nav class="navbar-custom">

        <ul class="list-inline float-right mb-0">

            <li class="list-inline-item dropdown notif">
                <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="<?= base_url('assets/panel/images/avatars/admin.png') ?>" alt="Profile image" class="avatar-rounded">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown">

                    <div class="dropdown-item noti-title">
                        <?php if ($user !== null && isset($user['name'])) : ?>
                            <h5 class="text-overflow"><small>Hello, <?= $user['name'] ?></small> </h5>
                        <?php else : ?>
                            <h5 class="text-overflow"><small>Hello, Guest</small></h5>
                        <?php endif; ?>
                    </div>

                    <!-- item-->
                    <a href="<?= site_url('app/profile') ?>" class="dropdown-item notify-item">
                        <i class="fa fa-user"></i> <span>Profile</span>
                    </a>
                    <!-- item-->
                    <a href="<?= base_url('AuthController/logoutUser') ?>" class="dropdown-item notify-item">
                        <i class="fa fa-power-off"></i> <span>Logout</span>
                    </a>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </li>
        </ul>

    </nav>

</div>