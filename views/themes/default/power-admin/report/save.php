<?php require_once str_replace($cname, '', __DIR__).'/path/head.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/navbar_top.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/sidebar_left.php'; ?>
<section class="content-body">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $power_admin('dashboard') ?>"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= $power_admin('report') ?>"><i class="zmdi zmdi-cast"></i> Report</a></li>
        <li class="breadcrumb-item active">Report Tersimpan</li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card card-body" id="<?= $p ?>">
                <div class="h6 font-bold">
                    <span><?= !empty($q) ? 'Laporan '.ucwords($q).' dari ""': 'Semua Laporan Tersimpan' ?></span>
                </div>
                <hr class="my-3">
                <div class="row">
                    <div class="table-responsive">
                    <table class="table table-hover" id="datatables" name="<?= $cname.'/'.$p ?>" data-ordering="false" data-src="<?= MyLite_base.'services/'.$cname.'/'.$p ?>">
                        <thead>
                            <tr>
                                <th data-field="#">#</th>
                                <th data-field="periode_text">Tanggal</th>
                                <th data-field="year">Tahun</th>
                                <th data-field="form_text">Tipe Form</th>
                                <th data-field="name_text">Bidang Urusan / OPD</th>
                                <th data-field="title">Judul</th>
                                <th data-field="total_text">Total</th>
                                <th data-field="__callback" data-callback="actionEditDeleteExportPrint">Action</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
                <form class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Laporan Tersimpan</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group md">
                                    <label>Tahun</label>
                                    <input type="text" name="year" class="form-control md" value="" disabled>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Tipe Form</label>
                                    <input type="text" name="form" class="form-control md" value="" disabled>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Bidang Urusan / OPD</label>
                                    <input type="text" name="name" class="form-control md" value="" disabled>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Judul Laporan</label>
                                    <textarea name="title" class="form-control md" data-required></textarea>
                                    <i class="form-bar"></i>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id" value="">
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