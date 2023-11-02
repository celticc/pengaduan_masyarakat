<?php 
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
}

include "koneksi.php";
$id=$_SESSION['username'];
$sql=$koneksi->query(" SELECT * FROM masyarakat WHERE username='$id' ");
$msk=mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Pengaduan Masyarakat</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="beranda.php" class="navbar-brand">
          <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <strong>APM</strong>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="beranda.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="pengaduan.php" class="nav-link">Pengaduan</a>
            </li>
          </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Messages Dropdown Menu -->
          <a class="nav-link" href="login.php">
            <i class="fas fa-user"></i> Halo <?php echo $msk['nama'] ?> !
          </a>
          <a class="nav-link"  href="logout.php">
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
            <div class="col-sm-12">
              <h1 class="m-0"> Aplikasi Pengaduan Masyarakat Desa Kesambi</h1>
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
                  <h5 class="card-title m-0"><b>PENGADUAN MASUK</b></h5>
                </div>
                <div class="card-body">
                  <!-- <h6 class="card-title">Selamat Datang Di Aplikasi Pengaduan Masyarakat</h6>
                  <p class="card-text">Pengaduan Anda adalah sebuah motivasi bagi kami agar menjadi lebih baik, silahkan untuk klik Mulai untuk menulis pengaduan.</p>
                  <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">Mulai</a> -->

                  <!-- tabel -->
                  <table class="table table-bordered">
                    <!-- kolom -->
                    <thead style="text-align: center;">
                      <!-- baris & kolom -->
                      <tr>
                        <th style="width: 10px">No.</th>
                        <th style="width: 100px">Foto</th>
                        <th style="width: 200px">Tanggal Pengaduan</th>
                        <th>Isi Pengaduan</th>
                        <th>Status</th>
                        
                      </tr>
                    </thead>
                    <!-- isi tabel -->
                    <tbody style="text-align: center;">
                      <!-- kode -->
                      <?php 
                      $no = 1;
                      $nik= $msk['nik'];
                      include"koneksi.php";
                      $sql=$koneksi->query(" SELECT * FROM pengaduan ");
                      //$pengaduan=mysqli_fetch_array($sql); 
                      foreach ($sql as $pengaduan) { ?>
                        <!-- isi baris & kolom -->
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td>
                            <a data-toggle="modal" data-target="#modal-foto<?php echo $pengaduan['id_pengaduan']; ?>">
                              <img src="upload/<?php echo $pengaduan['foto']; ?>" width="50px">
                            </a>
                          </td>
                          <td><?php echo date("d F Y", strtotime($pengaduan['tgl_pengaduan'])) ?></td>
                          <td><?php echo $pengaduan['isi_laporan']; ?></td>
                          <td>
                           <?php if ($pengaduan['status']=='0') {?>
                             <span class="badge bg-warning">Menunggu</span>
                           <?php }elseif ($pengaduan['status']=='proses') {?>
                             <span class="badge bg-primary">Proses</span>
                           <?php }else{ ?>
                             <span class="badge bg-success">Selesai</span>
                           <?php } ?> 
                         </td>
                       </tr>
                     <?php } ?>
                   </tbody>
                 </table>
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
 </div>
 <!-- ./wrapper -->
</div>

<div class="col-lg-12">
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Dibuat Dengan Hati yang Tulus
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 <a href="#">CELTIC</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>
</body>
</html>
