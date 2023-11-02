<?php 
// mengaktifkan session
session_start();

//memanggil koneksi.php
include '../koneksi.php';

// menangkapa data dari form login
$username = $_POST['username'];
$password = md5($_POST['password']);

// menyeleksi data user dengan data login sesuai
$login = mysqli_query($koneksi,"select * from petugas where username='$username' and password='$password' ");

// mengitung data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah data login ada di database 
if ($cek > 0) {
	$data = mysqli_fetch_assoc($login);
	if ($data['level']=='admin') {
		//cek jika user login admin
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		//redirect halaman
		header("location:../administrator/beranda.php");
	}else if ($data['level']=="petugas") {
		//cek jika user login petugas
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "petugas";
		//redirect halaman
		header("location:../petugas/beranda.php");
	}else{
		//jika login gagal redirect kembali
		$_SESSION['gagal'] = 'Login Gagal' ;
		header("location:index.php?info=gagal");
	}	
}else{
	//jika login gagal redirect kembali
	$_SESSION['gagal'] = 'Login Gagal' ;
	header("location:index.php?info=gagal");
}

?>