<?php require_once str_replace($cname, '', __DIR__).'/path/head.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/navbar_top.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/sidebar_left.php'; ?>
<section class="content-body">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $power_admin('dashboard') ?>"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= $power_admin('report') ?>"><i class="zmdi zmdi-cast"></i> Report</a></li>
        <li class="breadcrumb-item active"><?= ucwords(strtolower($p)) ?></li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card card-body" id="<?= $p ?>">
                <div class="h6 font-bold">
                    <span><?= 'Laporan '.strtoupper($p).' Dari "<i>'.@$opd[$q].'</i>"'; ?></span>
                </div><hr class="my-1">
                <form method="POST" id="change_selected" method="POST" novalidate>
                    <div class="collapse">
                        <div class="form-group md" style="width: 40%">
                            <label>Nama OPD</label>
                            <?= form_dropdown('opd', $opd, $q, 'class="form-control md"') ?>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md" style="width: 40%">
                            <label>Triwulan Ke</label>
                            <?= form_dropdown('triwulan', [3=>'Ke 1',6=>'Ke 2',9=>'Ke 3',12=>'Ke 4'], $r, 'class="form-control md"') ?>
                            <i class="form-bar"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                        <button type="button" class="btn btn-primary btn-sm m-0 float-right" onclick="if ( $(this).attr('type') == 'submit' ) this.form.submit()"><i class="zmdi zmdi-mail-send"></i> Ubah</button>
                    </div>
                </form>
                <hr class="my-3">
                <div class="row">
                    <div class="table-responsive">
                    <table class="table table-hover" id="datatables" name="<?= $p ?>" data-ordering="false" data-src="<?= MyLite_base.'services/'.$cname.'/'.$p.'/'.$q.'/'.$triwulan ?>">
                        <thead>
                            <tr>
                                <th data-field="#">#</th>
                                <th data-field="name_text">Kegiatan</th>
                                <th data-field="triwulan_text">Triwulan</th>
                                <th data-field="index_text">Jumlah Index</th>
                                <th data-field="status_text">Status</th>
                                <th data-field="__callback" data-callback="actionDetailEdit">Action</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
                <form class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Kegiatan dari :<br><b name="kegiatan"></b></h5>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_opd" value="<?=$q?>">
                                <input type="hidden" name="id_program">
                                <input type="hidden" name="id_kegiatan">
                                <input type="hidden" name="id_dpa">
                                <input type="hidden" name="triwulan">
                                <ol>
                                    <li>
                                        <div class="form-group md">
                                            <div class="row">
                                                <label class="col-md-3">Indikator Kinerja<span class="pull-right">:&nbsp;</span></label>
                                                <div class="col-md-9">${tolak_ukur_text}</div>
                                            </div>
                                        </div>
                                        <div class="form-group md">
                                            <div class="row">
                                                <label class="col-md-3">Perubahan<span class="pull-right">:&nbsp;</span></label>
                                                <div class="col-md-9">${name_perubahan}</div>
                                            </div>
                                        </div>
                                        <div class="form-group md">
                                            <div class="row">
                                                <label class="col-md-3">Target Kinerja<span class="pull-right">:&nbsp;</span></label>
                                                <div class="col-md-9">${target_kinerja_text}</div>
                                            </div>
                                        </div>
                                        <div class="form-group md">
                                            <div class="row">
                                                <label class="col-md-3">Target Nominal<span class="pull-right">:&nbsp;</span></label>
                                                <div class="col-md-9">${target_nominal_text}</div>
                                            </div>
                                        </div>
                                        <div class="form-group md">
                                            <label>Nominal Realisasi<span class="pull-right">:&nbsp;</span></label>
                                            <input type="hidden" name="id_kinerja[${index}]">
                                            <input type="hidden" name="id[${index}]">
                                            <input type="text" name="nominal[${index}]" class="form-control md" value="0">
                                            <i class="form-bar"></i>
                                        </div>
                                        <div class="form-group md">
                                            <label>Keterangan Realisasi<span class="pull-right">:&nbsp;</span></label>
                                            <textarea name="note[${index}]" class="form-control md"></textarea>
                                            <i class="form-bar"></i>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                                <button type="submit" name="valid" class="btn btn-sm btn-success"><i class="zmdi zmdi-check"></i> Valid</button>
                                <button type="submit" name="invalid" class="btn btn-sm btn-danger"><i class="zmdi zmdi-close"></i> Tolak</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal"><i class="zmdi zmdi-undo"></i> Kembali</button>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Kegiatan dari :<br><b name="kegiatan"></b></h5>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_program">
                                <input type="hidden" name="id_kegiatan">
                                <input type="hidden" name="id_dpa">
                                <input type="hidden" name="triwulan">
                                <ol>
                                    <li>
                                        <div class="form-group md">
                                            <div class="row">
                                                <label class="col-md-3">Indikator Kinerja<span class="pull-right">:&nbsp;</span></label>
                                                <div class="col-md-9">${tolak_ukur_text}</div>
                                            </div>
                                        </div>
                                        <div class="form-group md">
                                            <div class="row">
                                                <label class="col-md-3">Perubahan<span class="pull-right">:&nbsp;</span></label>
                                                <div class="col-md-9">${name_perubahan}</div>
                                            </div>
                                        </div>
                                        <div class="form-group md">
                                            <div class="row">
                                                <label class="col-md-3">Target Kinerja<span class="pull-right">:&nbsp;</span></label>
                                                <div class="col-md-9">${target_kinerja_text}</div>
                                            </div>
                                        </div>
                                        <div class="form-group md">
                                            <div class="row">
                                                <label class="col-md-3">Target Nominal<span class="pull-right">:&nbsp;</span></label>
                                                <div class="col-md-9">${target_nominal_text}</div>
                                            </div>
                                        </div>
                                        <div class="form-group md">
                                            <label>Nominal Realisasi<span class="pull-right">:&nbsp;</span></label>
                                            <input type="hidden" name="id_kinerja[${index}]">
                                            <input type="hidden" name="id[${index}]">
                                            <input type="text" name="nominal[${index}]" class="form-control md" value="0" data-number>
                                            <i class="form-bar"></i>
                                        </div>
                                        <div class="form-group md">
                                            <label>Keterangan Realisasi<span class="pull-right">:&nbsp;</span></label>
                                            <textarea name="note[${index}]" class="form-control md"></textarea>
                                            <i class="form-bar"></i>
                                        </div>
                                    </li>
                                </ol>
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