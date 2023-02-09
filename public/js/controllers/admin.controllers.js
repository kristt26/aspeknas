angular.module('adminctrl', [])
    // Admin
    .controller('dashboardController', dashboardController)
    .controller('klasifikasiController', klasifikasiController)
    .controller('subKlasifikasiController', subKlasifikasiController)
    .controller('pengajuanController', pengajuanController)
    .controller('validasiPengajuanController', validasiPengajuanController)
    .controller('berkasPengajuanController', berkasPengajuanController)
    .controller('userManajemenController', userManajemenController)


    ;

function dashboardController($scope, dashboardServices) {
    $scope.$emit("SendUp", "Dashboard");
    $scope.datas = {};
    $scope.title = "Dashboard";
    // dashboardServices.get().then(res=>{
    //     $scope.datas = res;
    // })
}



function klasifikasiController($scope, klasifikasiServices, pesan, helperServices) {
    $scope.$emit("SendUp", "Pembobotan Faktor");
    $scope.datas = {};
    $scope.model = {};
    klasifikasiServices.get().then((res) => {
        $scope.datas = res;
    })

    $scope.setInisial = (item) => {
        $scope.model.inisial = item.substring(0, 3).toUpperCase();
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                klasifikasiServices.put($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                klasifikasiServices.post($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil menambah data");
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            klasifikasiServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }

    $scope.subKlasifikasi = (param) => {
        document.location.href = helperServices.url + "admin/sub_klasifikasi/data/" + param.id;
    }
}

function subKlasifikasiController($scope, subKlasifikasiServices, pesan, helperServices) {
    $scope.$emit("SendUp", "Pembobotan Faktor");
    $scope.datas = {};
    $scope.model = {};
    subKlasifikasiServices.get(helperServices.lastPath).then((res) => {
        $scope.datas = res;
        $scope.model.klasifikasi_id = helperServices.lastPath;
    })

    $scope.setInisial = (item) => {
        $scope.model.inisial = item.substring(0, 3).toUpperCase();
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                subKlasifikasiServices.put($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                subKlasifikasiServices.post($scope.model).then(res => {
                    $scope.model = {};
                    $scope.model.klasifikasi_id = helperServices.lastPath;
                    pesan.Success("Berhasil menambah data");
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            subKlasifikasiServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
}

function pengajuanController($scope, pengajuanServices, pesan, helperServices, pembayaranServices) {
    $scope.$emit("SendUp", "Pembobotan Faktor");
    $scope.datas = {};
    $scope.model = {};
    $scope.layout = "Klasifikasi";
    $scope.itemSub={};
    $scope.tahapan = helperServices.tahapan;
    if (helperServices.lastPath == "pengajuan") {
        pengajuanServices.get().then(res => {
            $scope.datas = res;
            $scope.datas.pengajuan.forEach(element => {
                element.klasifikasi = $scope.datas.klasifikasi.find(x=>x.id == element.klasifikasi_id);
                element.subPengajuan.forEach(element1 => {
                    element1.detail = element.klasifikasi.subKlasifikasi.find(x=>x.id==element1.sub_klasifikasi_id);
                    
                });
            });
            
            console.log($scope.datas);
        })
    } else {
        pengajuanServices.item().then(res => {
            $scope.datas = res;
            var item = window.localStorage.getItem('data')
            if (item) {
                $scope.$applyAsync(() => {
                    $scope.model = JSON.parse(item);
                    $scope.layout = $scope.model.layout;
                })
                console.log($scope.model);
            }
        })
    }

    $scope.setSubKlasifikasi = (param)=>{
        $scope.itemSub = param;
        console.log(param);
    }

    $scope.setItemPengajuan = (param)=>{
        var cek = $scope.tahapan.find(x=>x.tahapan == param.status);
        $scope.limit = cek.id-1;
    }

    $scope.next = (item) => {
        $scope.layout = item;
        $scope.model.subTotal = 0;
        if (item == 'Detail Pembayaran') {
            
            $scope.model.biaya = [];
            helperServices.biaya.forEach(element => {
                var item = {};
                if (element.desc == "SBU")
                    item.qty = $scope.model.subKlasifikasi.length;
                else
                    item.qty = 1;
                item.desc = element.desc;
                item.nominal = element.nominal;
                item.subTotal = item.qty * item.nominal;
                $scope.model.biaya.push(item);
                $scope.model.subTotal += item.subTotal;
            });
            $scope.model.layout = "Detail Pembayaran";
            window.localStorage.setItem('data', JSON.stringify($scope.model));
        }
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                pengajuanServices.put($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                $scope.model.order_id = Math.floor(Math.random() * 900000000 + 100000000);
                pengajuanServices.post($scope.model).then(res => {
                    pembayaranServices.get(res).then(ress => {
                        console.log('token = ' + ress);
                        snap.pay(ress, {

                            onSuccess: function (result) {
                                // changeResult('success', result);
                                var item = {};
                                item.order_id=res.order_id;
                                item.pengajuan_id=res.id;
                                item.nominal=res.subTotal;
                                item.status=result.transaction_status;
                                item.tanggal_transaksi=result.transaction_time;
                                item.result=result;
                                pembayaranServices.post(item).then(a=>{
                                    $scope.model = {};
                                    window.localStorage.removeItem('data');
                                    pesan.dialog('Proses Berhasil', 'Yes', 'Tidak').then(i=>{
                                        window.location.href = helperServices.url + "pengajuan";
                                    })
                                })
                            },
                            onPending: function (result) {
                                var item = {};
                                item.order_id=res.order_id;
                                item.pengajuan_id=res.id;
                                item.nominal=res.subTotal;
                                item.status=result.transaction_status;
                                item.tanggal_transaksi=result.transaction_time;
                                item.result=result;
                                pembayaranServices.post(item).then(a=>{
                                    $scope.model = {};
                                    window.localStorage.removeItem('data');
                                    pesan.dialog('Proses Berhasil', 'Yes', 'Tidak').then(i=>{
                                        window.location.href = helperServices.url + "pengajuan";
                                    })
                                })
                            }
                        });
                    })
                    
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            subKlasifikasiServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }

}
function validasiPengajuanController($scope, validasiPengajuanServices, pesan, helperServices, $http, pembayaranServices, $window) {
    $scope.$emit("SendUp", "Pembobotan Faktor");
    $scope.datas = {};
    $scope.model = {};
    $scope.layout = "Klasifikasi";
    $scope.itemSub={};
    $scope.tahapan = helperServices.tahapan;
    validasiPengajuanServices.get().then(res => {
        $scope.datas = res;
        $scope.datas.pengajuan.forEach(element => {
            element.klasifikasi = $scope.datas.klasifikasi.find(x=>x.id == element.klasifikasi_id);
            element.subPengajuan.forEach(element1 => {
                element1.detail = element.klasifikasi.subKlasifikasi.find(x=>x.id==element1.sub_klasifikasi_id);
            });
        });
        
        console.log($scope.datas);
    })

    $scope.setSubKlasifikasi = (param)=>{
        $scope.itemSub = param;
        console.log(param);
    }

    $scope.setItemPengajuan = (param)=>{
        var cek = $scope.tahapan.find(x=>x.tahapan == param.status);
        $scope.limit = cek.id-1;
        $scope.model = param;
    }

    $scope.next = (item) => {
        $scope.layout = item;
        $scope.model.subTotal = 0;
        if (item == 'Detail Pembayaran') {
            
            $scope.model.biaya = [];
            helperServices.biaya.forEach(element => {
                var item = {};
                if (element.desc == "SBU")
                    item.qty = $scope.model.subKlasifikasi.length;
                else
                    item.qty = 1;
                item.desc = element.desc;
                item.nominal = element.nominal;
                item.subTotal = item.qty * item.nominal;
                $scope.model.biaya.push(item);
                $scope.model.subTotal += item.subTotal;
            });
            $scope.model.layout = "Detail Pembayaran";
            window.localStorage.setItem('data', JSON.stringify($scope.model));
        }
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                validasiPengajuanServices.put($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil mengubah data");
                    $("#update").modal('hide');
                })
            } else {
                $scope.model.order_id = Math.floor(Math.random() * 900000000 + 100000000);
                pengajuanServices.post($scope.model).then(res => {
                    pembayaranServices.get(res).then(ress => {
                        console.log('token = ' + ress);
                        snap.pay(ress, {

                            onSuccess: function (result) {
                                // changeResult('success', result);
                                var item = {};
                                item.order_id=res.order_id;
                                item.pengajuan_id=res.id;
                                item.nominal=res.subTotal;
                                item.status=result.transaction_status;
                                item.tanggal_transaksi=result.transaction_time;
                                item.result=result;
                                pembayaranServices.post(item).then(a=>{
                                    $scope.model = {};
                                    window.localStorage.removeItem('data');
                                    pesan.dialog('Proses Berhasil', 'Yes', 'Tidak').then(i=>{
                                        window.location.href = helperServices.url + "pengajuan";
                                    })
                                })
                            },
                            onPending: function (result) {
                                var item = {};
                                item.order_id=res.order_id;
                                item.pengajuan_id=res.id;
                                item.nominal=res.subTotal;
                                item.status=result.transaction_status;
                                item.tanggal_transaksi=result.transaction_time;
                                item.result=result;
                                pembayaranServices.post(item).then(a=>{
                                    $scope.model = {};
                                    window.localStorage.removeItem('data');
                                    pesan.dialog('Proses Berhasil', 'Yes', 'Tidak').then(i=>{
                                        window.location.href = helperServices.url + "pengajuan";
                                    })
                                })
                            }
                        });
                    })
                    
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            subKlasifikasiServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }

    
    $scope.showListBerkas = (item)=>{
        $scope.itemBerkas = item.persyaratan;
        console.log($scope.itemBerkas);
        // window.location.href = helperServices.url + "admin/pengajuan/berkas/" + item.id
    }

    $scope.showBerkas=(item)=>{
        var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }
     
        pdfjsLib.getDocument(helperServices.url + 'assets/berkas/'+ $scope.itemBerkas.akta).then((pdf) => {
            myState.pdf = pdf;
            render();
            $("#showItemBerkas").modal('show');
        });
        function render() {
            myState.pdf.getPage(myState.currentPage).then((page) => {
         
                var canvas = document.getElementById("pdf_renderer");
                var ctx = canvas.getContext('2d');
     
                var viewport = page.getViewport(myState.zoom);
                canvas.width = viewport.width;
                canvas.height = viewport.height;
         
                page.render({
                    canvasContext: ctx,
                    viewport: viewport
                });
            });
        }
        $scope.itemBerkas = item;
    }

    $scope.download = (item)=>{
        $http.get(helperServices.url + 'assets/berkas/' + item, { responseType: 'arraybuffer' }).then(function (response) {
            console.log(response.data);
            var file = new Blob([response.data], { type: 'application/pdf' });
            file.name = item.file;
            var fileUrl = URL.createObjectURL(file);
            $window.open(fileUrl, '_blank');
        });

    }
}
function berkasPengajuanController($scope, validasiPengajuanServices, pesan, helperServices, pembayaranServices) {
    $scope.$emit("SendUp", "Berkas Pengjuan");
    $scope.datas = {};
    $scope.model = {};
    $scope.itemSub={};
    $scope.tahapan = helperServices.tahapan;
    validasiPengajuanServices.getBerkas(helperServices.lastPath).then(res => {
        $scope.datas = res;
        $scope.datas.pengajuan.forEach(element => {
            element.klasifikasi = $scope.datas.klasifikasi.find(x=>x.id == element.klasifikasi_id);
            element.subPengajuan.forEach(element1 => {
                element1.detail = element.klasifikasi.subKlasifikasi.find(x=>x.id==element1.sub_klasifikasi_id);
            });
        });
        
        console.log($scope.datas);
    })

    $scope.setSubKlasifikasi = (param)=>{
        $scope.itemSub = param;
        console.log(param);
    }

    $scope.setItemPengajuan = (param)=>{
        var cek = $scope.tahapan.find(x=>x.tahapan == param.status);
        $scope.limit = cek.id-1;
        $scope.model = param;
    }

    $scope.next = (item) => {
        $scope.layout = item;
        $scope.model.subTotal = 0;
        if (item == 'Detail Pembayaran') {
            
            $scope.model.biaya = [];
            helperServices.biaya.forEach(element => {
                var item = {};
                if (element.desc == "SBU")
                    item.qty = $scope.model.subKlasifikasi.length;
                else
                    item.qty = 1;
                item.desc = element.desc;
                item.nominal = element.nominal;
                item.subTotal = item.qty * item.nominal;
                $scope.model.biaya.push(item);
                $scope.model.subTotal += item.subTotal;
            });
            $scope.model.layout = "Detail Pembayaran";
            window.localStorage.setItem('data', JSON.stringify($scope.model));
        }
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                validasiPengajuanServices.put($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil mengubah data");
                    $("#update").modal('hide');
                })
            } else {
                $scope.model.order_id = Math.floor(Math.random() * 900000000 + 100000000);
                pengajuanServices.post($scope.model).then(res => {
                    pembayaranServices.get(res).then(ress => {
                        console.log('token = ' + ress);
                        snap.pay(ress, {

                            onSuccess: function (result) {
                                // changeResult('success', result);
                                var item = {};
                                item.order_id=res.order_id;
                                item.pengajuan_id=res.id;
                                item.nominal=res.subTotal;
                                item.status=result.transaction_status;
                                item.tanggal_transaksi=result.transaction_time;
                                item.result=result;
                                pembayaranServices.post(item).then(a=>{
                                    $scope.model = {};
                                    window.localStorage.removeItem('data');
                                    pesan.dialog('Proses Berhasil', 'Yes', 'Tidak').then(i=>{
                                        window.location.href = helperServices.url + "pengajuan";
                                    })
                                })
                            },
                            onPending: function (result) {
                                var item = {};
                                item.order_id=res.order_id;
                                item.pengajuan_id=res.id;
                                item.nominal=res.subTotal;
                                item.status=result.transaction_status;
                                item.tanggal_transaksi=result.transaction_time;
                                item.result=result;
                                pembayaranServices.post(item).then(a=>{
                                    $scope.model = {};
                                    window.localStorage.removeItem('data');
                                    pesan.dialog('Proses Berhasil', 'Yes', 'Tidak').then(i=>{
                                        window.location.href = helperServices.url + "pengajuan";
                                    })
                                })
                            }
                        });
                    })
                    
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            subKlasifikasiServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }

    
    $scope.berkas = (item)=>{
        window.location.href = helperServices.url + "admin/pengajuan/berkas/" + item.id
    }
}

function userManajemenController($scope, userManajemenServices, pesan, helperServices) {
    $scope.$emit("SendUp", "Pembobotan Faktor");
    $scope.datas = {};
    $scope.model = {};
    userManajemenServices.get().then(res => {
        $scope.datas = res;
    })
}
