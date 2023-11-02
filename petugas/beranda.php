<?php 
//cek apakah pengguna sudah login ?
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../secure/index.php");
}
//mengambil data petugas/admin
include "../koneksi.php";
$id=$_SESSION['username'];
$sql=$koneksi->query(" SELECT * FROM petugas WHERE username='$id' ");
$admin=mysqli_fetch_array($sql);

//menghitung pengaduan masuk
$sql2 = $koneksi->query("SELECT * FROM pengaduan where status='selesai' ");
$sql3 = mysqli_query($koneksi,"SELECT * FROM pengaduan where status!='selesai'");
$p_masuk = mysqli_num_rows($sql3);
$p_selesai = mysqli_num_rows($sql2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Pengaduan Masyarakat</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="beranda.php" class="navbar-brand">
          <img src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <strong>APM</strong>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav" style="font-size: 17px;">
            <li class="nav-item">
              <a href="beranda.php" class="nav-link" ><b>Home</b></a>
            </li>
            <li class="nav-item">
              <a href="data_pengaduan.php" class="nav-link" ><b>Pengaduan</b></a>
            </li>
             <li class="nav-item">
              <a href="data_tanggapan.php" class="nav-link" ><b>Tanggapan</b></a>
            </li>
          </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Messages Dropdown Menu -->
          
          <a class="nav-link" href="#" style="color: #007BFF">
            <i class="fas fa-user"></i> Halo <?php echo $admin['nama_petugas'] ?> !
          </a>
          <a class="nav-link" href="../secure/logout_secure.php" style="color: #007BFF">
            <i class="fas fa-power-off"></i> logout
          </a>
          
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"> Aplikasi Pengaduan Masyarakat </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-12">

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="card-title m-0">Dashboard</h5>
                </div>
                <div class="card-body">
                  <!-- icon envelop -->
                  <div class="row">
                    <div class="col-6">
                     <div class="info-box">
                      <a href="p_masuk.php" class="info-box-icon bg-warning"><i class="fas fa-download"></i></a>
                      <div class="info-box-content">
                        <span class="info-box-text">Pengaduan Masuk</span>
                        <span class="info-box-number"><?php echo $p_masuk ?></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-6">
                   <div class="info-box">
                    <a href="p_selesai.php" class="info-box-icon bg-success"><i class="fas fa-check"></i></a>
                    <div class="info-box-content">
                      <span class="info-box-text">Pengaduan Selesai</span>
                      <span class="info-box-number"><?php echo $p_selesai ?></span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- icon envelop -->
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    Anything you want
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2014-2021 <a href="#">CELTIC</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js"></script>

<!-- <style type="text/css">
  .navbar-white {
    background-color: #fff;
    color: #1f2d3d;
}
</style> -->
</body>
</html>
