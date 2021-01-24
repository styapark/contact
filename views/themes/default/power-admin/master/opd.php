<?php require_once str_replace($cname, '', __DIR__).'/path/head.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/navbar_top.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/sidebar_left.php'; ?>
<section class="content-body">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $power_admin('dashboard') ?>"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><i class="zmdi zmdi-memory"></i> Master</li>
        <li class="breadcrumb-item active"><?= strtoupper($p) ?></li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card card-body" id="<?= $p ?>">
                <div class="h6 font-bold">
                    <span>Master <?= strtoupper($p) ?></span>
                </div>
                <hr class="my-1">
<?php if ($q == NULL) { ?>
                <form method="POST" id="add">
                    <div class="collapse">
                        <div class="form-group md" style="width: 50%">
                            <label>Kode <?= strtoupper($p) ?></label>
                            <input type="text" name="code" class="form-control md" data-required maxlength="12">
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md">
                            <label>Nama <?= strtoupper($p) ?></label>
                            <textarea name="name" class="form-control md" data-required></textarea>
                            <i class="form-bar"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                        <button type="button" class="btn btn-primary btn-sm m-0 float-right"><i class="zmdi zmdi-mail-send"></i> Tambah</button>
                    </div>
                </form>
                <hr class="my-3">
                <div class="row">
                    <div class="table-responsive">
                    <table class="table table-hover" id="datatables" name="<?= $p ?>" data-src="<?= MyLite_base.'services/'.$p ?>">
                        <thead>
                            <tr>
                                <th data-field="#">#</th>
                                <th data-field="name_text">Nama</th>
                                <th data-field="name_user">Oleh</th>
                                <th data-field="__callback" data-callback="actionEditDelete">Action</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
                <form class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit <?= ucwords($q) ?></h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group md">
                                    <label>Kode <?= strtoupper($p) ?></label>
                                    <input type="hidden" name="id" value="">
                                    <input type="text" name="code" class="form-control md" data-required maxlength="12">
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Nama <?= strtoupper($p) ?></label>
                                    <textarea name="name" class="form-control md" data-required></textarea>
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
                <form class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Buat Akun <?= ucwords($q) ?></h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group md">
                                    <label>Username</label>
                                    <input type="hidden" name="id" value="">
                                    <input type="text" name="username" class="form-control md" data-required maxlength="20" readonly>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group">
                                    <i>Pertama kali Password dibuat sama dengan username, sehingga segera ganti Password SKPD setelah dibuat.</i>
                                </div>
                                <div class="form-group md">
                                    <label>Email Utama <?= ucwords($q) ?></label>
                                    <input type="text" name="email" class="form-control md" data-required maxlength="20">
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Nama Awal <?= ucwords($q) ?></label>
                                    <input type="text" name="name[first]" class="form-control md" data-required maxlength="20">
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Nama Akhir <?= ucwords($q) ?></label>
                                    <input type="text" name="name[last]" class="form-control md" data-required maxlength="30">
                                    <i class="form-bar"></i>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                                <button type="submit" class="btn btn-sm btn-green"><i class="zmdi zmdi-account-add"></i> Buat</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal"><i class="zmdi zmdi-undo"></i> Kembali</button>
                            </div>
                        </div>
                    </div>
                </form>
<?php } ?>
            </div>
        </div>
    </div>
</section>
<?php require_once str_replace($cname, '', __DIR__).'path/foot.php'; ?>