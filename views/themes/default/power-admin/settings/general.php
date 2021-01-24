<?php require_once str_replace($cname, '', __DIR__).'/path/head.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/navbar_top.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/sidebar_left.php'; ?>
<section class="content-body">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= power_admin('dashboard') ?>"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><i class="zmdi zmdi-settings"></i> Settings</li>
        <li class="breadcrumb-item active"><?= ucfirst($__FUNCTION__) ?></li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card card-body" id="<?= $cname.'-'.$__FUNCTION__ ?>">
                <div class="h6 font-bold">
                    <span><?= ucfirst($__FUNCTION__) ?></span>
                </div>
                <hr class="my-1">
                <form method="POST" id="update" class="row" novalidate>
                    <div class="col-md-5">
                        <div class="form-group md">
                            <label>Application Name</label>
                            <input type="text" name="system_name" class="form-control md" value="<?= $system_name ?>" data-required>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md">
                            <label>Application Email</label>
                            <input type="text" name="system_mail" class="form-control md" value="<?= $system_mail ?>" data-required>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md">
                            <label>Company</label>
                            <input type="text" name="system_company" class="form-control md" value="<?= $system_company ?>">
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md">
                            <label>City</label>
                            <?= form_dropdown('system_city', $dropdown_city, $system_city, 'class="form-control md" data-required') ?>
                            <i class="form-bar"></i>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col-md-5">
                        <div class="form-group md">
                            <label>General Name</label>
                            <input type="text" name="system_title" class="form-control md" value="<?= $system_title ?>" data-required>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md">
                            <label>Application Logo</label>
                            <div class="clear-fix"></div>
                            <label class="btn btn-warning btn-sm">
                                <i class="fa fa-file-picture-o"></i>
                                <input type="file" name="system_photo" hidden>
                                &nbsp;
                                <span data-title="No file chosen">No file chosen</span>
                            </label>
                        </div>
                        <div class="form-group md">
                            <label>Key Activation</label>
                            <input type="text" name="system_activation" class="form-control md" value="<?= $system_activation ?>" data-required>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md">
                            <label>Login Identify</label>
                            <?= form_dropdown('system_login_identity', $login_identity, @$system_login_identity, 'class="form-control md"') ?>
                            <i class="form-bar"></i>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col-md-12">
                    <div class="form-group">
                        <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                        <button type="submit" class="btn btn-primary btn-sm m-0 float-right"><i class="zmdi zmdi-mail-send"></i> Update</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once str_replace($cname, '', __DIR__).'path/foot.php'; ?>