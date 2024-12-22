<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_POST['id_user'];
$nama = $_POST['nama'];
$email = $_POST['email'];
if ($_POST['pass']=='') {
	$pass=$_POST['old_pass'];
} else {
	$pass=sha1($_POST['pass']);
}
//$hash = sha1($pass);
if ($_POST['id_kategori']=='') {
	# code...
	$jabatan=$_POST['old_id_kategori'];
} else {
	$jabatan=$_POST['id_kategori'];
}
//query update
$query = mysqli_query($koneksi,"UPDATE user SET nama_pengguna='$nama', email='$email', pass='$pass', id_kategori='$jabatan' WHERE id_user='$id' ");

if ($query) {
 # credirect ke page index
 header("location:profile.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
