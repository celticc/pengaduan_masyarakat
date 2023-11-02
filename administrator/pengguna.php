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
  <!-- SweetAlert2 -->
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
                  <h3 class="card-title">Daftar Pengguna</h3>
                  <div class="col-sm-12" align="right">
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"> Tambah</i></a>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead style="text-align: center;">
                      <tr>
                        <th style="width: 10px">No.</th>
                        <th style="width: 100px">Nama</th>
                        <th style="width: 200px">Username</th>
                        <th>Telepon</th>
                        <th>Level</th>
                        <th style="width: 150px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center;">
                      <?php 
                      include"../koneksi.php";
                      $no=1;
                      $user=$koneksi->query(" SELECT * FROM petugas");
                      foreach ($user as $user) {?>
                        <tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $user['nama_petugas'] ?></td>
                          <td><?php echo $user['username'] ?></td>
                          <td><?php echo $user['telp'] ?></td>
                          <td><?php echo $user['level'] ?></td> 
                          <td>
                            
                          <a href="hapus_pengguna.php?id=<?php echo $user['id_petugas'] ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus Pengguna" onclick="return confirm('Yakin ingin menghapus akun ini ?')"><i class="fas fa-trash"></i>
                          </a>

                          <a data-toggle="modal" data-target="#modal_ubah<?php echo $user['id_petugas']; ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ubah Pengguna"><i class="fas fa-edit"></i>
                          </a>

                        </td>
                      </tr>
                      <!-- modal ubah -->
                      <div class="modal fade" id="modal_ubah<?php echo $user['id_petugas'] ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Ubah Akun Pengguna</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form method="post" action="ubah_pengguna.php">
                              <input type="text" name="id" value="<?php echo $user['id_petugas'] ?>" hidden>
                              <div class="card-body">
                                <label>Nama</label>
                                <div class="input-group">
                                  <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $user['nama_petugas'] ?>">
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                    </div>
                                  </div>
                                </div>
                                <label>NO. Telp</label>
                                <div class="input-group ">
                                  <input type="number" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo $user['telp'] ?>">
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-phone"></span>
                                    </div>
                                  </div>
                                </div>
                                <label>Username</label>
                                <div class="input-group">
                                  <input type="text" name="username" class="form-control" placeholder="username" value="<?php echo $user['username'] ?>">
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                    </div>
                                  </div>
                                </div>
                                <label>Password</label>
                                <div class="input-group">
                                  <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $user['password'] ?>">
                                  <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Level</label>
                                  <select class="form-control" name="level">
                                    <option value="<?php echo $user['level'] ?>" selected><?php echo $user['level'] ?></option>
                                    <option value="petugas">Petugas</option>
                                    <option value="admin">Admin</option>
                                  </select>
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
                      <!-- /modal ubah -->
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
              </div>


              


              <!-- modal tambah -->
              <div class="modal fade" id="modal-tambah">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Pengguna</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="post" action="tambah_pengguna.php">
                      <div class="card-body">
                        <label>Nama</label>
                        <div class="input-group">
                          <input type="text" name="nama" class="form-control" placeholder="Nama">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                        </div>
                        <label>NO. Telp</label>
                        <div class="input-group ">
                          <input type="number" name="telepon" class="form-control" placeholder="Telepon">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-phone"></span>
                            </div>
                          </div>
                        </div>
                        <label>Username</label>
                        <div class="input-group">
                          <input type="text" name="username" class="form-control" placeholder="username">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-user"></span>
                            </div>
                          </div>
                        </div>
                        <label>Password</label>
                        <div class="input-group">
                          <input type="password" name="password" class="form-control" placeholder="Password">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Level</label>
                          <select class="form-control" name="level">
                            <option value="petugas">Petugas</option>
                            <option value="admin">Admin</option>
                          </select>
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


              <!-- REQUIRED SCRIPTS -->

              <!-- jQuery -->
              <script src="../assets/plugins/jquery/jquery.min.js"></script>
              <!-- Bootstrap 4 -->
              <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
              <!-- AdminLTE App -->
              <script src="../assets/dist/js/adminlte.min.js"></script>
              <!-- AdminLTE for demo purposes -->
              <script src="../assets/dist/js/demo.js"></script>
              <!-- file input -->
              <script src="../assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
              <!-- SweetAlert2 -->
              <script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
              <script>
                $(function () {
                  bsCustomFileInput.init();
                });
              </script>
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
