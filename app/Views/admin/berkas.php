<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="berkasPengajuanController">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Berkas</h1>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6>Daftar Berkas pengajuan</h6>
                </div>
                <div class="card-body">

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
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>