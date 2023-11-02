<?php 
session_start();

///cek apakah halaman ini sudah login
if($_SESSION['username']==""){
  header("location:../index.php");
}
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
    

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <!-- /.content-header -->
      <!-- Main content -->
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="card-title m-0">Laporan pengaduan Masyarakat</h5>
                  <div><br>
                    Tanggal : <?php echo date('d-m-y') ?>
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
                            <a href="" data-toggle="modal" data-target="#modal-view-foto<?php echo $d['id_pengaduan']?>"><img src="../upload/<?=$d['foto']?>" width="100"></a><br>
                          </td>
                          <td><?=$d['isi_laporan']?></td>
                          <td><?=$d['tanggapan']?></td>
                          <td><?= date("d F Y", strtotime($d['tgl_pengaduan']))?></td>
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
      <script>
        window.addEventListener("load",window.print());
      </script>
    </body>
    </html>
