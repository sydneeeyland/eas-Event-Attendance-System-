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

  <title>EAS | ATTENDANCE</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="#.php">EAS | ATTENDANCE</a>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <div class="input-group-append">
          </button>
        </div>
      </div>
    </form>


  </nav>

  <div id="wrapper">
    <div id="content-wrapper">
      <div class="container-fluid">

        <script type = "text/javascript">

        function reset()
        {
          var date = document.getElementById("dates");
          var time = document.getElementById("time");

          driver.value.reset();
          date.value.reset();
          custnum.value.reset();

        }

        </script>

        </head>

        <body>

        <form action = '' method = "post">
        <table id = "shortages" >
        <br>
        <h1 align="center"> TAP THE CARD INTO THE SCANNER </h1>
        <br>
        <br>
        <br>
        <input type = "text" id = "dates" size = "10" name = "dates" class="form-control" placeholder="TAP CARD HERE" autofocus>
        <div align="center" id="time" name="time"></div>
        <input type = "submit" value = "submit" name = "mydrivers" hidden>


        <?php

        function myfputcsv($handle, $array, $delimiter = ',', $enclosure = '"', $eol = "\n") {
            $return = fputcsv($handle, $array, $delimiter, $enclosure);
            if($return !== FALSE && "\n" != $eol && 0 === fseek($handle, -1, SEEK_CUR)) {
                fwrite($handle, $eol);
            }
            return $return;
        }

        if(isset($_POST['mydrivers']))  {
        $header=array();
        $data=array();
         foreach (array_slice($_POST,0,count($_POST)-1) as $key => $value) {
             //$header[]=$key;
             $data[]=$value;
         }
        $fp = fopen('attendance.csv', 'a+');
            //fputcsv($fp, $header);
            myfputcsv($fp, $data);
        fclose($fp);
        }

        ?>
        </form>

    </div>
      <!-- /.container-fluid -->


  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script type="text/javascript">
    setInterval(function (){
    $('#time').load('timestamp.php').fadeIn("slow");
    }, 1000); // refresh every 10000 milliseconds
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="assets/vendor/chart.js/Chart.min.js"></script>
  <script src="assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="assets/js/demo/datatables-demo.js"></script>
  <script src="assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>
