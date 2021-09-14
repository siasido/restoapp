
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Resto APP</title>

    <!-- Custom fonts for this template-->
    <link href="<?=base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    
    <!-- Custom styles for this template-->
    <link href="<?=base_url()?>assets/css/sb-admin-2.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="<?=base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

     <!-- Bootstrap core JavaScript-->
     <script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js" ></script>
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    <script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js" ></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js" ></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>
    <script src="<?=base_url()?>assets/js/autocomplete.js" ></script>
    
    <!-- Custom scripts for all pages-->
    <script src="<?=base_url()?>assets/js/sb-admin-2.min.js" ></script>

    <!-- Page level plugins -->
    <script src="<?=base_url()?>assets/vendor/datatables/jquery.dataTables.min.js" ></script>
    <script src="<?=base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.js" ></script>

    <!-- Page level custom scripts -->
    <script src="<?=base_url()?>assets/js/demo/datatables-demo.js" ></script>

    <!-- Page level plugins -->
    <script src="<?=base_url()?>assets/vendor/chart.js/Chart.min.js" ></script>

    <!-- Page level custom scripts -->
    <!-- <script src="<?=base_url()?>assets/js/demo/chart-area-demo.js" ></script>
    <script src="<?=base_url()?>assets/js/demo/chart-pie-demo.js" ></script> -->
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script> 
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>





    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=site_url('dashboard')?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-utensils"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Resto App</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?=site_url('dashboard')?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Transaksi
            </div>

            <li class="nav-item <?=$active_menu == 'order' ? 'active' : null?>">
                <a class="nav-link" href="<?=site_url('order')?>">
                <i class="fas fa-shopping-cart"></i>
                    <span>Order</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master Data
            </div>

            <li class="nav-item <?=$active_menu == 'kategori' ? 'active' : null?>">
                <a class="nav-link" href="<?=site_url('kategori')?>">
                    <i class="fas fa-list"></i>
                    <span>Kategori</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item <?=$active_menu == 'menu' ? 'active' : null?>">
                <a class="nav-link" href="<?=site_url('menu')?>">
                    <i class="fas fa-hamburger"></i>
                    <span>Menu</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item <?=$active_menu == 'meja' ? 'active' : null?>">
                <a class="nav-link" href="<?=site_url('meja')?>">
                <i class="fas fa-fw fa-table"></i>
                    <span>Meja</span></a>
            </li>

            <li class="nav-item <?=$active_menu == 'pelanggan' ? 'active' : null?>">
                <a class="nav-link" href="<?=site_url('pelanggan')?>">
                <i class="fas fa-users"></i>
                    <span>Pelanggan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$this->session->userdata('fullname');?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?=base_url()?>assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php if ($this->session->flashdata('success')) { ?>
                        <div style="position: absolute; top: 3.5rem; right: 1rem;">
                            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="toast-success" data-autohide="false">
                                <div class="toast-header bg-success text-white">
                                    <i data-feather="alert-circle"></i>
                                    <strong class="mr-auto">Success</strong>
                                    <small class="text-white-50 ml-2">just now</small>
                                    <button class="ml-2 mb-1 close text-white" type="button"  data-dismiss="toast" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="toast-body">Berhasil Menyimpan Data.</div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('info')) { ?>
                        <div style="position: absolute; top: 3rem; right: 1rem;">
                            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="toast-info" data-autohide="false">
                                <div class="toast-header bg-info text-white">
                                    <i data-feather="alert-circle"></i>
                                    <strong class="mr-auto">Info</strong>
                                    <small class="text-white-50 ml-2">just now</small>
                                    <button class="ml-2 mb-1 close text-white" type="button" data-dismiss="toast" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="toast-body">Data Berhasil Dihapus.</div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('warning')) { ?>
                        <div style="position: absolute; top: 4.5rem; right: 1rem;">
                            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="toast-warning" data-autohide="false">
                                <div class="toast-header bg-warning text-white">
                                    <i data-feather="alert-circle"></i>
                                    <strong class="mr-auto">Warning Text Toast</strong>
                                    <small class="text-white-50 ml-2">just now</small>
                                    <button class="ml-2 mb-1 close text-white" type="button" data-dismiss="toast" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="toast-body">This toast uses the warning background color utility on the toast header.</div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('danger')) { ?>
                        <div style="position: absolute; top: 3rem; right: 1rem;">
                        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="toast-danger" data-autohide="false">
                            <div class="toast-header bg-danger text-white">
                                <i data-feather="alert-circle"></i>
                                <strong class="mr-auto">Failed.</strong>
                                <small class="text-white-50 ml-2">just now</small>
                                <button class="ml-2 mb-1 close text-white" type="button" data-dismiss="toast" aria-label="Close" data-autohide="false">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="toast-body">Gagal Menyimpan Data.</div>
                        </div>
                        </div>
                    <?php } ?>

                    
                    <?php echo $contents ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; RESTO App 2021</span>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?=site_url('auth/logout')?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

   

    

    <script>
        var isSuccess = $('#toast-success').length;
        var isDanger = $('#toast-danger').length;
        var isWarning = $('#toast-warning').length;
        var isInfo = $('#toast-info').length;

        if (isSuccess){
            $("#toast-success").toast('show');
        }

        if (isDanger){
        $("#toast-danger").toast('show');
        }

        if (isWarning){
        $("#toast-warning").toast('show');
        }

        if (isInfo){
        $("#toast-info").toast('show');
        }

    </script>

    <?php if ($page_js) {?>
	<script src="<?php echo $page_js?>"></script>
	<?php }?>

</body>

</html>