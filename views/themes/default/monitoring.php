<?php require_once 'power-admin/path/head.php'; ?>
<section class="content-body" id="monitoring">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><i class="zmdi zmdi-view-dashboard"></i> Monitoring</li>
    </ol>
    <div class="row mb-4">
        <input type="hidden" name="year" value="<?= $year ?>">
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card card-body danger-color" id="bidang">
                <div class="icon-block"><i class="zmdi zmdi-spellcheck"></i></div>
                <h4>Urusan Bidang</h4>
                <div class="text-percentase"><span>0</span></div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card card-body info-color" id="opd">
                <div class="icon-block"><i class="zmdi zmdi-accounts-alt"></i></div>
                <h4>OPD</h4>
                <div class="text-percentase"><span>0</span></div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card card-body secondary-color" id="program">
                <div class="icon-block"><i class="zmdi zmdi-layers"></i></div>
                <h4>Program</h4>
                <div class="text-percentase"><span>0</span></div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card card-body mdb-color" id="kegiatan">
                <div class="icon-block"><i class="zmdi zmdi-calendar"></i></div>
                <h4>Kegiatan</h4>
                <div class="text-percentase"><span>0</span></div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-body">
                <div class="form-group md" style="width: 40%">
                    <?= form_dropdown('monthly', month_dropdown('id'), 1, 'class="form-control md"') ?>
                    <i class="form-bar"></i>
                </div>
                <div class="row" style="position: relative">
                    <div class="backdrop" style="transition: background .3s ease-in-out"></div>
                    <canvas id="canvas"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once 'power-admin/path/foot.php'; ?>