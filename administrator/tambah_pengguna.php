<?php 
session_start();
//koneksi database
include"../koneksi.php";

//menangkap data yang dikirim dari form
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$telepon = $_POST['telepon'];
$level   = $_POST['level'];

//input data ke database
//menambah data di tabel petugas
$sql=mysqli_query($koneksi,"insert into petugas value('','$nama','$username','$password','$telepon','$level')");

if ($sql) {
//notif berhasil
 $_SESSION['sukses'] = 'Pendaftaran Berhasil' ;
 //mengalihkan halaman
header("location:pengguna.php");
}else{
//notif gagal
 $_SESSION['gagal'] = 'Pendaftaran Gagal' ;
 //mengalihkan halaman
header("location:pengguna.php");
}
?>