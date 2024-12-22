<?php
//include('dbconnected.php');
include('koneksi.php');

$nama = $_POST['nama'];
$email = $_POST['email'];
$pass = sha1($_POST['pass']);
$id_kategori = (int) $_POST['id_kategori'];


//query update
$query = mysqli_query($koneksi, "INSERT INTO `user` (`nama_pengguna`, `email`, `pass`,`id_kategori`) VALUES ('$nama', '$email', '$pass','$id_kategori')");

if ($query) {
    # credirect ke page index
    header("location:profile.php");
} else {
    echo "ERROR, data gagal di insert" . mysqli_error($koneksi);
    // 
?><script>
        //         alert('ERROR, data gagal di insert'
        //             <?php //mysqli_error($koneksi); 
                        ?>);
        //         window.location.href = 'profile.php';
        //     
    </script>
<?php
//mysql_close($host);
}
?>
