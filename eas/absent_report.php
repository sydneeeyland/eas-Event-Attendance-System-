<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>EAS | Attendance Report</title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

<!-- Custom fonts for this template-->
<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="assets/css/sb-admin.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<div class="modal-body" id="attendance_details">
<?php
//ini_set('error_reporting', 0);
//ini_set('display_errors', 0);
include("function.php");
$db = mysqli_connect("localhost" , "root" , "" , "eas");
$try = $_SESSION['username'];
$id = $_POST['event_id'];
  $results = mysqli_query($db, "SELECT * FROM accounts WHERE id ='$try'");
  while ($row = mysqli_fetch_array($results))
  {
  $dept = $row['department'];
  $result = mysqli_query($db,"SELECT student.id, student.name FROM student WHERE department = '$dept' AND NOT EXISTS (SELECT attendance.stud_id FROM attendance WHERE student.id = attendance.stud_id AND event_id = 1)");
    echo "<div id='printdiv'>";
    echo "<div id='hidden_div'>";
    echo "<table class='table table-bordered' id=''>";
    echo "<thead class='text-capitalize' align='center'>";
    echo "<tr>";
    echo "<th width='18%'>Student ID</th>";
    echo "<th width='18%'>Student Name</th>";
    echo "</tr>";
    echo "</thead>";
    while($row = mysqli_fetch_array($result))
    {
    echo "<tbody align='center'>";
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "</tr>";
    echo "</tbody>";
    }
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "<script type='text/javascript'>";
    echo "window.print();";
    echo "</script>";
    echo "<script>";
    echo "function openWin() {
      window.open('function.php');
    }
    </script>";
  }



?>
</div>

<!-- Bootstrap core JavaScript-->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="assets/js/demo/datatables-demo.js"></script>

<!-- Page level plugin JavaScript-->
<script src="assets/vendor/datatables/jquery.dataTables.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script>
