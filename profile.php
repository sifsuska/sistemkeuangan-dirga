<?php
require 'cek-sesi.php';
//$query_user='SELECT * FROM kategori_user';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Kelola Admin</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <?php require 'koneksi.php'; ?>
  <?php require 'sidebar.php'; ?>
  <!-- Main Content -->
  <div id="content">

    <?php require 'navbar.php'; ?>
    <?php


    ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <?php
      if ($_SESSION['role'] == '1') {
        $lihat = 'visible';
      } else {
        $lihat = 'hidden';
      };
      ?>
      <button type="button" class="btn btn-success" style="margin:5px; visibility:<?= $lihat ?>" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"> Tambah Pengguna</i></button><br>


      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Kelola User</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Password</th>
                  <?php if ($_SESSION['role'] == '1') : ?>
                  <th>Aksi</th>
                  <?php endif;?>
                </tr>
              </thead>
              <tfoot>
              </tfoot>
              <tbody>
                <?php
                //$role = $_SESSION['role'];
                $id_user = $_SESSION['id'];

                if ($_SESSION['role'] == '1') {
                  $query = mysqli_query($koneksi, "SELECT * FROM user");
                } else {
                  $query = mysqli_query($koneksi, "SELECT * FROM user where id_user = '$id_user'");
                }
                while ($data = mysqli_fetch_assoc($query)) {
                ?>
                  <tr>
                    <td><?= $data['id_user'] ?></td>
                    <td><?= $data['nama_pengguna'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['pass'] ?></td>

                    <?php if ($_SESSION['role'] == '1') : ?>
                      <td>
                        <!-- Button untuk modal -->
                        <a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?php echo $data['id_user']; ?>"></a>
                      </td>
                    <?php endif; ?>
                  </tr>
                  <!-- Modal Edit -->
                  <div class="modal fade" id="myModal<?php echo $data['id_user']; ?>" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Ubah Data User</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form role="form" action="proses-edit-user.php" method="post">

                            <?php
                            $query_user = mysqli_query($koneksi, "SELECT * FROM kategori_user");
                            $id = $data['id_user'];
                            $query_edit = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");
                            //$result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($query_edit)) {
                            ?>


                              <input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">

                              <div class="form-group">
                                <label>ID</label>
                                <input type="text" name="id_user" class="form-control" value="<?php echo $row['id_user']; ?>" readonly>
                              </div>

                              <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value="<?php echo $row['nama_pengguna']; ?>">
                              </div>


                              <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                              </div>

                              <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Isi password jika ingin diganti, jika tidak biarkan kosong">
                                <input type="hidden" value="<?php echo $row['pass']; ?>" name="old_pass" class="form-control" autocomplete="off">
                              </div>
                              <?php if ($_SESSION['role'] == '1') : ?>

                                <select class="form-control" name="id_kategori">
                                  <option value="" disabled selected>Pilih kategori pengguna</option>
                                  <?php
                                  while ($exec = mysqli_fetch_assoc($query_user)) { ?>
                                    <option value="<?php echo $exec['id_kategori']; ?>" <?php echo ($exec['id_kategori'] == $row['id_kategori']) ? 'selected' : ''; ?>><?php echo $exec['kategori']; ?></option>
                                  <?php }

                                  ?>

                                  <!-- <option value="7">7. Hosting</option>
                              <option value="8">8. Listrik</option>
                              <option value="9">9. Air</option>
                              <option value="10">10. Wifi</option>  -->
                                </select>
                              <?php endif; ?>
                              <input type="hidden" name="old_id_kategori" value="<?php echo $row['id_kategori']; ?>">
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Ubah</button>
                                <a href="hapus-user.php?id_user=<?= $row['id_user']; ?>" onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">Hapus</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                              </div>
                            <?php
                            }
                            //mysql_close($host);
                            ?>

                          </form>
                        </div>
                      </div>

                    </div>
                  </div>



                  <!-- Modal -->
                  <div id="myModalTambah" class="modal fade" role="dialog">

                    <div class="modal-dialog">

                      <!-- konten modal-->
                      <div class="modal-content">
                        <!-- heading modal -->
                        <div class="modal-header">
                          <h4 class="modal-title">Tambah User</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- body modal -->
                        <form action="tambah-user.php" method="post">
                          <div class="modal-body">
                            Nama :
                            <input type="text" class="form-control" name="nama">
                            Email :
                            <input type="text" class="form-control" name="email">
                            Password :
                            <input type="password" class="form-control" name="pass">
                            Kategori Pengguna :
                            <select class="form-control" name="id_kategori">
                              <option value="" disabled selected>Pilih kategori pengguna</option>
                              <?php
                              $query_user = mysqli_query($koneksi, "SELECT * FROM kategori_user");
                              while ($exec = mysqli_fetch_assoc($query_user)) { ?>
                                <option value="<?php echo $exec['id_kategori']; ?>"><?php echo $exec['kategori']; ?></option>
                              <?php }

                              ?>
                              <!-- <option value="7">7. Hosting</option>
                              <option value="8">8. Listrik</option>
                              <option value="9">9. Air</option>
                              <option value="10">10. Wifi</option>  -->
                            </select>
                          </div>
                          <!-- footer modal -->
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                      </div>
                    </div>

                  </div>
          </div>


        <?php
                }
        ?>
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

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>