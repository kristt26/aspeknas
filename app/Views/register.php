<!DOCTYPE html>
<html lang="en" ng-app="apps" ng-controller="registerController">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" ng-submit="save()">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" ng-model="model.perusahaan" placeholder="Nama Perusahaan">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" ng-model="model.direktur" placeholder="Nama Direktur">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" class="form-control form-control-user" ng-model="model.email" placeholder="Email Perusahaan">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" ng-model="model.kontak" placeholder="Kontak">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" ng-model="model.username" placeholder="Username">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" ng-model="model.password" placeholder="Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Daftar</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="<?= base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/libs/angular/angular.min.js"></script>
    <script src="<?= base_url() ?>/js/services/helper.services.js"></script>
    <script src="<?= base_url() ?>/js/services/pesan.services.js"></script>
    <script src="<?= base_url() ?>/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>


    <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>/assets/js/sb-admin-2.min.js"></script>
    <script>
        angular.module('apps', ["helper.service", "message.service"])
            .controller("registerController", registerController);

        function registerController($scope, $http, helperServices, pesan) {
            $scope.model = {};

            $scope.save = () => {
                $http({
                    method: 'post',
                    url: helperServices.url + '/daftar',
                    data: $scope.model,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(
                    (res) => {
                        pesan.dialog("Daftar Berhasil", 'OK', false, "info").then(res => {
                            document.location.href = helperServices.url;
                        });
                    },
                    (err) => {
                        pesan.error(err.data.messages.error);
                    }
                );
            }
        }
    </script>

</body>

</html>