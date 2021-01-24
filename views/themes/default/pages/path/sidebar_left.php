
<!--Sidebar-->
    <div class="modal" tabindex="-1" role="dialog" id="about">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">About</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="about" style="width: 100%; height: 400px"></iframe>
                </div>
            </div>
        </div>
    </div>
<aside class="sidebar collapse" id="sidebar">
    <div class="scrollbar">
        <div class="user dropdown">
            <div class="user-info" data-toggle="dropdown">
                <div class="user-images">
                    <img src="media/images/user1.png" class="img-responsive"/>
                </div>
                <div class="user-text">
                    <h6><?= $user_info->first_name.' '.$user_info->last_name ?></h6>
                    <span><?= $user_group->description ?></span>
                </div>
            </div>
            <div class="dropdown-menu">
                <?php if ($user_group->id >= 8 ) { ?>
                <a href="<?= $power_admin('settings/profile') ?>" class="dropdown-item waves-effect">Profile</a>
                <a href="<?= $power_admin('settings/general') ?>" class="dropdown-item waves-effect">Settings</a>
                <?php } ?>
                <a href="#" class="dropdown-item waves-effect" data-toggle="modal" data-target="#about">About</a>
                <a href="#" class="dropdown-item waves-effect" id="logout">Log Out</a>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link waves-effect" href="<?= $power_admin('dashboard') ?>"><i class="zmdi zmdi-home"></i>Dashboard</a>
            </li>
            <?php if ($cname !== 'settings') { ?>
            <li class="nav-item side-dropdown" data-sub="master">
                <a class="nav-link waves-effect" href="#"><i class="zmdi zmdi-memory"></i>Master</a>
                <div class="dropdown-menu">
                    <?php if ($user_group->id >= 8 ) { ?>
                    <a href="<?= $power_admin('master/rpjpd') ?>" class="dropdown-item waves-effect">RPJPD</a>
                    <a href="<?= $power_admin('master/rpjmd') ?>" class="dropdown-item waves-effect">RPJMD</a>
                    <a href="<?= $power_admin('master/rkpd') ?>" class="dropdown-item waves-effect">RKPD</a>
                    <?php } ?>
                    <a href="<?= $power_admin('master/renstra') ?>" class="dropdown-item waves-effect">RENSTRA</a>
                    <a href="<?= $power_admin('master/renja') ?>" class="dropdown-item waves-effect">RENJA</a>
                    <?php if ($user_group->id >= 8 ) { ?>
                    <a href="<?= $power_admin('master/urusan') ?>" class="dropdown-item waves-effect">URUSAN</a>
                    <a href="<?= $power_admin('master/program') ?>" class="dropdown-item waves-effect">PROGRAM</a>
                    <a href="<?= $power_admin('master/opd') ?>" class="dropdown-item waves-effect">OPD</a>
                    <!--a href="<?= $power_admin('master/skpd') ?>" class="dropdown-item waves-effect">SKPD</a-->
                    <a href="<?= $power_admin('master/dpa') ?>" class="dropdown-item waves-effect">DPA</a>
                    <a href="<?= $power_admin('master/sumber-dana') ?>" class="dropdown-item waves-effect">SUMBER DANA</a>
                    <?php } ?>
                </div>
            </li>
            <li class="nav-item side-dropdown" data-sub="monitoring">
                <a class="nav-link waves-effect" href="#"><i class="zmdi zmdi-desktop-mac"></i>Monitoring</a>
                <div class="dropdown-menu">
                    <?php if ($user_group->id >= 8 ) { ?>
                    <a href="<?= $power_admin('monitoring/rencana') ?>" class="dropdown-item waves-effect">RENCANA</a>
                    <a href="<?= $power_admin('monitoring/realisasi') ?>" class="dropdown-item waves-effect">REALISASI</a>
                    <!--<a href="<?= $power_admin('monitoring/pemantauan') ?>" class="dropdown-item waves-effect">PEMANTAUAN</a>-->
                    <a href="<?= $power_admin('monitoring/monitoring_realisasi') ?>" class="dropdown-item waves-effect">MONITORING REALISASI</a>
                    <?php } else { ?>
                    <a href="<?= $power_admin('monitoring/kinerja') ?>" class="dropdown-item waves-effect">KINERJA TRIWULAN</a>
                    <?php } ?>
                </div>
            </li>
            <?php if ($user_group->id >= 8 ) { ?>
            <li class="nav-item side-dropdown" data-sub="report">
                <a class="nav-link waves-effect" href="#"><i class="zmdi zmdi-cast"></i>Report</a>
                <div class="dropdown-menu">
                    <!--<a href="<?= $power_admin('report/monitoring') ?>" class="dropdown-item waves-effect">MONITORING</a>-->
                    <a href="<?= $power_admin('report/evaluasi') ?>" class="dropdown-item waves-effect">EVALUASI</a>
                    <a href="<?= $power_admin('report/save') ?>" class="dropdown-item waves-effect">REPOT TERSIMPAN</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect" href="<?= $power_admin('chart') ?>"><i class="zmdi zmdi-trending-up"></i>Chart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect" href="<?= $power_admin('import') ?>"><i class="zmdi zmdi-cloud-upload"></i>Import</a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect" href="<?= $power_admin('sync') ?>"><i class="zmdi zmdi-refresh-sync"></i>Syncronize</a>
            </li>
            <?php } else { ?>
            <li class="nav-item">
                <a class="nav-link waves-effect" href="<?= $power_admin('export/report/e60') ?>"><i class="zmdi zmdi-cloud-download"></i>Export</a>
            </li>
            <?php } ?>
            <?php } else { ?>
            <li class="nav-item side-dropdown" data-sub="settings">
                <a class="nav-link waves-effect" href="#"><i class="zmdi zmdi-settings"></i>Settings</a>
                <div class="dropdown-menu">
                    <a href="<?= $power_admin('settings/general') ?>" class="dropdown-item waves-effect">General</a>
                    <a href="<?= $power_admin('settings/accounts') ?>" class="dropdown-item waves-effect">Accounts</a>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</aside>
<!--/.Sidebar-->