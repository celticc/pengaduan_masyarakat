<?php 
session_start();
//koneksi database
include"koneksi.php";

//menangkap data yang dikirim dari form
$tgl_pengaduan = date('y-m-d');
$nik = $_POST['nik'];
$isi_laporan = $_POST['isi_laporan'];
// $jml_data = mysqli_query($koneksi,"SELECT MAX(id_pengaduan) FROM pengaduan");
// echo "<pre>";
// 				 print_r ($jml_data["field_count"]);
// 				 exit();
if(isset($_POST['btnfoto'])){
	$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
	$nama = $_FILES['foto']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['foto']['size'];
	$file_tmp = $_FILES['foto']['tmp_name'];
	// $auto_inc = $jml_data + 1;

	if (!empty($nama)) {
		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			if(!empty($ukuran)){			
				move_uploaded_file($file_tmp, 'upload/'.$nama);
				$query1 = mysqli_query($koneksi,"INSERT INTO pengaduan (tgl_pengaduan,nik,isi_laporan,foto,status) VALUES('$tgl_pengaduan','$nik','$isi_laporan','$nama','0')");
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
		$query2 = mysqli_query($koneksi,"INSERT INTO pengaduan (tgl_pengaduan,nik,isi_laporan,foto,status) VALUES('$tgl_pengaduan','$nik','$isi_laporan','$nama','0')");
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
