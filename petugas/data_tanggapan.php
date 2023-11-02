<?php 
session_start();
if (!isset($_SESSION['username'])) {
 header("Location: ../secure/index.php");
}

//mengambil data dari login admin/petugas
include "../koneksi.php";
$id=$_SESSION['username'];
$sql=$koneksi->query(" SELECT * FROM petugas WHERE username='$id' ");
$petugas=mysqli_fetch_array($sql);
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
  <link rel="stylesheet" href="../assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
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
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="beranda.php" class="nav-link" ><b>Home</b></a>
            </li>
            <li class="nav-item">
              <a href="data_pengaduan.php" class="nav-link" ><b>Pengaduan</b></a>
            </li>
            <li class="nav-item">
              <a href="data_tanggapan.php" class="nav-link" ><b>Tanggapan</b></a>
            </ul>
          </div>

          <!-- Right navbar links -->
          <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Messages Dropdown Menu -->
            <a class="nav-link" href="#" style="color: #007BFF">
              <i class="fas fa-user"></i> Halo <?php echo $_SESSION['username']; ?> !
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
        <section class="content">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Verifikasi dan Isi Tanggapan</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead style="text-align: center;">
                        <tr>
                          <th style="width: 10px">No.</th>
                          <th style="width: 100px">Foto</th>
                          <th style="width: 200px">Tanggal  </th>
                          <th>Pengaduan</th>
                          <th>Tanggal Tanggapan</th>
                          <th>Tanggapan</th>
                          <th>Status</th>
                          <th style="width: 150px">Aksi</th>
                        </tr>
                      </thead>
                      <tbody style="text-align: center;">
                        <?php 
                        include"../koneksi.php";
                        $no=1;
                        $id_petugas=$petugas['id_petugas'];
                        $sql=$koneksi->query("SELECT * FROM tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan WHERE tanggapan.id_petugas='$id_petugas' ");

                        foreach ($sql as $pengaduan) {?>
                          <tr>
                            <td><?php echo $no++ ?></td>
                            <td>
                              <a data-toggle="modal" data-target="#modal-foto<?php echo $pengaduan['id_pengaduan']; ?>" 
                                data-toggle="tooltip" data-placement="top" title="klik untuk melihat">
                                <img src="../upload/<?php echo $pengaduan['foto']; ?>" width="50px">
                              </a>
                            </td>
                            <td><?php echo date("d F Y", strtotime($pengaduan['tgl_pengaduan'])) ?></td>
                            <td><?php echo $pengaduan['isi_laporan'] ?></td>
                            <td><?php echo date("d F Y", strtotime($pengaduan['tgl_tanggapan'])) ?></td>
                            <td><?php echo $pengaduan['tanggapan'] ?></td> 
                            <td>
                             <?php if ($pengaduan['status']=='0') {?>
                               <span class="badge bg-warning">menunggu</span>
                             <?php }elseif ($pengaduan['status']=='proses') {?>
                               <span class="badge bg-primary">proses</span>
                             <?php }else{ ?>
                               <span class="badge bg-success">selesai</span>
                             <?php } ?> 
                           </td>
                           <td>
                            <?php if ($pengaduan['status']=='selesai'): ?>
                              <span class="badge bg-primary">selesai</span>
                              <?php else: ?>
                                <button type="button" class="btn btn-info" data-toggle="modal" 
                                data-target="#modal-tanggapi<?php echo $pengaduan['id_pengaduan']?>" 
                                data-toggle="tooltip" data-placement="top" title="Tanggapi">
                                <i class="fas fa-edit"></i>
                              </button>
                            <?php endif ?>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                </div>


                <?php foreach ($sql as $pengaduan) {?> 
                  <!-- modal foto -->
                  <div class="modal fade" id="modal-foto<?php echo $pengaduan['id_pengaduan']; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Foto Pengaduan</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="#">
                            <div class="card-body">
                              <center>
                                <img src="../upload/<?php echo $pengaduan['foto']; ?>" width="400px">
                                <span><?php echo$pengaduan['isi_laporan'] ?></span>
                              </center>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- modal edit -->
                  <div class="modal fade" id="modal-tanggapi<?php echo $pengaduan['id_pengaduan'] ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Verifikasi dan Isi Tanggapan</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="selesai_tanggapan.php">
                            <div class="card-body">
                              <input type="text"  name="id_pengaduan" value="<?php echo $pengaduan['id_pengaduan'] ?>" hidden>
                              <input type="text"  name="id_petugas" value="<?php echo $petugas['id_petugas'] ?>" hidden>
                              <!-- select -->
                              <div class="form-group">
                                <label>Isi Laporan</label>
                                <select class="form-control" name="status">
                                  <option value="selesai">Selesai</option>
                                </select>
                              </div>
                              <!-- text area -->
                              <div class="form-group">
                                <label>Isi Tanggapan</label>
                                <textarea class="form-control" name="tanggapan" rows="3" placeholder="silahkan di tanggapi..."></textarea>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                <button  type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?> 



                <!-- REQUIRED SCRIPTS -->

                <!-- jQuery -->
                <script src="../assets/plugins/jquery/jquery.min.js"></script>
                <!-- Bootstrap 4 -->
                <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                <!-- AdminLTE App -->
                <script src="../assets/dist/js/adminlte.min.js"></script>
                <!-- AdminLTE for demo purposes -->
                <script src="../assets/dist/js/demo.js"></script>
                <!-- SweetAlert2 -->
                  <script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
                  <?php if(@$_SESSION['sukses']){ ?>
                <script>
                  Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '<?php echo $_SESSION['sukses']; ?>',
                    showConfirmButton: false,
                    timer: 1500
                  })
                </script>
                <?php unset($_SESSION['sukses']); } ?>


                  <?php if(@$_SESSION['gagal']){ ?>
                    <script>
                      Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: '<?php echo $_SESSION['gagal']; ?>',
                        showConfirmButton: false,
                        timer: 4000
                      })
                    </script>
                    <?php unset($_SESSION['gagal']); } ?>
              </body>
              </html>
