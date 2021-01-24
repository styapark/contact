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
                        <div class="form-group md" style="width: 40%">
                            <label>Nama Urusan</label>
                            <?= form_dropdown('type', $urusan, NULL, 'class="form-control md"') ?>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md" style="width: 50%">
                            <label>Kode <?= ucwords($p) ?></label>
                            <input type="text" name="code" class="form-control md" data-required data-number>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md">
                            <label>Kustomisasi <?= ucwords($p) ?></label>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" name="custom" class="custom-control-input" value="0" id="custom-0" checked>
                                <label class="custom-control-label" for="custom-0">Disable</label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" name="custom" class="custom-control-input" value="1" id="custom-1">
                                <label class="custom-control-label" for="custom-1">Enable</label>
                            </div>
                        </div>
                        <div class="form-group md">
                            <label>Nama <?= ucwords($p) ?></label>
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
                                <th data-field="name">Nama</th>
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
                                    <label>Nama Bidang / Urusan</label>
                                    <?= form_dropdown('type', $urusan, NULL, 'class="form-control md"') ?>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Kode Bidang</label>
                                    <input type="hidden" name="id" value="">
                                    <input type="text" name="code" class="form-control md" value="" data-number data-required>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Kustomisasi <?= ucwords($p) ?></label>
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" name="custom" class="custom-control-input" value="0" id="custom-edit-0">
                                        <label class="custom-control-label" for="custom-edit-0">Disable</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" name="custom" class="custom-control-input" value="1" id="custom-edit-1">
                                        <label class="custom-control-label" for="custom-edit-1">Enable</label>
                                    </div>
                                </div>
                                <div class="form-group md">
                                    <label>Nama Bidang</label>
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
<?php } ?>
            </div>
        </div>
    </div>
</section>
<?php require_once str_replace($cname, '', __DIR__).'path/foot.php'; ?>