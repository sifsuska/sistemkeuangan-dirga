<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_cashinout'];

//query update
$query = mysqli_query($koneksi,"DELETE FROM `cashinout` WHERE id_cashinout = '$id'");

if ($query) {
 # credirect ke page index
 header("location:pendapatan.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>