<?php 
session_start();
//koneksi database
include"../koneksi.php";

//menangkap data yang dikirim dari form
$id=$_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$telepon = $_POST['telepon'];
$level   = $_POST['level'];

//input data ke database
//menambah data di tabel petugas
$sql=mysqli_query($koneksi,"UPDATE petugas SET nama_petugas='$nama', username='$username', password='$password', telp='$telepon', level='$level' WHERE id_petugas='$id'");

if ($sql) {
//notif berhasil
 $_SESSION['sukses'] = 'Ubah Berhasil' ;
 //mengalihkan halaman
header("location:pengguna.php");
}else{
//notif gagal
 $_SESSION['gagal'] = 'Ubah Gagal' ;
 //mengalihkan halaman
header("location:pengguna.php");
}
?>