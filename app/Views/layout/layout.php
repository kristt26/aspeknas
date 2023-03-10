<!DOCTYPE html>
<html lang="en" ng-app="apps">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ASPEKNAS</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/libs/angular-datatables/dist/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://printjs-4de6.kxcdn.com/print.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-k7JEuIu6AAAEp8X8"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
                </div>
                <img src="<?= base_url('') ?>/logo.jpeg" alt="" width="15%">
                <div class="sidebar-brand-text mx-3">ASPEKNAS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('home') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <?php if (session()->get('role') == 'Admin') : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/klasifikasi') ?>">
                        <i class="fas fa-server"></i>
                        <span>Klasifikasi</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/manajemen_user') ?>">
                        <i class="fas fa-users"></i>
                        <span>Manajemen User</span></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('kategori') ?>">
                        <i class="fas fa-file"></i>
                        <span>Kategori</span></a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/pengajuan') ?>">
                        <i class="fas fa-file-archive"></i>
                        <span>List Pengajuan</span></a>
                </li>
            <?php endif ?>

            <?php if (session()->get('role') == 'Pendaftar') : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('pengajuan') ?>">
                        <i class="fas fa-list"></i>
                        <span>Pendaftaran</span></a>
                </li>
            <?php endif ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('logout') ?>">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>


            <!-- Nav Item - Pages Collapse Menu -->

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="javascript:void()" id="userDropdown" role="button">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->get('nama') ?></span>
                                <!-- <img class="img-profile rounded-circle"
                                    src="<?= base_url() ?>/assets/img/undraw_profile.svg"> -->
                            </a>
                            <!-- Dropdown - User Information -->
                            <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div> -->
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <?= $this->renderSection('content'); ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/libs/angular/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.8.2/angular-sanitize.min.js" integrity="sha512-JkCv2gG5E746DSy2JQlYUJUcw9mT0vyre2KxE2ZuDjNfqG90Bi7GhcHUjLQ2VIAF1QVsY5JMwA1+bjjU5Omabw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.30/angular-ui-router.min.js" integrity="sha512-HdDqpFK+5KwK5gZTuViiNt6aw/dBc3d0pUArax73z0fYN8UXiSozGNTo3MFx4pwbBPldf5gaMUq/EqposBQyWQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-animate/1.8.2/angular-animate.min.js" integrity="sha512-jZoujmRqSbKvkVDG+hf84/X11/j5TVxwBrcQSKp1W+A/fMxmYzOAVw+YaOf3tWzG/SjEAbam7KqHMORlsdF/eA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= base_url() ?>/js/apps.js"></script>
    <script src="<?= base_url() ?>/js/services/helper.services.js"></script>
    <script src="<?= base_url() ?>/js/services/auth.services.js"></script>
    <script src="<?= base_url() ?>/js/services/admin.services.js"></script>
    <script src="<?= base_url() ?>/js/services/pesan.services.js"></script>
    <script src="<?= base_url() ?>/js/controllers/admin.controllers.js"></script>
    <script src="<?= base_url() ?>/js/components/components.js"></script>
    <!-- <script src="<?= base_url() ?>/libs/sweetalert2/dist/sweetalert2.all.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="<?= base_url() ?>/libs/select2/select2.min.js"></script> -->
    <script src="<?= base_url() ?>/libs/angular-ui-select2/src/select2.js"></script>
    <script src="<?= base_url() ?>/libs/angular-datatables/dist/angular-datatables.js"></script>
    <script src="<?= base_url() ?>/libs/angular-locale_id-id.js"></script>
    <script src="<?= base_url() ?>/libs/input-mask/angular-input-masks-standalone.min.js"></script>
    <script src="<?= base_url() ?>/libs/jquery.PrintArea.js"></script>
    <script src="<?= base_url() ?>/libs/angular-base64-upload/dist/angular-base64-upload.min.js"></script>
    <script src="<?= base_url() ?>/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/btn.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/print.js"></script>
    <script src="<?= base_url() ?>/libs/loading/dist/loadingoverlay.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>


    <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>/assets/js/sb-admin-2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

</body>

</html>