	<?php
	error_reporting(0);
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data_Pemasukan.xls");
	?>
	<h3>Data Pemasukan</h3>
	<table border="1" cellpadding="5">
		<tr>
			<th>ID Pemasukan</th>
			<th>Tgl Pemasukan</th>
			<th>Jumlah</th>
			<th>Sumber Dana</th>
		</tr>
		<?php
		// Load file koneksi.php  
		include "koneksi.php";
		// include "laporan.php";
		// Buat query untuk menampilkan semua data siswa 
		$tanggal = $_POST['tanggal'];
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$laporan = "";
		if (!empty($_POST['tanggal'])) {
			#$tanggal = $_POST['tanggal'];
			$query_report = "SELECT cashinout.*, perihal.id_perihal as id_perihal, perihal.keterangan as keterangan FROM cashinout JOIN perihal ON cashinout.id_perihal = perihal.id_perihal WHERE DATE(tanggal)='$tanggal' AND jenis='Pemasukkan'";
		} else if (!empty($_POST['bulan']) && $_POST['tahun']) {
			#$bulan = $_POST['bulan'];
			#$tahun = $_POST['tahun'];
			$query_report = "SELECT cashinout.*, perihal.id_perihal as id_perihal, perihal.keterangan as keterangan FROM cashinout JOIN perihal ON cashinout.id_perihal = perihal.id_perihal WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND jenis='Pemasukkan'";
		} else if (!empty($_POST['tahun'])) {
			#$tahun = $_POST['tahun'];
			$query_report = "SELECT cashinout.*, perihal.id_perihal as id_perihal, perihal.keterangan as keterangan FROM cashinout JOIN perihal ON cashinout.id_perihal = perihal.id_perihal WHERE YEAR(tanggal)='$tahun' AND jenis='Pemasukkan'";
		} else {
			$query_report = "SELECT cashinout.*, perihal.id_perihal as id_perihal, perihal.keterangan as keterangan FROM cashinout JOIN perihal ON cashinout.id_perihal = perihal.id_perihal WHERE jenis='Pemasukkan'";
		}

		$laporan = mysqli_query($koneksi, $query_report);

		if (isset($laporan)) {

			// $report = mysqli_query($koneksi, $laporan);
			// Untuk penomoran tabel, di awal set dengan 1 
			while ($data = mysqli_fetch_array($laporan)) {
				// Ambil semua data dari hasil eksekusi $sql 
				echo "<tr>";
				echo "<td>" . $data['id_cashinout'] . "</td>";
				echo "<td>" . $data['tanggal'] . "</td>";
				echo "<td>" . $data['jumlah'] . "</td>";
				echo "<td>" . $data['keterangan'] . "</td>";

				echo "</tr>";
			}
		}

		?>
	</table>