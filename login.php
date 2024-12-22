<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background-image: url(img/Kantor.jpeg);">

  <div class="container">
     <?php
    
    //  echo ucwords(sha1($pass));
    // if(isset($_POST['submit'])) {
    // $email = trim(mysqli_real_escape_string($koneksi, $_POST['email']));
    // $pass = sha1(trim(mysqli_real_escape_string($koneksi, $_POST['pass'])));
    // echo $pass;
    // $sql_login = mysqli_query($koneksi, "SELECT * FROM user WHERE email ='$email' AND password = '$pass'") or die (mysqli_error($koneksi));
 // }
  ?>

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-6 col-md-4">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <!-- Nested Row within Card Body -->

                <div class="p-5">
                  <div class="text-center">
                    <img src="img/logo.jpg"alt="" class="img-fluid" style="width: 40%;">
                    <h1 class="h5 text-gray-1000 mb-1 mt-1" ><mark><p>SELAMAT DATANG DI</p>
                      <p>SISTEM INFORMASI KEUANGAN</p>
                      <p> SMP NEGERI 3 BANGKINANG</p></h1>
                  </div>
                  <form class="user" action="proses-login.php" method="post">
                    <div class="form-group mt-1">
                      <input type="text" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Type your Email...">
                    </div>
                    <div class="form-group">
                      <input type="password" name="pass" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password..">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Ingat akun</label>
                      </div>
                    </div>
                    <input type="submit" name="submit" class="btn btn-danger btn-user btn-block" value="Masuk">
                  </form>
                  <hr>
                </div>

          </div>
      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
