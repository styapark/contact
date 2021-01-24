
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
                <a href="<?= power_admin('settings/profile') ?>" class="dropdown-item waves-effect">Profile</a>
                <a href="<?= power_admin('settings/change-password') ?>" class="dropdown-item waves-effect">Change Password</a>
                <?php if ($user_group->id >= 8 ) { ?>
                <a href="<?= power_admin('settings/general') ?>" class="dropdown-item waves-effect">Settings</a>
                <?php } ?>
                <a href="#" class="dropdown-item waves-effect" data-toggle="modal" data-target="#about">About</a>
                <a href="#" class="dropdown-item waves-effect" id="logout" data-redirect="<?= power_admin() ?>">Log Out</a>
                <div class="dropdown-item">Version: <b><?= get_git_version() ?></b></div>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link waves-effect" href="<?= power_admin('dashboard') ?>"><i class="zmdi zmdi-home"></i>Dashboard</a>
            </li>
            <?php if ($cname !== 'settings') { ?>
            <li class="nav-item side-dropdown" data-sub="master">
                <a class="nav-link waves-effect" href="#"><i class="zmdi zmdi-memory"></i>Master</a>
                <div class="dropdown-menu">
                    <a href="<?= power_admin('master/renstra') ?>" class="dropdown-item waves-effect">RENSTRA</a>
                    <a href="<?= power_admin('master/renja') ?>" class="dropdown-item waves-effect">RENJA</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect" href="<?= power_admin('chart') ?>"><i class="zmdi zmdi-trending-up"></i>Chart</a>
            </li>
            <?php } else { ?>
            <li class="nav-item side-dropdown" data-sub="settings">
                <a class="nav-link waves-effect" href="#"><i class="zmdi zmdi-settings"></i>Settings</a>
                <div class="dropdown-menu">
                    <a href="<?= power_admin('settings/general') ?>" class="dropdown-item waves-effect">General</a>
                    <a href="<?= power_admin('settings/accounts') ?>" class="dropdown-item waves-effect">Accounts</a>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</aside>
<!--/.Sidebar-->