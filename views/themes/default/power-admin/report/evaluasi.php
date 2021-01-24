<?php require_once str_replace($cname, '', __DIR__).'/path/head.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/navbar_top.php'; ?>
<?php require_once str_replace($cname, '', __DIR__).'path/sidebar_left.php'; ?>
<section class="content-body">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $power_admin('dashboard') ?>"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= $power_admin('report') ?>"><i class="zmdi zmdi-cast"></i> Report</a></li>
        <?php if ( empty($q) ) { ?>
        <li class="breadcrumb-item active"><?= ucwords(strtolower($p)) ?></li>
        <?php } else { ?>
        <li class="breadcrumb-item"><a href="<?= $power_admin('report/evaluasi') ?>">Evaluasi</a></li>
        <?php if ( in_array($q, ['e60','e81']) && !empty($r) ) { ?>
        <li class="breadcrumb-item active"><?= ucwords(strtolower(' Form '.$q)) ?></li>
        <?php } if ( in_array($q, ['print']) && !empty($r) && in_array($r, ['e60','e81']) && !empty($s) ) { ?>
        <li class="breadcrumb-item"><a href="<?= $power_admin('report/print') ?>">Print</a></li>
        <li class="breadcrumb-item"><a href="<?= $power_admin('report/print/'.$r) ?>">Form <?= ucwords($r) ?></a></li>
        <li class="breadcrumb-item active"><?= ucwords(strtolower($s)) ?></li>
        <?php }?>
        <?php }?>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card card-body" id="<?= $p ?>">
                <?php if ( empty($q) || (!empty($q) && $q !== 'print') ) { ?>
                <div class="h6 font-bold">
                    <span><?= !empty($q) ? ' Form '.ucwords($q).' - "<i>'.(@$bidang[$r]).'</i>"': strtoupper($p) ?></span>
                </div>
                <hr class="my-1">
                <?php } ?>
                <?php if ( empty($q) ) { ?>
                <div class="row">
                    <div class="col-md-12 mb-3">Berlandas <b class="upper">Permendagri No. 86 Tahun 2017</b>, beberapa Laporan Pengendalian dan Evaluasi Pembangunan Lingkup Kabupaten/Kota adalah sebagai berikut :</div>
                    <div class="col-md-6">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action" href="<?= $power_admin('report/'.$p.'/e60') ?>">Form. E.60</a>
                            <a class="list-group-item list-group-item-action" href="<?= $power_admin('report/'.$p.'/e81') ?>">Form. E.81</a>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                <?php if ( in_array($q, ['e60']) ) { ?>
                <form method="POST" class="row" id="change_selected" novalidate>
                    <div class="col-md-6">
                        <div class="form-group md">
                            <input type="hidden" name="form" value="<?= $q ?>">
                            <input type="hidden" name="identity" value="<?= $r ?>">
                            <input type="hidden" data-token name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                            <?= form_dropdown('bidang', $bidang, $q, 'class="form-control md" onchange="this.form.submit()"') ?>
                            <i class="form-bar"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group md" style="height: 38px">
                            <?= form_button('see_evaluasi', 'Lihat Evaluasi Tersimpan', 'class="btn btn-success btn-sm float-right waves-light" style="margin: 3px 0 0 5px;" onclick="window.location.href = root + \''.$dir_admin.'report/save\'"') ?>
                            <?= form_button('save_report', 'Simpan', 'class="btn btn-primary btn-sm float-right waves-light" style="margin: 3px 0 0;"') ?>
                        </div>
                    </div>
                </form>
                <hr class="my-3">
                <div class="row" style="position: relative">
                    <div class="backdrop"></div>
                    <div class="backdrop-text text-center">Waiting, please</div>
                    <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="datatables" name="<?= $cname.'/'.$p.'/'.$q ?>" data-ordering="false" data-lengthmenu="25,50,100" data-src="<?= MyLite_base.'services/'.$cname.'/'.$p.'/'.$q.'/'.$r ?>">
                        <thead>
                            <tr>
                                <th class="text-center" rowspan="2">Nomor Urut Program Prioritas</th>
                                <th class="text-center" rowspan="2">Sasaran Pembangunan Daerah</th>
                                <th class="text-center" rowspan="2">Kode</th>
                                <th class="text-center" rowspan="2">Urusan/Bidang Urusan Pemerintahan Daerah dan Program/Kegiatan</th>
                                <th class="text-center" rowspan="2">Indikator Kinerja Program (outcome) / Kegiatan (output)</th>
                                <th class="text-center" rowspan="2" colspan="2">Target RPJMD pada tahun <?=$rpjmd->startyear?> s/d <?=$rpjmd->endyear?></th>
                                <th class="text-center" rowspan="2" colspan="2">Realisasi Capaian Kinerja RPJMD s/d RKPD Tahun Lalu (<?=$year-1?>)</th>
                                <th class="text-center" rowspan="2" colspan="2">Target Kinerja dan Anggaran RKPD Tahun Berjalan yang dievaluasi (<?=$year?>)</th>
                                <th class="text-center" colspan="8">Realisasi Kinerja Pada Triwulan</th>
                                <th class="text-center" rowspan="2" colspan="2">Realisasi Capaian Kinerja dan Anggaran RKPD yang Dievaluasi (<?=$year?>)</th>
                                <th class="text-center" rowspan="2" colspan="2">Realisasi Kinerja dan Anggaran RPJMD s/d Tahun <?=$year?> (Akhir Tahun Pelaksanaan RKPD)</th>
                                <th class="text-center" rowspan="2" colspan="2">Tingkat Capaian Kinerja dan Realisasi Anggaran RPJMD s/d Tahun <?=$year?></th>
                                <th class="text-center" rowspan="3">Perangkat Daerah Penanggung Jawab</th>
                                <th class="text-center" rowspan="3">Keterangan</th>
                            </tr>
                            <tr>
                                <th class="text-center" colspan="2">I</th>
                                <th class="text-center" colspan="2">II</th>
                                <th class="text-center" colspan="2">III</th>
                                <th class="text-center" colspan="2" style="border-right-width: 1px">IV</th>
                            </tr>
                            <tr>
                                <th class="text-center" rowspan="2" data-field="nomor">1</th>
                                <th class="text-center" rowspan="2" data-field="sasaran">2</th>
                                <th class="text-center" rowspan="2" data-field="#">3</th>
                                <th class="text-center" rowspan="2" data-field="name_text">4</th>
                                <th class="text-center" rowspan="2" data-field="indikator">5</th>
                                <th class="text-center" colspan="2">6</th>
                                <th class="text-center" colspan="2">7</th>
                                <th class="text-center" colspan="2">8</th>
                                <th class="text-center" colspan="2">9</th>
                                <th class="text-center" colspan="2">10</th>
                                <th class="text-center" colspan="2">11</th>
                                <th class="text-center" colspan="2">12</th>
                                <th class="text-center" colspan="2">13 = 9+10+11+12</th>
                                <th class="text-center" colspan="2">14 = 7+13</th>
                                <th class="text-center" colspan="2" style="border-right-width: 1px">15 = 14/6*100%</th>
                            </tr>
                            <tr>
                                <th class="text-center" data-field="target_rpjmd_kinerja">K</th>
                                <th class="text-center" data-field="target_rpjmd_nominal_text">Rp.</th>
                                <th class="text-center" data-field="realisasi_lalu_kinerja">K</th>
                                <th class="text-center" data-field="realisasi_lalu_nominal_text">Rp.</th>
                                <th class="text-center" data-field="target_rkpd_kinerja">K</th>
                                <th class="text-center" data-field="target_rkpd_nominal_text">Rp.</th>
                                <th class="text-center" data-field="realisasi_tw1_kinerja">K</th>
                                <th class="text-center" data-field="realisasi_tw1_nominal_text">Rp.</th>
                                <th class="text-center" data-field="realisasi_tw2_kinerja">K</th>
                                <th class="text-center" data-field="realisasi_tw2_nominal_text">Rp.</th>
                                <th class="text-center" data-field="realisasi_tw3_kinerja">K</th>
                                <th class="text-center" data-field="realisasi_tw3_nominal_text">Rp.</th>
                                <th class="text-center" data-field="realisasi_tw4_kinerja">K</th>
                                <th class="text-center" data-field="realisasi_tw4_nominal_text">Rp.</th>
                                <th class="text-center" data-field="total_realisasi_kinerja">K</th>
                                <th class="text-center" data-field="total_realisasi_nominal_text">Rp.</th>
                                <th class="text-center" data-field="realisasi_sekarang_kinerja">K</th>
                                <th class="text-center" data-field="realisasi_sekarang_nominal_text">Rp.</th>
                                <th class="text-center" data-field="tingkat_pencapaian_kinerja">K</th>
                                <th class="text-center" data-field="tingkat_pencapaian_nominal_text">Rp.</th>
                                <th class="text-center" data-field="penanggungjawab">16</th>
                                <th class="text-center" data-field="notes">17</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
                <?php } if ( in_array($q, ['e81']) ) { ?>
                <?php } if ( in_array($q, ['print']) ) { ?>
<?php if ( in_array($r, ['e60']) ) { ?>
<?php
$sasaran = '';
if ( !empty($data[0]) ) {
    $sasaran = $data[0]->sasaran;
}
?>
                <div class="h3 text-center">Formulir E.60</div>
                <div class="h4 text-center">Evaluasi Terhadap Hasil RKPD</div>
                <div class="h4 text-center">Kabupaten / Kota <?= $kota ?></div>
                <div class="h4 text-center">Tahun <?= $year ?></div>
                <br>
                <div class="row">
                    <div class="h5 col-md-12">Sasaran Pembangunan Tahunan Kabupaten/kota:<br><span class="font-light"><?= $sasaran ?></span></div>
                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                            <!--thead-->
                                <tr>
                                    <th class="text-center" rowspan="2">Nomor Urut Program Prioritas</th>
                                    <th class="text-center" rowspan="2">Sasaran Pembangunan Daerah</th>
                                    <th class="text-center" rowspan="2">Kode</th>
                                    <th class="text-center" rowspan="2">Urusan/Bidang Urusan Pemerintahan Daerah dan Program/Kegiatan</th>
                                    <th class="text-center" rowspan="2">Indikator Kinerja Program (outcome) / Kegiatan (output)</th>
                                    <th class="text-center" rowspan="2" colspan="2">Target RPJMD pada tahun <?=$rpjmd->startyear?> s/d <?=$rpjmd->endyear?></th>
                                    <th class="text-center" rowspan="2" colspan="2">Realisasi Capaian Kinerja RPJMD s/d RKPD Tahun Lalu (<?=$year-1?>)</th>
                                    <th class="text-center" rowspan="2" colspan="2">Target Kinerja dan Anggaran RKPD Tahun Berjalan yang dievaluasi (<?=$year?>)</th>
                                    <th class="text-center" colspan="8">Realisasi Kinerja Pada Triwulan</th>
                                    <th class="text-center" rowspan="2" colspan="2">Realisasi Capaian Kinerja dan Anggaran RKPD yang Dievaluasi (<?=$year?>)</th>
                                    <th class="text-center" rowspan="2" colspan="2">Realisasi Kinerja dan Anggaran RPJMD s/d Tahun <?=$year?> (Akhir Tahun Pelaksanaan RKPD)</th>
                                    <th class="text-center" rowspan="2" colspan="2">Tingkat Capaian Kinerja dan Realisasi Anggaran RPJMD s/d Tahun <?=$year?></th>
                                    <th class="text-center" rowspan="3">Perangkat Daerah Penanggung Jawab</th>
                                    <th class="text-center" rowspan="3">Keterangan</th>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="2">I</th>
                                    <th class="text-center" colspan="2">II</th>
                                    <th class="text-center" colspan="2">III</th>
                                    <th class="text-center" colspan="2" style="border-right-width: 1px">IV</th>
                                </tr>
                                <tr>
                                    <th class="text-center" rowspan="2">1</th>
                                    <th class="text-center" rowspan="2">2</th>
                                    <th class="text-center" rowspan="2">3</th>
                                    <th class="text-center" rowspan="2">4</th>
                                    <th class="text-center" rowspan="2">5</th>
                                    <th class="text-center" colspan="2">6</th>
                                    <th class="text-center" colspan="2">7</th>
                                    <th class="text-center" colspan="2">8</th>
                                    <th class="text-center" colspan="2">9</th>
                                    <th class="text-center" colspan="2">10</th>
                                    <th class="text-center" colspan="2">11</th>
                                    <th class="text-center" colspan="2">12</th>
                                    <th class="text-center" colspan="2">13 = 9+10+11+12</th>
                                    <th class="text-center" colspan="2">14 = 7+13</th>
                                    <th class="text-center" colspan="2" style="border-right-width: 1px">15 = 14/6*100%</th>
                                </tr>
                                <tr>
                                    <th class="text-center">K</th>
                                    <th class="text-center">Rp.</th>
                                    <th class="text-center">K</th>
                                    <th class="text-center">Rp.</th>
                                    <th class="text-center">K</th>
                                    <th class="text-center">Rp.</th>
                                    <th class="text-center">K</th>
                                    <th class="text-center">Rp.</th>
                                    <th class="text-center">K</th>
                                    <th class="text-center">Rp.</th>
                                    <th class="text-center">K</th>
                                    <th class="text-center">Rp.</th>
                                    <th class="text-center">K</th>
                                    <th class="text-center">Rp.</th>
                                    <th class="text-center">K</th>
                                    <th class="text-center">Rp.</th>
                                    <th class="text-center">K</th>
                                    <th class="text-center">Rp.</th>
                                    <th class="text-center">K</th>
                                    <th class="text-center">Rp.</th>
                                    <th class="text-center">16</th>
                                    <th class="text-center">17</th>
                                </tr>
                            <!--</thead>-->
<?php
if ( !empty($data) ) {
    $tw = [ 1=>[ 'kinerja'=>[], 'nominal'=>0 ], 2=>[ 'kinerja'=>[], 'nominal'=>0 ], 3=>[ 'kinerja'=>[], 'nominal'=>0 ], 4=>[ 'kinerja'=>[], 'nominal'=>0 ] ];
    $realisasi = [ 'total'=>0, 'sekarang'=>0 ];
    $rkpd = [ 'target' => [], 'total' => 0 ];
    foreach ($data as $key=>$row) {
        $strip = '';
        if ( strlen($row->code) < 24 ) {
            $strip = 'amber lighten-4';
        }
        if ( strlen($row->code) === 24 ) {
            $strip = 'green lighten-4';
        }
        $tw1 = str_all_numeric($row->tw1_kinerja);
        $tw2 = str_all_numeric($row->tw2_kinerja);
        $tw3 = str_all_numeric($row->tw3_kinerja);
        $tw4 = str_all_numeric($row->tw4_kinerja);
        $tw[1]['kinerja'][] = is_array($tw1) ? array_sum($tw1): 0;
        $tw[1]['nominal'] += $row->tw1_nominal;
        $tw[2]['kinerja'][] = is_array($tw2) ? array_sum($tw2): 0;
        $tw[2]['nominal'] += $row->tw2_nominal;
        $tw[3]['kinerja'][] = is_array($tw3) ? array_sum($tw3): 0;
        $tw[3]['nominal'] += $row->tw3_nominal;
        $tw[4]['kinerja'][] = is_array($tw4) ? array_sum($tw4): 0;
        $tw[4]['nominal'] += $row->tw4_nominal;
        $realisasi['total'] += $row->total_realisasi_nominal;
        $realisasi['sekarang'] += $row->realisasi_sekarang_nominal;
        $rkpd['target'][] = str_first_numeric($row->target_rkpd_kinerja);
        $rkpd['total'] = array_sum($rkpd['target']);
?>
                                <tr class="<?= $strip?>">
                                    <td><?= $row->id_programprioritas ?></td>
                                    <td><?= $row->sasaran ?></td>
                                    <td><div  style="width: 160px !important"><?= $row->code ?></div></td>
                                    <td><?= $row->name ?></td>
                                    <td><?= $row->indikator ?></td>
                                    <td><?= $row->target_rpjmd_kinerja ?></td>
                                    <td class="text-right"><?= number_rupiah($row->target_rpjmd_nominal) ?></td>
                                    <td><?= $row->realisasi_lalu_kinerja ?></td>
                                    <td class="text-right"><?= number_rupiah($row->realisasi_lalu_nominal) ?></td>
                                    <td><?= $row->target_rkpd_kinerja ?></td>
                                    <td class="text-right"><?= number_rupiah($row->target_rkpd_nominal) ?></td>
                                    <td><?= $row->tw1_kinerja ?></td>
                                    <td class="text-right"><?= number_rupiah($row->tw1_nominal) ?></td>
                                    <td><?= $row->tw2_kinerja ?></td>
                                    <td class="text-right"><?= number_rupiah($row->tw2_nominal) ?></td>
                                    <td><?= $row->tw3_kinerja ?></td>
                                    <td class="text-right"><?= number_rupiah($row->tw3_nominal) ?></td>
                                    <td><?= $row->tw4_kinerja ?></td>
                                    <td class="text-right"><?= number_rupiah($row->tw4_nominal) ?></td>
                                    <td><?= $row->total_realisasi_kinerja ?></td>
                                    <td class="text-right"><?= number_rupiah($row->total_realisasi_nominal) ?></td>
                                    <td><?= $row->realisasi_sekarang_kinerja ?></td>
                                    <td class="text-right"><?= number_rupiah($row->realisasi_sekarang_nominal) ?></td>
                                    <td><?= $row->tingkat_pencapaian_kinerja ?></td>
                                    <td class="text-right"><?= number_rupiah($row->tingkat_pencapaian_nominal) ?></td>
                                    <td><?= $row->penanggungjawab ?></td>
                                    <td><?= $row->notes ?></td>
                                </tr>
<?php }} ?>
                                <tr>
                                    <td class="text-right" colspan="11">Rata-rata capaian kinerja (%)</td>
                                    <td class="text-right"><?= !empty($rkpd['total']) ? round((array_sum($tw[1]['kinerja'])/$rkpd['total'])*100,2): 0 ?></td>
                                    <td class="text-right"><?= !empty($realisasi['total']) ? round(($tw[1]['nominal']/$realisasi['total'])*100,2): 0 ?></td>
                                    <td class="text-right"><?= !empty($rkpd['total']) ? round((array_sum($tw[2]['kinerja'])/$rkpd['total'])*100,2): 0 ?></td>
                                    <td class="text-right"><?= !empty($realisasi['total']) ? round(($tw[2]['nominal']/$realisasi['total'])*100,2): 0 ?></td>
                                    <td class="text-right"><?= !empty($rkpd['total']) ? round((array_sum($tw[3]['kinerja'])/$rkpd['total'])*100,2): 0 ?></td>
                                    <td class="text-right"><?= !empty($realisasi['total']) ? round(($tw[3]['nominal']/$realisasi['total'])*100,2): 0 ?></td>
                                    <td class="text-right"><?= !empty($rkpd['total']) ? round((array_sum($tw[4]['kinerja'])/$rkpd['total'])*100,2): 0 ?></td>
                                    <td class="text-right"><?= !empty($realisasi['total']) ? round(($tw[4]['nominal']/$realisasi['total'])*100,2): 0 ?></td>
                                    <td class="text-right"></td>
                                    <td class="text-right">0</td>
                                    <td colspan="6"></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="11">Predikat kinerja</td>
                                    <td class="text-right"></td>
                                    <td class="text-right">0</td>
                                    <td class="text-right"></td>
                                    <td class="text-right">0</td>
                                    <td class="text-right"></td>
                                    <td class="text-right">0</td>
                                    <td class="text-right"></td>
                                    <td class="text-right">0</td>
                                    <td class="text-right"></td>
                                    <td class="text-right">0</td>
                                    <td colspan="6"></td>
                                </tr>
                                <tr>
                                    <td colspan="27">Faktor pendorong keberhasilan kinerja:</td>
                                </tr>
                                <tr>
                                    <td colspan="27">Faktor penghambat pencapaian kinerja:</td>
                                </tr>
                                <tr>
                                    <td colspan="27">Tindak lanjut yang diperlukan dalam triwulan berikutnya:</td>
                                </tr>
                                <tr>
                                    <td colspan="27">Tindak lanjut yang diperlukan dalam RKPD berikutnya:</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 pt-4">
                        <div class="row justify-content-end">
                            <div class="col-md-3 text-center">
                                Disusun,<br>
                                <?= $kota ?>, Tanggal <?= date('d ', $periode).(month('id')[date('m', $periode)-1]).date(' Y', $periode) ?><br>
                                KEPALA BAPPEDA<br><br><br><br>
                                __________________________________
                            </div>
                            <div class="col-md-3 text-center">
                                Disusun,<br>
                                <?= $kota ?>, Tanggal _________________________ <?= date(' Y', $periode) ?><br>
                                BUPATI/WALI KOTA<br>
                                KABUPATEN / KOTA <?= strtoupper($kota) ?><br><br><br>
                                __________________________________
                            </div>
                        </div>
                    </div>
                </div>
<?php } if ( in_array($r, ['e81']) ) { ?>
<?php } ?>
                <?php } ?>
                <?php } ?>
            </div>
            <!--<div id="render"></div>-->
        </div>
    </div>
</section>
<?php require_once str_replace($cname, '', __DIR__).'path/foot.php'; ?>