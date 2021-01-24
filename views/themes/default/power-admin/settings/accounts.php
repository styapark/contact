<?php require_once str_replace($cname, '', __DIR__).'/path/head.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'/path/navbar_top.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'/path/sidebar_left.php'; ?>
<section class="content-body">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= power_admin('dashboard') ?>"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= power_admin('settings') ?>"><i class="zmdi zmdi-settings"></i> Settings</a></li>
        <li class="breadcrumb-item active"><?= ucfirst($__FUNCTION__) ?></li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card card-body" id="<?= $__FUNCTION__ ?>">
                <div class="h6 font-bold">
                    <span><?= ucfirst($__FUNCTION__) ?></span>
                </div>
                <hr class="my-1">
                <form method="POST" id="add" novalidate>
                    <div class="collapse">
                        <div class="form-group md" style="width: 60%">
                            <label>Nama Lengkap</label>
                            <div class="input-group">
                                <input type="text" name="first_name" class="form-control md" placeholder="Nama Depan" data-required>
                                <input type="text" name="last_name" class="form-control md" placeholder="Nama Belakang" data-required>
                                <i class="form-bar"></i>
                            </div>
                        </div>
                        <div class="form-group md" style="width: 40%">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control md" minlength="6" autocomplete="off" data-required>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md" style="width: 40%">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control md" minlength="8" autocomplete="off" data-required>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md" style="width: 40%">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control md" autocomplete="off" data-required>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md" style="width: 40%">
                            <label>Nama Grup</label>
                            <?= form_dropdown('group', $groups, NULL, 'class="form-control md" data-required') ?>
                            <i class="form-bar"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                        <button type="button" class="btn btn-primary btn-sm m-0 float-right"><i class="zmdi zmdi-mail-send"></i> Add</button>
                    </div>
                </form>
                <hr class="my-3">
                <div class="row">
                    <div class="table-responsive">
                    <table class="table table-hover table-server-side" name="<?= $cname.'/'.$__FUNCTION__ ?>" data-src="<?= MyLite_base.'services/v1/'.$cname.'/'.$__FUNCTION__.'/get' ?>">
                        <thead>
                            <tr>
                                <th data-field="username">Username</th>
                                <th data-field="full_name">Nama Lengkap</th>
                                <th data-field="group_text">Groups</th>
                                <th data-field="last_login_text">Last Login</th>
                                <th data-field="status_text">Status</th>
                                <th data-field="__callback" data-callback="actionPowerEditDelete">Action</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
                <form class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true" novalidate>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit <?= ucwords($__FUNCTION__) ?></h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group md">
                                    <label>Nama Lengkap</label>
                                    <div class="input-group">
                                        <input type="text" name="first_name" class="form-control md" placeholder="Nama Depan" data-required>
                                        <input type="hidden" name="id" data-required>
                                        <input type="text" name="last_name" class="form-control md" placeholder="Nama Belakang" data-required>
                                        <i class="form-bar"></i>
                                    </div>
                                </div>
                                <div class="form-group md">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control md" minlength="6" autocomplete="off" readonly>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control md" minlength="8" autocomplete="off">
                                    <i class="form-bar"></i>
                                    <i>Abaikan kolom password jika tidak ingin merubah password</i>
                                </div>
                                <div class="form-group md">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control md" autocomplete="off" data-required>
                                    <i class="form-bar"></i>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="zmdi zmdi-cloud-upload"></i> Simpan</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal"><i class="zmdi zmdi-undo"></i> Kembali</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once str_replace($cname, '', __DIR__).'/path/foot.php'; ?>