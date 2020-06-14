<?php
include("function.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>EAS (Event Attendance System)</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
  <br>
  <div class="container">
    <div class="card card-login mx-auto mt-5">

    <div class="card-header" align="center">Divine Word College of Calapan<br>(Event Attendance System)</div>
    <br>
      <div align="center">
        <img src="img/dwcclogo.png">
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
              <input type="text" name="username" class="form-control" placeholder="ID Number">
          </div>
          <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="Password">
          </div>
          <input type="submit" class="btn btn-primary btn-block" value="LOGIN" name="login">
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
