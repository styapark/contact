<?php require_once 'path/head.php'; ?>
<?php require_once 'path/navbar_top.php'; ?>
<?php require_once 'path/sidebar_left.php'; ?>
<section class="content-body" id="<?= $__FUNCTION__ ?>">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><i class="zmdi zmdi-home"></i> Dashboard</li>
   </ol>
    <div class="row mb-4">
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card card-body secondary-color" id="target_fisik">
                <h4>Target Fisik</h4>
                <div class="text-right text-percentase"><span>0</span> %</div>
                <div class="text-block">Rp. <span>0</span>,00</div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card card-body mdb-color" id="realisasi_fisik">
                <h4>Realisasi Fisik</h4>
                <div class="text-right text-percentase"><span>0</span> %</div>
                <div class="text-block">Rp. <span>0</span>,00</div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card card-body amber" id="fisik_tertimbang">
                <h4>Fisik Tertimbang</h4>
                <div class="text-right text-percentase"><span>0</span> %</div>
                <div class="text-block">Rp. <span>0</span>,00</div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card card-body success-color" id="total_anggaran">
                <h4>Total Anggaran</h4>
                <div class="text-right text-percentase"><span>0</span> %</div>
                <div class="text-block">Rp. <span>0</span>,00</div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card card-body danger-color" id="target_penyerapan">
                <h4>Target Penyerapan</h4>
                <div class="text-right text-percentase"><span>0</span> %</div>
                <div class="text-block">Rp. <span>0</span>,00</div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card card-body info-color" id="realisasi_penyerapan">
                <h4>Realisasi Penyerapan</h4>
                <div class="text-right text-percentase"><span>0</span> %</div>
                <div class="text-block">Rp. <span>0</span>,00</div>
            </div>
        </div>
    </div>
</section>
<?php require_once 'path/foot.php'; ?>