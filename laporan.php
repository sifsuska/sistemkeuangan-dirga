<?php
error_reporting(0);
require 'cek-sesi.php';
require 'koneksi.php';

# Report
if (isset($_GET['filter']) && !empty($_GET['filter'])) {
  $filter = $_GET['filter'];
  if ($filter == '1') {
    $tgl = $_GET['tanggal'];
    $ket = 'Laporan Obat Yang Expired Pada Tanggal : ' . date('d-m-y', strtotime($tgl));
    $url_cetak = '/cetak_expired_obat?filter=1&tanggal= ' . $tgl;
    $query1 = "SELECT cashinout.*, perihal.id_perihal as id_perihal, perihal.keterangan as keterangan FROM cashinout JOIN perihal ON cashinout.id_perihal = perihal.id_perihal WHERE DATE(tanggal)='$tgl' AND jenis='Pemasukkan'";
    $query2 = "SELECT cashinout.*, perihal.id_perihal as id_perihal, perihal.keterangan as keterangan FROM cashinout JOIN perihal ON cashinout.id_perihal = perihal.id_perihal WHERE DATE(tanggal)='$tgl' AND jenis='Pengeluaran'";
    // $laporan = mysqli_query($koneksi, "SELECT * FROM cashinout WHERE DATE(tanggal)='$tgl' GROUP BY jenis");
  } elseif ($filter == '2') {
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
    $nama_bulan = array(
      '',
      'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $ket = 'Laporan Obat Yang Expired Pada Bulan : ' . $nama_bulan[$bulan] . ' ' . $tahun;
    $url_cetak = '/cetak_expired_obat?filter=2&bulan=' . $bulan . '&tahun=' . $tahun;
    $query1 = "SELECT cashinout.*, perihal.id_perihal as id_perihal, perihal.keterangan as keterangan FROM cashinout JOIN perihal ON cashinout.id_perihal = perihal.id_perihal WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND jenis='Pemasukkan'";
    $query2 = "SELECT cashinout.*, perihal.id_perihal as id_perihal, perihal.keterangan as keterangan FROM cashinout JOIN perihal ON cashinout.id_perihal = perihal.id_perihal WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND jenis='Pengeluaran'";
    //  $laporan = mysqli_query($koneksi, "SELECT * FROM cashinout WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' GROUP BY jenis");
  } else {
    $tahun = $_GET['tahun'];
    $ket = 'Laporan Obat Yang Expired Pada Tahun : ' . $tahun;
    $url_cetak = '/cetak_expired_obat?filter=3&tahun=' . $tahun;
    $query1 = "SELECT cashinout.*, perihal.id_perihal as id_perihal, perihal.keterangan as keterangan FROM cashinout JOIN perihal ON cashinout.id_perihal = perihal.id_perihal WHERE YEAR(tanggal)='$tahun' AND jenis='Pemasukkan'";
    $query2 = "SELECT cashinout.*, perihal.id_perihal as id_perihal, perihal.keterangan as keterangan FROM cashinout JOIN perihal ON cashinout.id_perihal = perihal.id_perihal WHERE YEAR(tanggal)='$tahun' AND jenis='Pengeluaran'";
    //$laporan = mysqli_query($koneksi, "SELECT * FROM cashinout WHERE YEAR(tanggal)='$tahun' GROUP BY jenis");
  }
} else {

  $ket = 'Laporan Obat Yang Expired';
  $url_cetak = '/cetak_expired_obat';
  $query1 = "SELECT cashinout.*, perihal.id_perihal as id_perihal, perihal.keterangan as keterangan FROM cashinout JOIN perihal ON cashinout.id_perihal = perihal.id_perihal WHERE jenis='Pemasukkan'";
  $query2 = "SELECT cashinout.*, perihal.id_perihal as id_perihal, perihal.keterangan as keterangan FROM cashinout JOIN perihal ON cashinout.id_perihal = perihal.id_perihal WHERE jenis='Pengeluaran'";
  //$laporan = mysqli_query($koneksi, "SELECT * FROM cashinout GROUP BY jenis");
}
$tanggal=$_GET['tanggal'];
$bulan=$_GET['bulan'];
$tahun = $_GET['tahun'];
$laporan1 = mysqli_query($koneksi, $query1);
$laporan2 = mysqli_query($koneksi, $query2);

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Laporan Keuangan</title>
  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <?php

  require 'sidebar.php';


  ?>

  <!-- Main Content -->
  <div id="content">

    <?php require 'navbar.php'; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: blue;">
          <h6 class="m-0 font-weight-bold text-primary">Download Laporan</h6>
        </div>
        <div class="card-body">
          <!-- <a class="btn btn-success btn-icon-split" target="__blank" href="#">
            <span class="icon text-white-50">
              <i class="fas fa-print"></i>
            </span>
            <span class="text">Cetak Data</span>
          </a><br><br> -->
          <form action="" method="get">
            <label>Pilih Berdasarkan</label>
            <select name="filter" id="filter">
              <option value="">Pilih</option>
              <option value="1">Tanggal</option>
              <option value="2">Bulan</option>
              <option value="3">Tahun</option>
            </select>

            <div id="form-tanggal" style="display:inline-flex;">
              <label>Tanggal</label>
              <input type="text" autocomplete="off" name="tanggal" id="input-tanggal1">
            </div>

            <div id="form-bulan" style="display: inline-table;">
              <label>Bulan</label>
              <select name="bulan">
                <option value="">Pilih</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
            </div>

            <div id="form-tahun" style="display: inline-table;">
              <label>Tahun</label>
              <select name="tahun">
                <option value="">Pilih</option>
                <?php
                foreach (mysqli_query($koneksi, "SELECT YEAR(tanggal) as tanggal_laporan from cashinout GROUP BY YEAR(tanggal) ORDER BY YEAR(tanggal)") as $data) {
                ?>
                  <option value="<?php echo $data['tanggal_laporan']; ?>"><?php echo $data['tanggal_laporan']; ?></option>
                <?php }
                ?>
              </select>
            </div>
            <br><br>
            <button type="submit" class="btn btn-outline-primary" id="tampil">Tampilkan</button>
            <a class="btn btn-outline-danger" href="laporan.php">Reset</a>
          </form>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Perihal</th>
                  <th>Jumlah Transaksi </th>
                  <th>Jumlah Total Uang</th>
                  <th>Download</th>
                </tr>
              </thead>
              <tfoot>
              </tfoot>
              <tbody>
                <?php
                $arraymasuk = [];
                $arraykeluar = [];

                foreach ($laporan1 as $row) {
                  $arraymasuk[] = $row['jumlah'];
                }
                $jumlahmasuk = array_sum($arraymasuk);
                foreach ($laporan2 as $row) {
                  $arraykeluar[] = $row['jumlah'];
                }
                $jumlahkeluar = array_sum($arraykeluar);


                // $pemasukan = mysqli_query($koneksi, "SELECT * FROM cashinout where jenis='Pemasukkan'");
                // while ($masuk = mysqli_fetch_array($laporan)) {
                //   $arraymasuk[] = $masuk['jumlah'];
                // }
                // $jumlahmasuk = array_sum($arraymasuk);

                // //$pengeluaran = mysqli_query($koneksi, "SELECT * FROM cashinout where jenis='Pengeluaran'");
                // while ($keluar = mysqli_fetch_array($laporan)) {
                //   $arraykeluar[] = $keluar['jumlah'];
                // }
                // $jumlahkeluar = array_sum($arraykeluar);

                // $query1 = mysqli_query($koneksi, $laporan);
                $query1 = mysqli_num_rows($laporan1);

                // $query2 = mysqli_query($koneksi, $laporan);
                $query2 = mysqli_num_rows($laporan2);
                $no = 1;
                ?>
                <tr>

                  <td>Pemasukan</td>
                  <td><?= $query1 ?></td>
                  <td>Rp. <?= number_format($jumlahmasuk, 2, ',', '.'); ?></td>
                  <td>
                    <!-- Button untuk modal -->
                    <form action="export-pemasukan.php" method="post">
                      <input type="hidden" value="<?=$tanggal;?>" name="tanggal">
                      <input type="hidden" value="<?=$bulan;?>" name="bulan">
                      <input type="hidden" value="<?=$tahun;?>" name="tahun">
                      <button type="submit" class="btn btn-primary btn-md">
                      <i class="fa fa-download"></i>
                      </button>
                      <!-- <a href="export-pemasukan.php" type="button" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a> -->
                    </form>
                  </td>
                </tr>

                <tr>
                  <td>Pengeluaran</td>
                  <td><?= $query2 ?></td>
                  <td>Rp. <?= number_format($jumlahkeluar, 2, ',', '.'); ?></td>
                  <td>
                    <!-- Button untuk modal -->
                    <form action="export-pengeluaran.php" method="post">
                      <input type="hidden" value="<?=$tanggal;?>" name="tanggal">
                      <input type="hidden" value="<?=$bulan;?>" name="bulan">
                      <input type="hidden" value="<?=$tahun;?>" name="tahun">
                      <button type="submit" class="btn btn-primary btn-md">
                      <i class="fa fa-download"></i>
                      </button>
                      <!-- <a href="export-pengeluaran.php" type="button" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a> -->
                    </form>
                  </td>
                </tr>


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  <?php require 'footer.php' ?>

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php require 'logout-modal.php'; ?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#input-tanggal1').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true
      });

      $('#form-tanggal, #form-bulan, #form-tahun').hide();
      $('#filter').change(function() {
        if ($(this).val() == '1') {
          $('#form-bulan, #form-tahun').hide();
          $('#form-tanggal').show();


        } else if ($(this).val() == '2') {
          $('#form-tanggal').hide();
          $('#form-bulan, #form-tahun').show();
        } else {
          $('#form-tanggal, #form-bulan').hide();
          $('#form-tahun').show();
        }

        $('#form-tanggal input, #form-bulan select, #form-tahun select').val('');
      })
    });
  </script>

</body>

</html>