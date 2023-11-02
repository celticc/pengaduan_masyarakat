<?php
session_start(); 
//koneksi database
include"koneksi.php";

//menangkap data yang dikirim dari form
$id = $_GET['id'];

//input data ke database
//menghapus data dari tb pengaduan
$sql=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='$id'");

//mengalihkan halaman
if ($sql) {
 //notif berhasil
 $_SESSION['sukses'] = 'Data Berhasil Dihapus' ;
}else{
//notif gagal
 $_SESSION['gagal'] = 'Gagal Menghapus Data' ;
}
header("location:pengaduan.php");
?>