<?php
include("function.php");
$page = $_SERVER['PHP_SELF'];
$sec = "15";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
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
  <script>
  var bleep = new Audio();
  bleep.src = 'bleep.mp3';
  </script>
  <style>
  input {
    text-align: center;
  }
  </style>

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
        </head>
        <body>

          <?php
          include("readcard.php");
          $db = mysqli_connect("localhost" , "root" , "" , "eas");
          date_default_timezone_set('Asia/Manila');
          $time = date("h:i:s");
          $date = date("Y-m-d");
          $mix = date("Y-m-d h:i:s");
          $time2 = time();

          $try = "SELECT COUNT(*) AS res FROM tmpevent WHERE department = 'ACCOUNTANCY' and tmpevent.id ='".$_SESSION['student_id_for_attendance']."' ";
          $tryres = mysqli_query($db,$try);
          while($row = mysqli_fetch_array($tryres))
          {
            $start = $row['res'];
            if($start == 0)
            {
              $month = date("F");
              echo "<div class='alert alert-warning'>";
              echo "<h1 align='center'>NO EVENT FOR TODAY</h1>";
              echo "</div>";
              echo "<h1 align='center'><div id='time'></div></h1>";
            }
            else {
              $sql ="SELECT * FROM tmpevent,tmpparticipants
              WHERE tmpevent.id = tmpparticipants.event_id AND department = 'ACCOUNTANCY' and tmpevent.id ='".$_SESSION['student_id_for_attendance']." LIMIT 1'
              AND DATE(`start_date`) = (SELECT MIN(DATE(`start_date`))
              FROM tmpevent
              WHERE DATE(NOW()) BETWEEN start_date AND end_date)";
                      $result = mysqli_query($db,$sql);
                      while($row = mysqli_fetch_array($result))
                      {
                        $start = $row['start_date'];
                        $end = $row['end_date'];
                        if(($date >= $start) && ($date <= $end))
                        {
                          error_reporting(0);
                          ini_set('display_errors', 0);
                          $first_start = $row['start_time'];
                          $first_end = $row['end_time'];
                          $first_eqv = $row['eqv_first'];
                          $second_start = $row['second_start'];
                          $second_end = $row['second_end'];
                          $second_eqv = $row['eqv_second'];
                          $third_start = $row['third_start'];
                          $third_end = $row['third_end'];
                          $third_eqv = $row['eqv_third'];
                          $fourth_start = $row['fourth_start'];
                          $fourth_end = $row['fourth_end'];
                          $fourth_eqv = $row['eqv_fourth'];
                          $name = $row["name"];
                          $id = $row['event_id'];
                          $first = $row['first_p'];
                          $second = $row['second_p'];
                          $third = $row['third_p'];
                          $fourth = $row['fourth_p'];
                          $eventid = $row['event_id'];
                          $endTime = strtotime("+1 minutes", strtotime($first_end));
                          $rem = strtotime("+1 minutes", strtotime($time));
                          $checktime = date('h:i:s', $endTime);


                          //$totaleqv = ($first_eqv + $second_eqv + $third_eqv + $fourth_eqv);

                            if($time >= $first_start && $time <= $first_end ||
                            $time >= $second_start && $time <= $second_end ||
                            $time >= $third_start && $time <= $third_end ||
                            $time >= $fourth_start && $time <= $fourth_end)
                            {
                              echo "<br>";
                              echo "<form method='POST'>";
                              echo "<h1 align='center'> TAP CARD INTO THE SCANNER </h1>";
                              echo "<input type = 'password' id = 'readcard' size = '10' name = 'readcard' class='form-control' placeholder='YOUR CARD IDENTIFIER' autofocus>";
                              echo "<input type='text' value='1'  class='form-control' name='attended' hidden>";
                              echo "<br>";
                              echo "<input onmousedown='bleep.play()' type='submit' name='accountancy' hidden>";
                              echo "<input type='text' name='event_name' value='$name' hidden>";
                              echo "<input type='text' name='start' value='$start' hidden>";
                              echo "<input type='text' name='end' value='$end' hidden>";
                              echo "<input type='text' name='event_id' value='$id' hidden>";
                              echo "<input type='text' name='first_p' value='$first' hidden>";
                              echo "<input type='text' name='second_p' value='$second' hidden>";
                              echo "<input type='text' name='third_p' value='$third' hidden>";
                              echo "<input type='text' name='fourth_p' value='$fourth' hidden>";
                              //echo "<input type='text' name='equivalent' value='$totaleqv'>";
                              echo "</form>";
                              echo "<div class='alert alert-danger'>";
                              echo "<h1 align='center'><div id='clock'></div></h1>";
                              echo "<h4 align='center'>Date Today: ".$date."</h4>";
                              echo "</div>";

                            }
                            else if($time >= $first_end && $time <= $checktime)
                            {
                              $flag = 0;
                              $sqlrem = "DELETE FROM tmpevent WHERE id = '".$eventid."'";
                              $sqlrem2 = "DELETE FROM tmpsched WHERE id = '".$eventid."'";
                              $sqlrem3 = "DELETE FROM tmpeqv WHERE id = '".$eventid."'";
                              $sql2 = "DELETE FROM tmpparticipants WHERE event_id = '$eventid'";
                              $sql3 = "UPDATE events SET flag = '".$flag."' WHERE id ='$eventid'";
                              $result3 = mysqli_query($db, $sql3);
                              $result2 = mysqli_query($db, $sql2);
                              $resultrem = mysqli_query($db, $sqlrem);
                              $resultrem2 = mysqli_query($db, $sqlrem2);
                              $resultrem3 = mysqli_query($db, $sqlrem3);
                            }
                            else {
                              echo "<div class='alert alert-danger'>";
                              echo "<h1 align='center'>ATTENDANCE IS NOT YET OPEN</h1>";
                              echo "</div>";
                              echo "<h1 align='center'><div id='time'></div></h1>";
                              echo "<h4 align='center'>Date Today: ".$date."</h4>";
                            }
                          }
                          else if($date != $start) {
                            echo "<div class='alert alert-warning'>";
                            echo "<h1 align='center'>NO EVENT FOR TODAY</h1>";
                            echo "</div>";
                            echo "<h1 align='center'><div id='time'></div></h1>";
                          }
                        }
                      }
                    }


          ?>
          <br>
          <br>

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
  <script type="text/javascript">
    setInterval(function (){
    $('#clock').load('timestamp.php').fadeIn("slow");
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
