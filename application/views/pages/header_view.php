<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Monang - Monitoring Anggaran</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/dist/css/adminlte.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/dropzone/min/dropzone.min.css">

   <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a href="<?=base_url('index.php/auth/logout')?>" class="nav-link">Logout</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url()?>" class="brand-link">
      <img src="<?=base_url('assets')?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MONANG</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url('assets')?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$this->ion_auth->user()->row()->first_name?></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">MENU</li>
          <li class="nav-item">
            <a href="<?=base_url()?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Input Realisasi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('index.php/dashboard/inputrealisasils')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Realisasi LS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('index.php/dashboard/inputrealisasiup')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Realisasi UP</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('index.php/dashboard/inputrealisasitup')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Realisasi TUP</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Monitoring
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('index.php/monitoring/berkas')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Berkas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('index.php/monitoring/kontrak')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kontrak</p>
                </a>
              </li>
            </ul>
          </li>
          <?php if ($this->ion_auth->is_admin()):?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                  Input Master POK
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url('index.php/pok')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kegiatan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url('index.php/pok/show_kro')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>KRO</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url('index.php/pok/show_ro')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>RO</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url('index.php/pok/show_komponen')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Komponen</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url('index.php/pok/show_subkomponen')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Subkomponen</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url('index.php/pok/show_akun')?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Akun</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif;?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Input Posisi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('index.php/posisi')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Realisasi SAS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('index.php/posisi/pulih')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pagu Pulih</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('index.php/posisi/tup')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajuan TUP</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('index.php/posisi/up')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengajuan UP</p>
                </a>
              </li>
            </ul>
          </li>
          <?php if ($this->ion_auth->is_admin()):?>
            <li class="nav-header">SETTINGS</li>
            <li class="nav-item">
              <a href="<?=base_url('index.php/auth')?>" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>User Management</p>
              </a>
            </li>
          <?php endif;?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
