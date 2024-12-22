<?php
// include('cek_input.php');
//include('dbconnected.php');
//error_reporting(0);
include('koneksi.php');

$tgl_pemasukan = cek_input($_POST['tgl_pemasukan']);
$jumlah = cek_input($_POST['jumlah']);
// $sumber = cek_input($_POST['id_sumber']);
$nama_perihal = cek_input($_POST['nama_perihal']);
$keterangan = cek_input($_POST['keterangan']);

//query update
//$validasi = is_numeric($jumlah);

function cek_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (!empty($tgl_pemasukan) || !empty($jumlah) || is_numeric($jumlah) || !empty($keterangan)) {
    # credirect ke page index
    # mysqli_autocommit($koneksi,false);
    $query_perihal = mysqli_query($koneksi, "INSERT INTO `perihal` (`nama`, `keterangan`) VALUES ('$nama_perihal', '$keterangan')");
    if ($query_perihal) {
        $perihal_id = mysqli_insert_id($koneksi);

        $query_cashinout =  "INSERT INTO `cashinout` (`tanggal`,`jenis`,`jumlah`, `id_perihal`) VALUES ('$tgl_pemasukan','$nama_perihal','$jumlah', '$perihal_id')";
    
        if ( mysqli_query($koneksi, $query_cashinout)) {
            # code...
            // echo "success";
            header("location:pendapatan.php");
        } else {
            echo "ERROR, data gagal diinsert" . mysqli_error($koneksi);
        }
    } else {
        echo "ERROR, data gagal diinsert" . mysqli_error($koneksi);
        //     echo "gagal";
        // }
        // if (!mysqli_commit($koneksi)) { //commit transaction
        //     print("Table saving failed");
        //      exit();
        //  }
    }
} else {
    // echo "ERROR, data gagal diupdate" . mysqli_error($koneksi);
?>

    <script>
        alert("ERROR, data gagal di insert"
            <?php mysqli_error($koneksi); ?>);
        window.location.href = "pendapatan.php";
    </script>
<?php
}

//mysql_close($host);
