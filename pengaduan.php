<!-- pengaduan -->
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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

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
          
          <a class="nav-link"  href="">
            <i class="fas fa-user"></i> halo <?php echo $msk['nama'] ?> !
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
              <h2 class="m-0"> Aplikasi Pengaduan Masyarakat Desa Jetis Kapuan </h2>
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
                  <div class="row">
                    <div class="col-sm-6">
                      <h3 class="card-title"><b>Tulis Pengaduan</b></h3>
                    </div>
                    <div class="col-sm-6" align="right">
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">
                        <i class="fas fa-plus"></i>
                        Tambah
                      </button> 
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div></div>
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
                        <th style="width: 150px">Aksi</th>
                      </tr>
                    </thead>
                    <!-- isi tabel -->
                    <tbody style="text-align: center;">
                      <!-- kode -->
                      <?php 
                      $no = 1;
                      $nik= $msk['nik'];
                      include"koneksi.php";
                      $sql=$koneksi->query(" SELECT * FROM pengaduan WHERE nik=$nik");
                      //$pengaduan=mysqli_fetch_array($sql); 
                      foreach ($sql as $pengaduan) { ?>
                        <!-- isi baris & kolom -->
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td>
                            <a data-toggle="modal" data-target="#modal-foto<?php echo $pengaduan['id_pengaduan']; ?>" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat">
                              <?php if ($pengaduan['foto']=='kosong'): ?>
                                <span style="color: red">kosong</span>
                                <?php else:  ?>
                                <img src="upload/<?php echo $pengaduan['foto']; ?>" width="50px">
                              <?php endif ?>
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
                         <?php if ($pengaduan['status']=='selesai'){ ?>
                          <td>
                            <span class="badge bg-success">Terimakasih</span>
                          </td>
                        <?php }else if ($pengaduan['status']=='proses'){ ?> 
                          <td>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-edit<?php echo $pengaduan['id_pengaduan']; ?>" data-toggle="tooltip" data-placement="top" title="Ubah Pengaduan">
                              <i class="fas fa-edit"></i>
                            </button>
                          </td>
                        <?php }else { ?>
                          <td>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-edit<?php echo $pengaduan['id_pengaduan']; ?>" data-toggle="tooltip" data-placement="top" title="Ubah Pengaduan">
                              <i class="fas fa-edit"></i>
                            </button>
                            <a href="hapus_pengaduan.php?id=<?php echo $pengaduan['id_pengaduan'] ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus Pengaduan" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i>
                            </a>
                          </td>
                        <?php } ?>
                      </tr>

                      <!-- modal -->
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
                              <form method="post" action="simpan_pengaduan">
                                <div class="card-body">
                                  <center>
                                    <img src="upload/<?php echo $pengaduan['foto']; ?>" width="400px">
                                    <span><?php echo $pengaduan['isi_laporan'] ?></span>
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
                      <div class="modal fade" id="modal-edit<?php echo $pengaduan['id_pengaduan']; ?>" >
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Ubah Pengaduan</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="ubah_pengaduan.php?id=<?php echo $pengaduan['id_pengaduan']; ?>" enctype="multipart/form-data">
                                <div class="card-body">
                                  <input type="text" name="foto_lama" value="<?php echo $pengaduan['foto'] ?>" hidden>
                                  <center>
                                    <img src="upload/<?php echo $pengaduan['foto']; ?>" width="100px">
                                  </center>
                                  <div class="form-group">
                                    <label>Isi Laporan</label>
                                    <textarea class="form-control" name="isi_laporan" rows="3" placeholder="silahkan di isi"><?php echo $pengaduan['isi_laporan'] ?></textarea>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputFile">Ubah Foto</label><br>
                                    <span><span style="color: red;">*</span> biarkan jika tidak mengganti foto</span>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" name="foto" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Pilih Foto</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="btnubah">Ubah</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
              </div>
            </div>

            <!-- modal -->
            <!-- modal tambah -->
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
                    <form method="POST" action="tambah_pengaduan.php" enctype="multipart/form-data">
                      <div class="card-body">
                        <input type="text" name="nik" value="<?php echo $msk['nik']?>" hidden>
                        <div class="form-group">
                          <label>Isi Laporan</label>
                          <textarea class="form-control" name="isi_laporan" rows="3" placeholder="Silahkan isi pengaduan"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputFile">Upload Foto</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="foto" class="custom-file-input" id="exampleInputFile">
                              <label class="custom-file-label" for="exampleInputFile">Pilih Foto</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="btnfoto">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- modal -->

               <!-- REQUIRED SCRIPTS -->
               <!-- jQuery -->
               <script src="assets/plugins/jquery/jquery.min.js"></script>
               <!-- Bootstrap 4 -->
               <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
               <!-- AdminLTE App -->
               <script src="assets/dist/js/adminlte.min.js"></script>
               <!-- AdminLTE for demo purposes -->
               <script src="assets/dist/js/demo.js"></script>
               <!-- file input -->
               <script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
               <!-- SweetAlert2 -->
               <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
               <script>
                $(function () {
                  bsCustomFileInput.init();
                });
              </script>

             <!--  <script>
               function Hello(){
                alert("Hello World");
              }

              const btnLogin = document.getElementById("hello-petanikode");
              btnLogin.addEventListener("click", function(){
                alert("Hello Petani Kode");
              </script> -->

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

                  <?php if(@$_SESSION['gagal_ukuran']){ ?>
                    <script>
                      Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: '<?php echo $_SESSION['gagal_ukuran']; ?>',
                        text: 'Pastikan ukuran foto tidak lebih dari 5mb',
                        showConfirmButton: false,
                        timer: 4000
                      })
                    </script>
                    <?php unset($_SESSION['gagal_ukuran']); } ?>

                    <?php if(@$_SESSION['gagal_ektensi']){ ?>
                    <script>
                      Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: '<?php echo $_SESSION['gagal_ektensi']; ?>',
                        text: 'Pastikan format foto jpg / png',
                        showConfirmButton: false,
                        timer: 4000
                      })
                    </script>
                    <?php unset($_SESSION['gagal_ektensi']); } ?>

<!-- <script type="text/javascript">
  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})
</script> -->

<!--  window.location.href="<?php echo base_url('s_logout') ?>";
-->


</body>
</html>
