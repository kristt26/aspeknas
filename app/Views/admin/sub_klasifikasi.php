<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="subKlasifikasiController">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sub Klasifikasi</h1>

    </div>
    <div class="row">
        <!-- <div class="col-12-lg"> -->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h6>Input Data</h6>
                </div>
                <div class="card-body">
                    <form ng-submit="save()">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Kode KBLI</label>
                                    <input type="text" class="form-control form-control-sm" ng-model="model.kode_kbli" placeholder="Kode KBLI">
                                </div>

                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="">Judul KBLI</label>
                                    <input type="text" class="form-control form-control-sm" ng-model="model.judul_kbli" placeholder="Judul KBLI">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Kode Sub</label>
                                    <input type="text" class="form-control form-control-sm" ng-model="model.kode_sub" placeholder="Kode Sub">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Ruang Lingkup</label>
                                    <textarea class="form-control form-control-sm" ng-model="model.ruang_lingkup" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Skala Usaha</label>
                                    <input type="text" class="form-control form-control-sm" ng-model="model.skala_usaha" placeholder="Skala Usaha">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Tingkat Resiko</label>
                                    <input type="text" class="form-control form-control-sm" ng-model="model.tingkat_resiko" placeholder="Tingkat Resiko">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="col-12-md">
                <div class="card">
                    <div class="card-header">
                        <h6>Input Data</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="4">No</th>
                                        <th colspan="3" rowspan="2">Bidang Usaha</th>
                                        <th colspan="2">Resiko</th>
                                        <th rowspan="4" width="10%"><i class="fas fa-cogs"></i></th>

                                    </tr>
                                    <tr>
                                        <th>Parameter Resiko</th>
                                        <th rowspan="3">Tingakt Ratio</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">Kode KBLI</th>
                                        <th rowspan="2">Judul KBLI</th>
                                        <th width="30%">Ruang Lingkup Kegiatan</th>
                                        <th rowspan="2">Skala Usaha</th>
                                    </tr>
                                    <tr>

                                        <th>Kode Sub Klasifikasi</th>
                                    </tr>
                                </thead>
                                <tbody ng-repeat="item in datas">
                                    <tr>
                                        <td rowspan="3">{{$index+1}}</td>
                                        <td rowspan="3">{{item.kode_kbli}}</td>
                                        <td rowspan="3">{{item.judul_kbli}}</td>

                                        <td rowspan="2">{{item.ruang_lingkup}}</td>
                                        <td>Bersifat Umum</td>

                                        <td rowspan="3">{{item.tingkat_resiko}}</td>
                                        <td rowspan="3" class="d-flex justify-content-around">
                                            <button class="btn btn-warning btn-sm" ng-click="edit(item)"><i class="fas fa-edit"></i>
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                                </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">Kualifikasi: <br>{{item.skala_usaha}}</td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3" class="text-center">Kode Sub Klasifikasi : {{item.kode_sub}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
</div>
<?= $this->endSection() ?>