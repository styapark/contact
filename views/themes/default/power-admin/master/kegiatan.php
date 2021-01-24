<?php require_once str_replace($cname, '', __DIR__).'/path/head.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/navbar_top.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/sidebar_left.php'; ?>
<section class="content-body">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $power_admin('dashboard') ?>"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= $power_admin('master/program') ?>"><i class="zmdi zmdi-memory"></i> Master</a></li>
        <li class="breadcrumb-item"><a href="<?= $power_admin('master/program') ?>">Program</a></li>
        <li class="breadcrumb-item active"><?= strtoupper($p) ?></li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card card-body" id="<?= $p ?>">
                <div class="h6 font-bold">
                    <span>Master <?= strtoupper($p).' "'.substr(@$program[$q],9).'"' ?></span>
                </div>
                <hr class="my-1">
<?php if ( is_numeric($q) ) { ?>
                <form method="POST" id="add">
                    <div class="collapse">
                        <div class="form-group md" style="width: 50%">
                            <label>Nama Program</label>
                            <?= form_dropdown('id_program', $program, $q, 'class="form-control md disabled"') ?>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md" style="width: 50%">
                            <label>Kode <?= ucwords($p) ?></label>
                            <input type="text" name="code" class="form-control md" data-required data-number>
                            <i class="form-bar"></i>
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
                    <table class="table table-hover" id="datatables" name="<?= $p ?>" data-src="<?= MyLite_base.'services/'.$p.'/'.$q ?>">
                        <thead>
                            <tr>
                                <th data-field="#">#</th>
                                <th data-field="name">Nama</th>
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
                                    <label>Nama Program</label>
                                    <?= form_dropdown('id_program', $program, $q, 'class="form-control md disabled"') ?>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Kode <?= ucwords($p) ?></label>
                                    <input type="hidden" name="id" value="">
                                    <input type="text" name="code" class="form-control md" data-required data-number>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Nama <?= ucwords($p) ?></label>
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