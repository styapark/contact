<?php require_once str_replace($cname, '', __DIR__).'/path/head.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/navbar_top.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/sidebar_left.php'; ?>
<section class="content-body">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= power_admin('dashboard') ?>"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><i class="zmdi zmdi-settings"></i> Settings</li>
        <li class="breadcrumb-item active"><?= ucfirst( str_replace('_', ' ', $__FUNCTION__) ) ?></li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card card-body" id="<?= $__FUNCTION__ ?>">
                <div class="h6 font-bold">
                    <span><?= ucwords( str_replace('_', ' ', $__FUNCTION__) ) ?></span>
                </div>
                <hr class="my-1">
                <form method="POST" id="update" novalidate>
                    <div class="col-md-12">
                        <div class="form-group md" style="width: 40%">
                            <label>Password Lama</label>
                            <div class="input-group">
                                <input type="text" name="old_password" class="form-control md" minlength="8">
                                <i class="form-bar"></i>
                            </div>
                        </div>
                        <div class="form-group md" style="width: 40%">
                            <label>Ubah Password</label>
                            <div class="input-group">
                                <input type="text" name="password" class="form-control md" minlength="8">
                                <i class="form-bar"></i>
                            </div>
                        </div>
                        <div class="form-group md" style="width: 40%">
                            <label>Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control md" minlength="8">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                        <button type="submit" class="btn btn-primary btn-sm m-0 float-right"><i class="zmdi zmdi-mail-send"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once str_replace($cname, '', __DIR__).'path/foot.php'; ?>