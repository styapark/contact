<?php require_once dirname(__DIR__).'/path/head.php'; ?>
<?php require_once dirname(__DIR__).'/path/navbar_top.php'; ?>
<?php require_once dirname(__DIR__).'/path/sidebar_left.php'; ?>
<section class="content-body">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= power_admin('dashboard') ?>"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><i class="zmdi zmdi-memory"></i> Master</li>
        <li class="breadcrumb-item active"><?= ucfirst($cname) ?></li>
    </ol>
    <div class="row">
        <script src="media/js/controller/<?= $cname ?>.js?_=<?= date('Ymd') ?>" type="text/javascript"></script>
        <div class="col-12">
            <div class="card card-body" id="<?= $cname ?>" ng-controller="<?= $cname ?>Controller">
                <div class="h6 font-bold">
                    <span>Master <?= ucfirst($cname) ?></span>
                </div>
                <hr class="my-1">
                <div class="form-group">
                    <button type="button" class="btn btn-primary btn-sm m-0 float-right" data-toggle="modal" data-target="#add"><i class="zmdi zmdi-plus"></i> Tambah</button>
                    <form class="modal fade" id="add" ng-controller="AddController" data-action="<?= base_url('services/v1/'.$cname.'/add') ?>" novalidate>
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah <?= ucwords($cname) ?></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group md">
                                                <label>Nama Lengkap</label>
                                                <input class="form-control md" autocomplete="off" type="text" name="name" required>
                                                <i class="form-bar"></i>
                                            </div>
                                            <div class="form-group md">
                                                <label>Nama Perusahaan</label>
                                                <input class="form-control md" autocomplete="off" type="text" name="company" required>
                                                <i class="form-bar"></i>
                                            </div>
                                            <div class="form-group md">
                                                <label>Alamat Pribadi</label>
                                                <textarea class="form-control md" autocomplete="off" rows="3" name="address" required></textarea>
                                                <i class="form-bar"></i>
                                            </div>
                                            <div class="form-group md">
                                                <label>Alamat Perusahaan</label>
                                                <textarea class="form-control md" autocomplete="off" rows="3" name="address_company" required></textarea>
                                                <i class="form-bar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group my-1">
                                                <div class="row justify-content-end">
                                                    <div class="col-6">
                                                        <input class="form-control md" autocomplete="off" type="text" ng-model="search" placeholder="Pencarian">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-detail-content">
                                                <div class="form-group" ng-repeat="detail in tableDetails track by $index" ng-controller="AddDetailController" ng-hide="!detail.visible">
                                                    <div class="form-group md my-0 font-bold">{{ detail.title }}</div>
                                                    <div class="form-inline">
                                                        <div class="form-group md">
                                                            <select class="form-control md" name="detail[type][{{ $index }}]" ng-model="detail.type" ng-options="type.value as type.label for type in detail_type"></select>
                                                            <i class="form-bar"></i>
                                                        </div>
                                                        <div class="form-group md">
                                                            <input class="form-control md" autocomplete="off" type="text" name="detail[value][{{ $index }}]" ng-model="detail.value" placeholder="08xx" data-number ng-if="detail.type == 'phone'">
                                                            <input class="form-control md" autocomplete="off" type="email" name="detail[value][{{ $index }}]" ng-model="detail.value" placeholder="test@test.com" ng-if="detail.type == 'email'">
                                                            <input class="form-control md" autocomplete="off" type="text" name="detail[value][{{ $index }}]" ng-model="detail.value" placeholder="Kediri" ng-if="detail.type == 'tags'">
                                                            <textarea class="form-control md" rows="2" name="detail[value][{{ $index }}]" ng-model="detail.value" ng-if="detail.type == 'note'"></textarea>
                                                            <i class="form-bar"></i>
                                                        </div>
                                                        <div class="form-group md my-0" style="position: absolute; right: 31px;">
                                                            <a href="#" ng-click="removeDetail( $index )" title="Hapus"><i class="zmdi zmdi-delete"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-inline pull-right">
                                                    <div class="form-group">
                                                        <input class="form-control md" autocomplete="off" type="text" ng-model="title" onfocus="this.select()" placeholder="Judul" style="width: 120px">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-sm btn-info" ng-click="addDetail()">Tambah</button>
                                                    </div>
                                                </div>
                                            </div>
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
                <hr class="my-3">
                <div class="row">
                    <div class="table-responsive">
                    <table class="table table-hover table-server-side" name="<?= $cname ?>" data-src="<?= base_url('services/v1/'.$cname.'/table') ?>">
                        <thead>
                            <tr>
                                <th data-field="#" data-sort="false">#</th>
                                <th data-field="name">Nama</th>
                                <th data-field="company">Perusahaan</th>
                                <th data-field="address">Alamat Pribadi</th>
                                <th data-field="address_company">Alamat Perusahaan</th>
                                <th data-field="tags" data-sort="false">Tags</th>
                                <th data-field="__callback" data-callback="actionEditDelete">Action</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
                <form class="modal fade" id="edit" ng-controller="EditController" data-action="<?= base_url('services/v1/'.$cname.'/edit') ?>" novalidate>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit <?= ucwords($q) ?></h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group md">
                                    <label>Nama Bidang / Urusan</label>
                                    <input type="hidden" name="id" value="">
                                    <?= form_dropdown('type', $urusan, NULL, 'class="form-control md"') ?>
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
<?php require_once dirname(__DIR__).'/path/foot.php'; ?>