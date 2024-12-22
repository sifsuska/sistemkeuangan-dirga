<?php
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'koneksi.php';
 
// menangkap data yang dikirim dari form
$email =htmlentities($_POST['email']);
$pass =sha1(htmlentities($_POST['pass']));
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from user where email='$email' and pass='$pass'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if($cek > 0){
$logged = mysqli_query($koneksi,"select * from user where email='$email' and pass='$pass'");
$sesi = mysqli_fetch_assoc($logged);
	$_SESSION['id'] = $sesi['id_user'];
	$_SESSION['nama_pengguna'] = $sesi['nama_pengguna'];
	$_SESSION['role'] = $sesi['id_kategori'];
	$_SESSION['status'] = "login";
	header("location:index.php");
}else{
	// echo $cek."<br>";
	// echo $email."<br>";
	// echo $pass;
 	header("location:login.php?pesan=gagal");
}
?>