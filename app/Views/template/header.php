<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sitem Informasi Manajemen (SIM) Pengelolaan Bantuan Peserta Didik SD Negeri Kedungrejo Kapanewon Pengasih">
    <meta name="keywords" content="sim, sdnkedungrejo, sd n kedungrejo, pip, baznas, siabazku, bantuan">
    <meta name="author" content="SD Negeri Kedungrejo">
    <title><?= $judul; ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../../assets/dist/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="../../assets/dist/css/spasi_icon.css">
    <link rel="stylesheet" href="../../assets/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="../../assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <style>
        #updateButton,
        #batalButton {
            display: none;
        }
    </style>


</head>
<?php
// Mendapatkan sesi
$session = session();
// Mendapatkan nama pengguna dari sesi
$nama = $session->get('nama');
$username = $session->get('username');
$password = $session->get('password');
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="../../assets/dist/img/user4-128x128.jpg" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center"><?php echo $nama; ?></h3>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Username</b> <a class="float-right"><?php echo $username; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Password</b> <a class="float-right">********</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Nama</b> <a class="float-right"><?php echo $nama; ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="container">
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#editAkun">
                                    Edit Akun
                                </button>
                            </div>
                        </div>

                    </div>
                </li>
                <li class="nav-items dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class='fas fa-power-off' style='color:red'></i>
                    </a>

                </li>

            </ul>
        </nav>


        <aside class="main-sidebar sidebar-light-primary elevation-4">

            <a href="/dashboard" class="brand-link bg-olive">
                <img src="../../assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin Dashboard</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item menu-open">
                            <a href="/dashboard" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/dashboard') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item menu-close mt-4">
                            <a href="#" class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], '/bantuan/pip') !== false || $_SERVER['REQUEST_URI'] == '/bantuan/lainnya' || $_SERVER['REQUEST_URI'] == '/rekapitulasi')  ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-donate"></i>
                                <p>
                                    Bantuan Peserta Didik
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/bantuan/pip" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/bantuan/pip' || strpos($_SERVER['REQUEST_URI'], '/bantuan/pip/') === 0) ? 'active' : '' ?>">
                                        <i class="fas fa-chevron-circle-right nav-icon"></i>
                                        <p>Bantuan PIP</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/bantuan/lainnya" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/bantuan/lainnya') ? 'active' : '' ?>">
                                        <i class="fas fa-chevron-circle-right nav-icon"></i>
                                        <p>Bantuan Lainnya</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/rekapitulasi" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/rekapitulasi') ? 'active' : '' ?>">
                                        <i class="fas fa-chevron-circle-right nav-icon"></i>
                                        <p>Rekapitulasi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/surat/suket_wali" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/surat/suket_wali') ? 'active' : '' ?>">
                                <i class=" nav-icon fas fa-file-alt"></i>
                                <p>
                                    Suket Wali
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/setting" class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/setting') ? 'active' : '' ?>">
                                <i class=" nav-icon fas fa-cog"></i>
                                <p>
                                    Pengaturan
                                </p>
                            </a>
                        </li>



                    </ul>
                </nav>

            </div>

        </aside>