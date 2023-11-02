<?php 
session_start();
//koneksi database
include"koneksi.php";

//menangkap data yang dikirim dari form
$tgl_pengaduan = date('y-m-d');
$nik = $_POST['nik'];
$isi_laporan = $_POST['isi_laporan'];

if(isset($_POST['btnfoto'])){
	$ekstensi_diperbolehkan	= array('png','jpg');
	$nama = $_FILES['foto']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['foto']['size'];
	$file_tmp = $_FILES['foto']['tmp_name'];
	if (!empty($nama)) {
		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			if($ukuran < 5070){			
				move_uploaded_file($file_tmp, 'upload/'.$nama);
				$query1 = mysqli_query($koneksi,"insert into pengaduan value('','$tgl_pengaduan','$nik','$isi_laporan','$nama','0')");

				if($query1){
					$_SESSION['sukses'] = 'Pengaduan Tersimpan' ;
				}else{
					// gagal upload
					$_SESSION['gagal'] = 'Pengaduan Gagal' ;
				}
			}else{
				// ukuran file terlalu besar
				$_SESSION['gagal_ukuran'] = 'Pengaduan Gagal' ;
			}
		}else{
				//ekstensi file yang di upload tidak di perbolehkan
				$_SESSION['gagal_ektensi'] = 'Pengaduan Gagal' ;
			}

	}if(empty($nama)){
		$query2 = mysqli_query($koneksi,"insert into pengaduan value('','$tgl_pengaduan','$nik','$isi_laporan','kosong','0')");
		if($query2){
			$_SESSION['sukses'] = 'Data Berhasil Di Ubah' ;
		}else{
			// gagal upload
			$_SESSION['gagal'] = 'Gagal Mengubah Data' ;
		}
	}
}
header("location:pengaduan.php");

?>
