<?php 
// mengaktifkan session
session_start();

//memanggil koneksi.php
include 'koneksi.php';

// menangkapa data dari form login
$username = $_POST['username'];
$password = md5($_POST['password']);
// $password = $_POST['password'];

// menyeleksi data user dengan data login sesuai
$login = mysqli_query($koneksi,"select * from masyarakat where username='$username' and password='$password' ");

// mengitung data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah data login ada di database 
if ($cek >0) {
	$data = mysqli_fetch_assoc($login);
	
	$_SESSION['nik'] = $nik;
	$_SESSION['nama'] = $nama;
	$_SESSION['username'] = $username;
	$_SESSION['telp'] = $telp;
	//redirect halaman	
	header("location:pengaduan.php");
}else{
	//jika login gagal redirect kembali
	$_SESSION['gagal'] = 'Login Gagal' ;
	header("location:index.php?info=gagal");
}

?>