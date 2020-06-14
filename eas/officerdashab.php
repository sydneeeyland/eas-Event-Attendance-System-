<?php
include("function.php");

$connect = mysqli_connect("localhost", "root", "", "eas");
$try = $_SESSION['username'];
//$query = "SELECT * FROM student WHERE id = '".$try."'";
//$result = mysqli_query($connect, $query);
$query = mysqli_query($connect, "SELECT department,name FROM accounts WHERE id = '".$try."'");
while($row = mysqli_fetch_array($query))
{
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>EAS | OFFICER</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">

  <script src="assets/1.js"></script>
  <style>
  #mydiv {
  position: absolute;
  z-index: 9;
  background-color: #f1f1f1;
  border: 1px solid #d3d3d3;
  text-align: center;
}

#mydivheader {
  padding: 10px;
  cursor: move;
  z-index: 10;
  background-color: #2196F3;
  color: #fff;
}
  </style>



</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="#.php">EAS | DASHBOARD</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <div class="input-group-append">
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <p style="color:white;"><?php echo $row['name']; ?></p>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="officeraccount.php">Account</a>
          <hr>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>


  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="officerdashab.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>DASHBOARD</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>MANAGE</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">STUDENT LIST</h6>
          <a class="dropdown-item" href="officersetcardab.php">REGISTER CARD</a>
          <hr>
          <h6 class="dropdown-header">MANAGE ACTIVITIES</h6>
          <a class="dropdown-item" href="officerab.php">ACTIVITY LIST</a>
          <hr>
          <h6 class="dropdown-header">ATTENDANCE</h6>
          <a class="dropdown-item" href="catchab.php">CHECK ATTENDANCE</a>
          <hr>
          <h6 class="dropdown-header">FINES</h6>
          <a class="dropdown-item" href="viewfinesab.php">VIEW FINES</a>
        </div>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">DASHBOARD</a>
          </li>
          <li class="breadcrumb-item active">OVERVIEW</li>
        </ol>
       <!-- SET CURRENT SEMESTER AND YEAR -->
       <div class="row">

         <div class="col-lg-6">
           <div class="alert alert-primary">
           <div class="card mb-3">
             <div class="card-header">
               <i class="fas fa-table"></i>
               DEPARTMENT OFFICERS</div>
             <div class="card-body">
               <div class="table-responsive">
                 <table width="100%" cellspacing="0">
                   <thead>
                     <tr>
                       <th width="60%">OFFICER NAME</th>
                       <th width="30%">POSITION</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                       $dept = $row['department'];
                       $result = mysqli_query($connect,"SELECT * FROM tmpoff WHERE department='$dept'");
                       while($row = mysqli_fetch_array($result))
                       {
                     ?>
                     <tr>
                          <td><?php echo $row["name"]; ?></td>
                          <td><?php echo $row["pos"]; ?></td>
                     </tr>
                     <?php
                     }
                   }
                     ?>
                   </tbody>
                 </table>
               </div>
             </div>
           </div>
         </div>
       </div>

         <div class="col-lg-6">
           <div class="alert alert-primary">
           <div class="card mb-3">
             <div class="card-header">
               <i class="fas fa-chart-pie"></i>
               A</div>
             <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="20"></canvas>
             </div>
             <div class="card-footer small text-muted"><b><u>School Year #</u></b></div>
           </div>
         </div>
       </div>

     <!-- DataTables Example -->
         <div class="col-lg-6">
           <div class="alert alert-primary">
           <div class="card mb-3">
             <div class="card-header">
               <i class="fas fa-chart-pie"></i>
               NUMBER OF STUDENTS ENROLLED</div>
             <div class="card-body">
               <?php
                $connect = mysqli_connect("localhost", "root", "", "eas");
                $query = "SELECT count(*) AS total FROM student WHERE department='AB'";
                $result = mysqli_query($connect, $query);
                ?>
               <div id="piechart" style="width: 600px; height: 300px;"></div>
             </div>
             <div class="card-footer small text-muted">
               <b>School Year: <u>
                 <?php
                 $checkyear = "SELECT year FROM tmp";
                 $resultcheck = mysqli_query($db,$checkyear);
                 while($row = mysqli_fetch_array($resultcheck))
                 {
                 echo $row['year'];
                 }
                 ?>
              </u></b></div>
           </div>
         </div>
        </div>

      </div>
    </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form method="POST">
          <input type="submit" value="LOGOUT" class="btn btn-primary" name="logout"></a>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="officerlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form method="POST">
          <input type="submit" value="LOGOUT" class="btn btn-primary" name="logout"></a>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="tmpoff" class="modal fade">
       <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Unassigned This Faculty?</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="tmpoff_detail">
                 </div>
                 <div class="modal-body"><b><u><font color="red">REMINDER:</font></b></u><br>Unassining Adviser means you are also revoking his/her account <br><br><b><u><i><br></b></u></i></div>
                 <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <input type="submit" value="Revoke" class="btn btn-danger" name="tmpoff_revoke"></a>
                 </form>
                 </div>
            </div>
       </div>
  </div>
  <script>
  $(document).ready(function(){
       $('.tmpoff_view').click(function(){
            var tmpoff_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{tmpoff_id:tmpoff_id},
                 success:function(data){
                      $('#tmpoff_detail').html(data);
                      $('#tmpoff').modal("show");
                 }
            });
       });
  });
  </script>

  <div id="dataModal" class="modal fade">
       <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Assign this student as Department Officer?</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="employee_detail">
                 </div>
                 <div class="modal-body"><b><u><font color="red">REMINDER:</font></b></u><br> Assigning Department Officer means you are also creating his/her Account using the Following:<br><br><b><u><i>ID = Student_ID <br>Password = Birthdate</b></u></i></div>
                 <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <input type="submit" class="btn btn-primary" name="assignofficer"></a>
                 </form>
                 </div>
            </div>
       </div>
  </div>
  <script>
  $(document).ready(function(){
       $('.view_data').click(function(){
            var student_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{student_id:student_id},
                 success:function(data){
                      $('#employee_detail').html(data);
                      $('#dataModal').modal("show");
                 }
            });
       });
  });
  </script>

  <script>
  // Make the DIV element draggable:
dragElement(document.getElementById("mydiv"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    // if present, the header is where you move the DIV from:
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    // otherwise, move the DIV from anywhere inside the DIV:
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}

  </script>

  <script type="text/javascript" src="assets/js/loader.js"></script>
  <script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart()
  {
       var data = google.visualization.arrayToDataTable([
                 ['Gender', 'Number'],
                 <?php
                 while($row = mysqli_fetch_array($result))
                 {
                      echo "['".$row["total"]."', ".$row["total"]."],";
                 }
                 ?>
            ]);
       var options = {
             //is3D:true,
             pieHole: 0.4
            };
       var chart = new google.visualization.PieChart(document.getElementById('piechart'));
       chart.draw(data, options);
  }
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
  <script src="assets/js/demo/chart-area-demo.js"></script>
  <script src="assets/js/demo/datatables-demo.js"></script>

  <script src="assets/2.js"></script>
  <script src="assets/3.js"></script>


</body>

</html>
