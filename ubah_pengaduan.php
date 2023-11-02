<!-- ubah pengaduan -->
<?php 
session_start();
//koneksi database
include"koneksi.php";

//menangkap data yang dikirim dari form
$id = $_GET['id'];
$isi_laporan = $_POST['isi_laporan'];
$foto_lama  = $_POST['foto_lama'];


if(isset($_POST['btnubah'])){
	$ekstensi_diperbolehkan	= array('png','jpg');
	$nama = $_FILES['foto']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['foto']['size'];
	$file_tmp = $_FILES['foto']['tmp_name'];
	if (!empty($nama)) {
		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			if($ukuran < 1044070){			
				move_uploaded_file($file_tmp, 'upload/'.$nama);
				$query1 = mysqli_query($koneksi,"UPDATE pengaduan SET  isi_laporan='$isi_laporan', foto='$nama' WHERE id_pengaduan='$id' ");
				if($query1){
					$_SESSION['sukses'] = 'Data Berhasil Di Ubah' ;
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
		$query2 = mysqli_query($koneksi,"UPDATE pengaduan SET  isi_laporan='$isi_laporan', foto='$foto_lama' WHERE id_pengaduan='$id' ");
		if($query2){
			$_SESSION['sukses'] = 'Data Berhasil Di Ubah' ;
		}else{
			// gagal upload
			$_SESSION['gagal'] = 'Gagal Mengubah Data' ;
		}
	}
}
//mengalihkan halaman
header("location:pengaduan.php")
?>