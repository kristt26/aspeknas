<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>

<div ng-controller="pengajuanController">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Klasifikasi</h1>

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h6>{{layout}}</h6>
                    <button class="btn btn-secondary btn-sm" onclick="history.go(-1)">Kembali</button>
                </div>
                <div class="card-body">
                    <form name="formData" ng-submit="save()">
                        <div class="col-md-12" ng-if="layout=='Klasifikasi'">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Klasifikasi</label>
                                        <select class="form-control form-control-sm" ng-options="item as item.klasifikasi for item in datas" ng-model="klasifikasi" ng-change="model.klasifikasi_id = klasifikasi.id; model.klasifikasi = klasifikasi.klasifikasi;"></select>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="">Sub Klasifikasi</label>
                                        <select class="form-control form-control-sm select2" ng-disabled="!klasifikasi" ng-options="item as (item.kode_kbli + ' - ' + item.judul_kbli) for item in klasifikasi.subKlasifikasi" ng-model="subKlasifikasi" ng-change="addSub(subKlasifikasi, klasifikasi.klasifikasi)"></select>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered" ng-show="model.subKlasifikasi && model.subKlasifikasi.length!=0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Klasifikasi</th>
                                        <th>Kode KBLI</th>
                                        <th>Judul KBLI</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in model.subKlasifikasi">
                                        <td>{{$index+1}}</td>
                                        <td>{{item.klasifikasi}}</td>
                                        <td>{{item.kode_kbli}}</td>
                                        <td>{{item.judul_kbli}}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" ng-click="removeItem(item)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="form-group d-flex justify-content-end">
                                <button type="button" class="btn btn-primary btn-sm" ng-click="next('Persyaratan')">Next</button>
                            </div>

                        </div>
                        <div class="col-md-12" ng-if="layout=='Persyaratan'">
                            <div class="bg-primary">
                                <h5 style="color:black;">Data Perusahaan</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Perusahaan</label>
                                        <input type="text" class="form-control form-control-sm" readonly value="<?= session()->get('nama') ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Direktur</label>
                                        <input type="text" class="form-control form-control-sm" readonly value="<?= session()->get('direktur') ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email Perusahaan</label>
                                        <input type="email" class="form-control form-control-sm" readonly value="<?= session()->get('email') ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Telp Perusahaan</label>
                                        <input type="text" class="form-control form-control-sm" readonly value="<?= session()->get('kontak') ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Akta Perusahaan</label>
                                        <input type="file" class="form-control" accept="application/pdf" name="akta" maxsize="200" ng-model="model.persyaratan.akta" base-sixty-four-input required>
                                        <span ng-show="formData.akta.$error.maxsize" style="color: red;">Files must not exceed 200 KB</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">NPWP Perusahaan</label>
                                        <input type="file" class="form-control" accept="application/pdf" name="npwp_perusahaan" maxsize="200" required ng-model="model.persyaratan.npwp_perusahaan" base-sixty-four-input>
                                        <span ng-show="formData.npwp_perusahaan.$error.maxsize" style="color: red;">Files must not exceed 200 KB</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nomor Induk</label>
                                        <input type="file" class="form-control" accept="application/pdf" name="nomor_induk" required maxsize="200" ng-model="model.persyaratan.nomor_induk" base-sixty-four-input>
                                        <span ng-show="formData.nomor_induk.$error.maxsize" style="color: red;">Files must not exceed 200 KB</span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="bg-primary">
                                <h5 style="color:black;">Data Pengurus</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">KTP Pengurus</label>
                                        <input type="file" class="form-control" accept="application/pdf" name="ktp_pengurus" required maxsize="200" ng-model="model.persyaratan.ktp_pengurus" base-sixty-four-input>
                                        <span ng-show="formData.ktp_pengurus.$error.maxsize" style="color: red;">Files must not exceed 200 KB</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">NPWP Pengurus</label>
                                        <input type="file" class="form-control" accept="application/pdf" name="npwp_pengurus" required maxsize="200" ng-model="model.persyaratan.npwp_pengurus" base-sixty-four-input>
                                        <span ng-show="formData.npwp_pengurus.$error.maxsize" style="color: red;">Files must not exceed 200 KB</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Foto</label>
                                        <input type="file" class="form-control" accept="application/pdf" name="foto" required maxsize="200" ng-model="model.persyaratan.foto" base-sixty-four-input>
                                        <span ng-show="formData.foto.$error.maxsize" style="color: red;">Files must not exceed 200 KB</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">SKK</label>
                                        <input type="file" class="form-control" accept="application/pdf" name="skk" required maxsize="200" ng-model="model.persyaratan.skk" base-sixty-four-input>
                                        <span ng-show="formData.skk.$error.maxsize" style="color: red;">Files must not exceed 200 KB</span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="bg-primary">
                                <h5 style="color:black;">Data Tenaga Kerja</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">KTP Tenaga Kerja</label>
                                        <input type="file" class="form-control" accept="application/pdf" name="ktp_tenaga_kerja" required maxsize="200" ng-model="model.persyaratan.ktp_tenaga_kerja" base-sixty-four-input>
                                        <span ng-show="formData.ktp_tenaga_kerja.$error.maxsize" style="color: red;">Files must not exceed 200 KB</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">NPWP Tenaga Kerja</label>
                                        <input type="file" class="form-control" accept="application/pdf" name="npwp_tenaga_kerja" required maxsize="200" ng-model="model.persyaratan.npwp_tenaga_kerja" base-sixty-four-input>
                                        <span ng-show="formData.npwp_tenaga_kerja.$error.maxsize" style="color: red;">Files must not exceed 200 KB</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Ijazah</label>
                                        <input type="file" class="form-control" accept="application/pdf" name="ijazah_tenaga_kerja" required maxsize="200" ng-model="model.persyaratan.ijazah_tenaga_kerja" base-sixty-four-input>
                                        <span ng-show="formData.ijazah_tenaga_kerja.$error.maxsize" style="color: red;">Files must not exceed 200 KB</span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="bg-primary">
                                <h5 style="color:black;">Akuntan</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Akuntan</label>
                                        <input type="file" class="form-control" accept="application/pdf" name="akuntan" required maxsize="200" ng-model="model.persyaratan.akuntan" base-sixty-four-input>
                                        <span ng-show="formData.akuntant.$error.maxsize" style="color: red;">Files must not exceed 200 KB</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <button type="button" class="btn btn-primary btn-sm" ng-click="next('Klasifikasi')">Back</button>
                                <button type="button" class="btn btn-primary btn-sm" ng-click="next('Detail Pembayaran')">Next</button>
                            </div>
                        </div>
                        <div class="col-md-12" ng-if="layout== 'Detail Pembayaran'">
                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h6>
                                            <i class="fas fa-globe"></i> Aspeknas
                                            <small class="float-right"><?= date('d M Y') ?></small>
                                        </h6>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        From
                                        <address style="font-size: smaller;">
                                            <strong>Aspeknas</strong><br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        To
                                        <address style="font-size: smaller;">
                                            <strong><?= session()->get('nama') ?></strong><br>
                                            Phone: <?= session()->get('kontak') ?><br>
                                            Email: <?= session()->get('email') ?>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col" style="font-size: smaller;">
                                        <b>Invoice #007612</b><br>
                                        <br>
                                        <b>Order ID:</b> 4F3S8J<br>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Qty</th>
                                                    <th>Pembayaran</th>
                                                    <th>Satuan</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="item in model.biaya">
                                                    <td>{{item.qty}}</td>
                                                    <td>{{item.desc}}</td>
                                                    <td>{{item.nominal | currency: 'Rp. ':0}}</td>
                                                    <td class="text-right">{{item.subTotal | currency: 'Rp. ':0}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-6">
                                        <p class="lead">Payment Methods:</p>
                                        <img src="<?= base_url() ?>/assets/img/credit/visa.png" alt="Visa">
                                        <img src="<?= base_url() ?>/assets/img/credit/mastercard.png" alt="Mastercard">
                                        <img src="<?= base_url() ?>/assets/img/credit/american-express.png" alt="American Express">
                                        <img src="<?= base_url() ?>/assets/img/credit/paypal2.png" alt="Paypal">
                                        <img src="<?= base_url() ?>/assets/img/credit/gopay.png" alt="Paypal">

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>{{model.subTotal | currency: 'Rp. ':0}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tax</th>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>{{model.subTotal | currency: 'Rp. ':0}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-12">
                                        <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                        <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                            Payment
                                        </button>
                                        <!-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                            <i class="fas fa-download"></i> Generate PDF
                                        </button> -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.invoice -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>