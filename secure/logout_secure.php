<?php 
//mengaktifkan session
session_start();

//menghapus session
session_destroy();

//ke halaman login
header("location:index.php");
 ?>