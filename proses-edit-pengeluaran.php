<?php
include 'cek_input.php';
session_start();

include('koneksi.php');

define('LOG', 'log.txt');
function write_log($log)
{
    $time = @date('[Y-d-m:H:i:s]');
    $op = $time . ' ' . $log . "\n" . PHP_EOL;
    $fp = @fopen(LOG, 'a');
    $write = @fwrite($fp, $op);
    @fclose($fp);
}

$id = (int) cek_input($_POST['id_cashinout']);
$id_perihal = (int) cek_input($_POST['id_perihal']);
$tgl = cek_input($_POST['tanggal']);
$jumlah = cek_input($_POST['jumlah']);
$keterangan = cek_input($_POST['keterangan']);

//query update

$validasi = is_numeric($jumlah);
$namaadmin = $_SESSION['nama_pengguna'];
if ($validasi) {
    //echo "wowow";
    write_log("Nama Admin : " . $namaadmin . " => Edit Pemasukan => " . $id . " => Sukses Edit");
    # credirect ke page index
    $query1 = mysqli_query($koneksi, "UPDATE cashinout SET tanggal='$tgl' , jumlah='$jumlah' WHERE id_cashinout='$id' ");
    if ($query1) {
        $query2 = mysqli_query($koneksi, "UPDATE perihal SET keterangan='$keterangan' WHERE id_perihal='$id_perihal'");
        if ($query2){
            header("location:pengeluaran.php");
        } else {
            echo "ERROR, data gagal diinsert" . mysqli_error($koneksi);    
        }
    } else {
        echo "ERROR, data gagal diinsert" . mysqli_error($koneksi);
    }
} else {
    write_log("Nama Admin : " . $namaadmin . " => Edit Pemasukan => " . $id . " => Gagal Edit");
    //echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
?>
    <script>
        alert("ERROR, data gagal diupdate"
            <?php mysqli_error($koneksi); ?>);
        window.location.href = "pengeluaran.php";
    </script>
<?php
    // header("location:pendapatan.php");
}

//mysql_close($host);
