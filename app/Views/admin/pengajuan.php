<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<div ng-controller="validasiPengajuanController">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Ajuan</h1>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6>Data Pengajuan Berkas</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table datatable="ng" class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Klasifikasi</th>
                                    <th>Sub Klasifikasi</th>
                                    <th>Perusahaan</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Biaya</th>
                                    <th width="10%"><i class="fas fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas.pengajuan" ng-class="{'bg-info': item.status=='Selesai'}">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.klasifikasi.klasifikasi}}</td>
                                    <td><a href="" data-toggle="modal" data-target="#modelId" ng-click="setSubKlasifikasi(item.subPengajuan)">Sub Klasifikasi</a></td>
                                    <td>{{item.perusahaan}}</td>
                                    <td>{{item.tanggal}}</td>
                                    <td>{{item.pembayaran.nominal | currency: 'Rp. ':0}}</td>
                                    <td class="d-flex justify-content-around">
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#progress" ng-click="setItemPengajuan(item)"><i class="fas fa-cog"></i></button>
                                        <button ng-if="item.status!='Selesai'" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#update" ng-click="setItemPengajuan(item)"><i class="fas fa-check"></i></button>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#showListBerkas" ng-click="showListBerkas(item)"><i class="fas fa-file"></i></button>
                                        <!-- <button class="btn btn-info btn-sm" ng-click="berkas(item)"><i class="fas fa-file"></i></button> -->
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
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
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

    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Progress</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form ng-submit="save()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Klasifikasi</label>
                            <select class="form-control" ng-model="model.status">
                                <option value="Pembayaran">Pembayaran</option>
                                <option value="Validasi Berkas">Validasi Berkas</option>
                                <option value="Sertifikat SBU">Sertifikat SBU</option>
                                <option value="Sertifikat KTA">Sertifikat KTA</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showListBerkas" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">List Berkas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" ng-click="showBerkas(itemBerkas.akta)">Akta Perusahaan</a>
                            <span class="badge badge-info badge-pill"><a href="" ng-click="download(itemBerkas.akta)">Download</a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" ng-click="showBerkas(itemBerkas.npwp_perusahaan)">NPWP Perusahaan</a>
                            <span class="badge badge-info badge-pill"><a href="" ng-click="download(itemBerkas.npwp_perusahaan)">Download</a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" ng-click="showBerkas(itemBerkas.nomor_induk)">Nomor Induk</a>
                            <span class="badge badge-info badge-pill"><a href="" ng-click="download(itemBerkas.nomor_induk)">Download</a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" ng-click="showBerkas(itemBerkas.ktp_pengurus)">KTP Pengurus</a>
                            <span class="badge badge-info badge-pill"><a href="" ng-click="download(itemBerkas.ktp_pengurus)">Download</a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" ng-click="showBerkas(itemBerkas.npwp_pengurus)">NPWP Pengurus</a>
                            <span class="badge badge-info badge-pill"><a href="" ng-click="download(itemBerkas.npwp_pengurus)">Download</a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" ng-click="showBerkas(itemBerkas.foto)">Foto</a>
                            <span class="badge badge-info badge-pill"><a href="" ng-click="download(itemBerkas.foto)">Download</a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" ng-click="showBerkas(itemBerkas.skk)">SKK</a>
                            <span class="badge badge-info badge-pill"><a href="" ng-click="download(itemBerkas.skk)">Download</a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" ng-click="showBerkas(itemBerkas.ktp_tenaga_kerja)">KTP Tenaga Kerja</a>
                            <span class="badge badge-info badge-pill"><a href="" ng-click="download(itemBerkas.ktp_tenaga_kerja)">Download</a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" ng-click="showBerkas(itemBerkas.npwp_tenaga_kerja)">NPWP Tenaga Kerja</a>
                            <span class="badge badge-info badge-pill"><a href="" ng-click="download(itemBerkas.npwp_tenaga_kerja)">Download</a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" ng-click="showBerkas(itemBerkas.ijazah_tenaga_kerja)">Ijazah Tenaga Kerja</a>
                            <span class="badge badge-info badge-pill"><a href="" ng-click="download(itemBerkas.ijazah_tenaga_kerja)">Download</a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" ng-click="showBerkas(itemBerkas.akuntant)">Akuntan</a>
                            <span class="badge badge-info badge-pill"><a href="" ng-click="download(itemBerkas.akuntan)">Download</a></span>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showItemBerkas" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">List Berkas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="my_pdf_viewer">
                        <div id="canvas_container">
                            <canvas id="pdf_renderer"></canvas>
                        </div>
                        <div id="navigation_controls">
                            <button id="go_previous">Previous</button>
                            <input id="current_page" value="1" type="number" />
                            <button id="go_next">Next</button>
                        </div>
                        <div id="zoom_controls">
                            <button id="zoom_in">+</button>
                            <button id="zoom_out">-</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>