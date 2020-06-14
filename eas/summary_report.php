<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title> </title>

<script src="assets/2.js"></script>
<script src="assets/3.js"></script>

<!-- Custom fonts for this template-->
<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="assets/css/sb-admin.css" rel="stylesheet">

<script src="assets/1.js"></script>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>

<div class="modal-body" id="print_summary_details">
<?php
//ini_set('error_reporting', 0);
//ini_set('display_errors', 0);

include("function.php");
$db = mysqli_connect("localhost" , "root" , "" , "eas");


$dept=$_SESSION['dep'];


if($dept==1)
{
$dept='COMPUTER STUDIES';
}
else if ($dept==2) {
$dept='AB';
}
else if ($dept==3) {
$dept='ACCOUNTANCY';
}
else if ($dept==4) {
$dept='BUSINESS AND HOSPITALITY MANAGEMENT';
}
else if ($dept==5) {
$dept='EDUCATION';
}
else if ($dept==6) {
$dept='ENGINEERING';
}
  $result = mysqli_query($db,"SELECT `stud_id`, `stud_name`, `stud_department`, `year_level`, `Deficiency`, round(`Percentage`,0) as Percentage , `School Year`
FROM `student_summary_attendance_per_year`
  WHERE stud_department='".$dept."' and `School Year`='2019-2020' ORDER BY `student_summary_attendance_per_year`.`year_level` ASC");
    echo "<div id='printdiv'>";
    echo "<div id='hidden_div'>";
    echo "<table class='table table-bordered' id=''>";
    echo "<thead class='text-capitalize' align='center'>";
    echo "<tr >";
    echo "<th colspan='4' div style='color:red'>PLEASE BASE YOUR EQUIVALENT CONSEQUENCE WITH YOUR PERCENTAGE</th>";
    echo "<h4 class='modal-title' id='exampleModalLabel' align='center' style='color:'>$dept</h4>";
    echo "</tr>";
    echo "<tr>";
    echo "<th width='18%'>STUDENT NAME</th>";
    echo "<th width='18%'>YEAR</th>";
    echo "<th width='18%'>DEFICIENCY</th>";
    echo "<th width='18%'>PERCENTAGE</th>";
    echo "</tr>";
    echo "</thead>";
    while($row = mysqli_fetch_array($result))
    {
    echo "<tbody align='center'>";
    echo "<tr>";
    echo "<td>" . $row['stud_name'] . "</td>";
    echo "<td>" . $row['year_level'] . "</td>";
    echo "<td>" . $row['Deficiency'] . "</td>";
    echo "<td>" . $row['Percentage'] . "%</td>";
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
