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


//menambah data di tabel tanggapan
mysqli_query($koneksi,"insert into tanggapan value('','$id_pengaduan','$tgl_tanggapan','$tanggapan','$id_petugas')");
//set status di tabel pengaduan berdasarkan form yg diisi
mysqli_query($koneksi,"update pengaduan set status='$status' where id_pengaduan='$id_pengaduan' ");

$_SESSION['sukses'] = 'Pengaduan Berhasil Ditanggapi' ;
//mengalihkan halaman
header("location:data_pengaduan.php");

 ?>