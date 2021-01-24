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
                    <span>Dokumen <?= strtoupper($p) ?></span>
                </div>
                <hr class="my-1">
                <div class="nav nav-pills mb-3">
                    <a class="nav-link waves-effect" href="<?= $power_admin('master/'.$p.'/visi') ?>">Visi</a>
                    <a class="nav-link waves-effect" href="<?= $power_admin('master/'.$p.'/misi') ?>">Misi</a>
                    <a class="nav-link waves-effect" href="<?= $power_admin('master/'.$p.'/sasaran') ?>">Sasaran</a>
                    <a class="nav-link waves-effect" href="<?= $power_admin('master/'.$p.'/kebijakan') ?>">Arah Kebijakan</a>
                </div>
                <label class="font-bold"><?= ucwords($q) ?></label>
<?php if ($q == 'visi') { ?>
                <form method="POST" id="<?= $q ?>">
                    <div class="form-group">
                        <label>Periode</label>
                        <div class="form-inline">
<?php
$start_years = [];
for($y=(date('Y')+2);$y>=(date('Y')-18);$y--) {
    $start_years[$y] = $y;
}
$end_years = [];
for($y=(date('Y')+22);$y>=(date('Y')-2);$y--) {
    $end_years[$y] = $y;
}
?>
                            <div class="form-group md mb-0 mr-3">
                                <?= form_dropdown('startyear', $start_years, date('Y'), ' class="form-control md" title="Awal Tahun"') ?>
                                <i class="form-bar"></i>
                            </div>
                            &nbsp;-&nbsp;
                            <div class="form-group md mb-0 ml-3">
                                <?= form_dropdown('endyear', $end_years, date('Y')+20, ' class="form-control md disabled" title="Akhir Tahun"') ?>
                                <i class="form-bar"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group md">
                        <label>Nama <?= ucwords($q)?></label>
                        <textarea name="name" class="form-control md" data-required></textarea>
                        <i class="form-bar"></i>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                        <button type="submit" class="btn btn-primary btn-sm m-0 float-right"><i class="zmdi zmdi-mail-send"></i> Tambah</button>
                    </div>
                </form>
                <hr class="my-3">
                <div class="row">
                    <div class="table-responsive">
                    <table class="table table-hover" id="datatables" name="<?= $p.'/'.$q ?>" data-src="<?= MyLite_base.'services/'.$p.'/'.$q ?>">
                        <thead>
                            <tr>
                                <th data-field="#">#</th>
                                <th data-field="name">Nama</th>
                                <th data-field="periode">Periode</th>
                                <th data-field="status_text">Status</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
<?php } elseif ($q == 'misi') { ?>
                <form method="POST" id="<?= $q ?>">
                    <div class="collapse">
                        <div class="form-group md">
                            <label>Nama Visi <i>(Active)</i></label>
                            <input type="hidden" name="id_visi" value="<?= $visi_active->id ?>" data-required>
                            <input type="text" class="form-control md" value="<?= $visi_active->name ?>" readonly>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md">
                            <label>Nama <?= ucwords($q)?></label>
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
                    <table class="table table-hover" id="datatables" name="<?= $p.'/'.$q ?>" data-src="<?= MyLite_base.'services/'.$p.'/'.$q ?>">
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
                <form class="modal fade" id="edit" name="<?= $q ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit <?= ucwords($q) ?></h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group md">
                                    <label>Nama Visi <i>(Active)</i></label>
                                    <input type="hidden" name="id_visi" value="<?= $visi_active->id ?>" data-required>
                                    <input type="text" class="form-control md" value="<?= $visi_active->name ?>" readonly>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Kode <?= ucwords($q)?></label>
                                    <input type="hidden" name="id" value="">
                                    <input type="text" name="indicator" class="form-control md" value="" readonly>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Nama <?= ucwords($q)?></label>
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
<?php } elseif ($q == 'sasaran') { ?>
                <form method="POST" id="<?= $q ?>">
                    <div class="collapse">
                        <div class="form-group md">
                            <label>Nama Misi</label>
                            <input type="hidden" name="id_visi" value="<?= $visi_active->id ?>" data-required>
                            <?= form_dropdown('id_misi', $misi_active, NULL, 'class="form-control md"') ?>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md">
                            <label>Nama <?= ucwords($q)?></label>
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
                    <table class="table table-hover" id="datatables" name="<?= $p.'/'.$q ?>" data-src="<?= MyLite_base.'services/'.$p.'/'.$q ?>">
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
                <form class="modal fade" id="edit" name="<?= $q ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit <?= ucwords($q) ?></h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group md">
                                    <label>Nama Misi</label>
                                    <input type="hidden" name="id_visi" value="<?= $visi_active->id ?>" data-required>
                                    <?= form_dropdown('id_misi', $misi_active, NULL, 'class="form-control md"') ?>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Kode <?= ucwords($q)?></label>
                                    <input type="hidden" name="id" value="">
                                    <input type="text" name="indicator" class="form-control md" value="" readonly>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Nama <?= ucwords($q)?></label>
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
<?php } elseif ($q == 'kebijakan') { ?>
                <form method="POST" id="<?= $q ?>">
                    <div class="collapse">
                        <div class="form-group md">
                            <label>Nama Misi</label>
                            <input type="hidden" name="id_visi" value="<?= $visi_active->id ?>" data-required>
                            <?= form_dropdown('id_misi', $misi_active, NULL, 'class="form-control md"') ?>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md">
                            <label>Nama Sasaran</label>
                            <?= form_dropdown('id_sasaran', $sasaran_active, NULL, 'class="form-control md"') ?>
                            <i class="form-bar"></i>
                        </div>
                        <div class="form-group md">
                            <label>Nama <?= ucwords($q)?></label>
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
                    <table class="table table-hover" id="datatables" name="<?= $p.'/'.$q ?>" data-src="<?= MyLite_base.'services/'.$p.'/'.$q ?>">
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
                <form class="modal fade" id="edit" name="<?= $q ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit <?= ucwords($q) ?></h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group md">
                                    <label>Nama Misi</label>
                                    <input type="hidden" name="id_visi" value="<?= $visi_active->id ?>" data-required>
                                    <?= form_dropdown('id_misi', $misi_active, NULL, 'class="form-control md"') ?>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Nama Sasaran</label>
                                    <?= form_dropdown('id_sasaran', $sasaran_active, NULL, 'class="form-control md"') ?>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Kode <?= ucwords($q)?></label>
                                    <input type="hidden" name="id" value="">
                                    <input type="text" name="indicator" class="form-control md" value="" readonly>
                                    <i class="form-bar"></i>
                                </div>
                                <div class="form-group md">
                                    <label>Nama <?= ucwords($q)?></label>
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