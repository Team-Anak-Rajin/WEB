<div class="left main-sidebar">

    <div class="sidebar-inner leftscroll">

        <div id="sidebar-menu">

            <ul>

                <li class="submenu">
                    <a <?= url_is('app') || url_is('') ? 'class="active"' : '' ?> href="<?= site_url('app') ?>"><i class="fa fa-fw fa-bars"></i><span> Home </span> </a>
                </li>

                <li class="submenu">
                    <a <?= url_is('app/store') ? 'class="active"' : '' ?> href="<?= site_url('app/store') ?>"><i class="fa fa-fw fa-map-o"></i><span> Store </span> </a>
                </li>

                <li class="submenu">
                    <a <?= url_is('app/scanmaster/*') ? 'class="active"' : '' ?> href="#"><i class="fa fa-fw fa-camera"></i> <span> ScanMaster </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li <?= url_is('app/scanmaster/egg') ? 'class="active"' : '' ?>><a href="<?= site_url('app/scanmaster/egg') ?>">Egg</a></li>
                        <li <?= url_is('app/scanmaster/coin') ? 'class="active"' : '' ?>><a href="<?= site_url('app/scanmaster/coin') ?>">Coin</a></li>
                        <li <?= url_is('app/scanmaster/can') ? 'class="active"' : '' ?>><a href="<?= site_url('app/scanmaster/can') ?>">Can</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a <?= url_is('app/history/*') ? 'class="active"' : '' ?> href="#"><i class="fa fa-fw fa-history"></i> <span> History </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li <?= url_is('app/history/egg') ? 'class="active"' : '' ?>><a href="<?= site_url('app/history/egg') ?>">Egg</a></li>
                        <li <?= url_is('app/history/coin') ? 'class="active"' : '' ?>><a href="<?= site_url('app/history/coin') ?>">Coin</a></li>
                        <li <?= url_is('app/history/can') ? 'class="active"' : '' ?>><a href="<?= site_url('app/history/can') ?>">Can</a></li>
                    </ul>
                </li>

            </ul>

            <div class="clearfix"></div>

        </div>

        <div class="clearfix"></div>

    </div>

</div>