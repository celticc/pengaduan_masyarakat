<?php 
session_start();
if (!isset($_SESSION['username'])) {
 header("Location: ../secure/index.php");
}

include "../koneksi.php";
$id=$_SESSION['username'];
$sql=$koneksi->query(" SELECT * FROM petugas WHERE username='$id' ");
$admin=mysqli_fetch_array($sql);
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
          <span class="brand-text font-weight-light"><strong>APM</strong></span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="beranda.php" class="nav-link" style="color: #007BFF"><b>Home</b></a>
            </li>
            <li class="nav-item">
              <a href="data_pengaduan.php" class="nav-link" style="color: #007BFF"><b>Pengaduan</b></a>
            </li>
             <li class="nav-item">
              <a href="data_tanggapan.php" class="nav-link" style="color: #007BFF"><b>Tanggapan</b></a>
            </li>
            <li class="nav-item">
              <a href="laporan.php" class="nav-link" style="color: #007BFF"><b>Generate Laporan</b></a>
            </li>
            <li class="nav-item">
              <a href="pengguna.php" class="nav-link" style="color: #007BFF"><b>Pengguna</b></a>
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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"> Aplikasi Pengaduan Masyarakat
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-sm-6">
                        <h5 class="card-title m-0">Laporan Pengaduan Masyarakat</h5><br>
                      </div>
                      <div class="col-sm-6" align="Right">
              <a href="print.php" target="_blank" class="btn-primary btn-sm"><i class="fas fa-print"></i> Print</a> 
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">No.</th>
                          <th style="width: 100px">Foto</th>
                          <th>Laporan</th>
                          <th>Tanggapan</th>
                          <th>Tanggal Pengaduan</th>
                          <th>Tanggal Tanggapan</th>
                          <th>Status</th>
                          <th>Petugas</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        include "../koneksi.php";
                        $sql =mysqli_query($koneksi, "SELECT * FROM tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas");
                        while ($d = mysqli_fetch_array($sql)) {
                          ?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td class="text-center">
                              <a href="" data-toggle="modal" data-target="#modal-view-foto<?php echo $d['id_pengaduan']?>"><img src="../upload/<?=$d['foto']?>" width="65"></a><br>
                            </td>
                            <td><?=$d['isi_laporan']?></td>
                            <td><?=$d['tanggapan']?></td>
                            <td><?=date("d-m-y", strtotime($d['tgl_pengaduan']))?></td>
                            <td><?=date("d F Y", strtotime($d['tgl_pengaduan']))?></td>
                            <td><?=$d['status']?></td>
                            <td><?=$d['nama_petugas']?></td>
                            <div class="modal fade" id="modal-view-foto<?php echo $d['id_pengaduan']?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Foto Pengaduan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="text-center">
                                      <img src="../upload/<?=$d['foto']?>" width="450">  
                                    </div>
                                    <div class="card-body">
                                      <div class="text-center">
                                        <?=$d['isi_laporan'] ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </tr>
                          <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="modal fade" id="modal-edit">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Verifikasi Dan Isi Tanggapan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="simpan_pengaduan">
                          <div class="card-body">
                            <div class="form-group">
                              <label>Verifikasi</label>
                              <select class="form-control">
                                <option>Proses</option>
                                <option>Selesai</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Isi Laporan</label>
                              <textarea class="form-control" name="Laporan" rows="3" placeholder="Enter..."></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                          <button type="button" class="btn btn-primary">Simpan Pengaduan</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="modal-tambah">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Tambah Pengaduan</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="simpan_pengaduan">
                            <div class="card-body">
                              <div class="form-group">
                                <label>Isi Laporan</label>
                                <textarea class="form-control" name="Laporan" rows="3" placeholder="Enter..."></textarea>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputFile">Upload Foto</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" name="Foto" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                          <button type="button" class="btn btn-primary">Simpan Pengaduan</button>
                        </div>
                      </div>
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
        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="../assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../assets/dist/js/adminlte.min.js"></script>
      </body>
      </html>
