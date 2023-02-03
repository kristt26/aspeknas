<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="pengajuanController">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengajuan</h1>

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6>Daftar Pengajuan</h6>
                    <a href="<?= base_url('pengajuan/add') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Klasifikasi</th>
                                    <th>Sub Klasifikasi</th>
                                    <th>Perusahaan</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Biaya</th>
                                    <th width="10%"><i class="fas fa-cogs"></i> Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas.pengajuan">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.klasifikasi.klasifikasi}}</td>
                                    <td><a href="" data-toggle="modal" data-target="#modelId" ng-click="setSubKlasifikasi(item.subPengajuan)">Sub Klasifikasi</a></td>
                                    <td>{{item.perusahaan}}</td>
                                    <td>{{item.tanggal}}</td>
                                    <td>{{item.pembayaran.nominal | currency: 'Rp. ':0}}</td>
                                    <td class="d-flex justify-content-around">
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#progress" ng-click="setItemPengajuan(item)"><i class="fas fa-book"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Sub Klasifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode KBLI</th>
                                    <th>Judul</th>
                                    <th>Kode Sub</th>
                                    <th>Skala Usaha</th>
                                    <th>Tingakt Resiko</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in itemSub">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.detail.kode_kbli}}</td>
                                    <td>{{item.detail.judul_kbli}}</td>
                                    <td>{{item.detail.kode_sub}}</td>
                                    <td>{{item.detail.skala_usaha}}</td>
                                    <td>{{item.detail.tingkat_resiko}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="progress" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Sub Klasifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <div style="margin-bottom: 40px;" ng-repeat="item in tahapan">
                                <i ng-class='{"fas fa-check fa-5x": $index<=limit}'></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">{{item.tahapan}}</h3>
                                </div>
                            </div>
                            <!-- <div style="margin-bottom: 40px;">
                                <i class="fas fa-check fa-5x"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Sertifikat SBU</h3>
                                </div>
                            </div>
                            <div style="margin-bottom: 40px;">
                                <i class="fas fa-check fa-5x"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Sertifikat KTA</h3>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-check fa-5x"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Selesai</h3>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>