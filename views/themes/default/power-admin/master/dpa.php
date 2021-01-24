<?php require_once str_replace($cname, '', __DIR__).'/path/head.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/navbar_top.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/sidebar_left.php'; ?>
<section class="content-body">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $power_admin('dashboard') ?>"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= $power_admin('master') ?>"><i class="zmdi zmdi-memory"></i> Master</a></li>
        <li class="breadcrumb-item active"><?= strtoupper($p) ?></li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card card-body" id="<?= $p ?>">
                <div class="h6 font-bold">
                    <span>Master <?= strtoupper($p).' dari "<i>'.str_trim(@$skpd[$q], 13).'</i>'?></span>
                </div>
                <hr class="my-1">
                <form method="POST" id="change_selected" novalidate>
                    <div class="form-group md" style="width: 50%">
                        <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                        <?= form_dropdown('skpd', $skpd, $q, 'class="form-control md" onchange="this.form.submit()"') ?>
                        <i class="form-bar"></i>
                    </div>
                </form>
                <hr class="my-3">
                <div class="row">
                    <div class="table-responsive">
                    <table class="table table-hover" id="datatables" name="<?= $p ?>" data-src="<?= MyLite_base.'services/'.$p.'/'.$q ?>">
                        <thead>
                            <tr>
                                <th data-field="#">#</th>
                                <th data-field="name">Program / Kegiatan</th>
                                <th data-field="sumber_dana">Sumber Dana</th>
                                <th data-field="pagu_text">Anggaran</th>
                                <th data-field="__callback" data-callback="actionDetail">Action</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
                <form class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="detail" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail</h5>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <input type="hidden" name="id" value="">
                                        <label class="col-sm-4">Kode Kegiatan</label>
                                        <div class="col-sm-8" id="code"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4">Nama Kegiatan</label>
                                        <div class="col-sm-8" id="name"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4">Tolak Ukur <?= strtoupper($p) ?></label>
                                        <div class="col-sm-8" id="tolak_ukur"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4">Target Kinerja <?= strtoupper($p) ?></label>
                                        <div class="col-sm-8" id="target_kinerja"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4">Target Jumlah <?= strtoupper($p) ?></label>
                                        <div class="col-sm-8" id="target_nominal"></div>
                                    </div>
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
<?php require_once str_replace($cname, '', __DIR__).'path/foot.php'; ?>