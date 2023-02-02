<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="klasifikasiController">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Klasifikasi</h1>

    </div>
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h6>Input Data</h6>
                </div>
                <div class="card-body">
                    <form ng-submit="save()">
                        <div class="form-group">
                            <label for="">Klasifikasi</label>
                            <input type="text" class="form-control" ng-model="model.klasifikasi" placeholder="Klasifikasi">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h6>Input Data</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Klasifikasi</th>
                                    <th width="20%"><i class="fas fa-gear"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.klasifikasi}}</td>
                                    <td class="d-flex justify-content-around">
                                        <button class="btn btn-warning btn-sm" ng-click="edit(item)"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        <button class="btn btn-info btn-sm" ng-click="subKlasifikasi(item)"><i class="fas fa-book"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>