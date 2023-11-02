<?php 
session_start();
//koneksi database
include"koneksi.php";

//menangkap data yang dikirim dari form
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$telepon = $_POST['telepon'];

//input data ke database
//menambah data di tabel masyarakat
$sql=mysqli_query($koneksi,"insert into masyarakat value('$nik','$nama','$username','$password','$telepon')");

if ($sql) {
//notif berhasil
 $_SESSION['sukses'] = 'Pendaftaran Berhasil' ;
}else{
//notif gagal
 $_SESSION['gagal'] = 'Pendaftaran Gagal' ;
}

//mengalihkan halaman
header("location:index.php")
?>