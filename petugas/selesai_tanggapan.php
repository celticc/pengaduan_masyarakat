<?php 
session_start();
//koneksi database
include"../koneksi.php";

//menangkap data yang dikirim dari form
$id_pengaduan = $_POST['id_pengaduan'];
$tgl_tanggapan = date('y-m-d');
$tanggapan = $_POST['tanggapan'];
$id_petugas = $_POST['id_petugas'];
$status = $_POST['status'];

//set status di tabel pengaduan berdasarkan form yg diisi
mysqli_query($koneksi,"update pengaduan set status='$status' where id_pengaduan='$id_pengaduan' ");
mysqli_query($koneksi,"update tanggapan set tanggapan='$tanggapan' where id_pengaduan='$id_pengaduan' ");
$_SESSION['sukses'] = 'Pengaduan Selesai' ;
//mengalihkan halaman
header("location:data_tanggapan.php");

 ?>