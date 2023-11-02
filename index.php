<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN &mdash; APM</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

</head>
<body >
  <!-- style="background:url(assets/dist/img/photo1.png) no-repeat center center;" -->


<body class="hold-transition login-page">
  
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h4">LOGIN</a>
      </div>
      <div class="card-body">
        <center>
        <p><b>Aplikasi Pengaduan Masyarakat</b></p>
        <p><b>Desa Bulung</b></p>
        </center>

        <form action="cek_login.php" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <small><a href="daftar.php"><u>Daftar Akun</u></a></small>
              <br>
              <small><a href="secure/index.php" style="color: green"><u>Login Admin</u></a></small>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">masuk</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
  <script src="style/jquery.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- <script>
    $(document).ready(function(){setTimeout(function(){$("#pesan").fadeIn('slow');}, 500);});
    setTimeout(function(){$("#pesan").fadeOut('slow');}, 3000);
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
          timer: 1500
        })
      </script>
      <?php unset($_SESSION['gagal']); } ?>

      <style type="text/css">
  body{
            background-image: url(upload/wp2088506.webp);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            height: 100%;
        }
</style>
    </body>
    </html>
