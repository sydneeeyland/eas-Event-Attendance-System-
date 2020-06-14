<?php
include("function.php");
$connect = mysqli_connect("localhost", "root", "", "eas");
$try = $_SESSION['username'];
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

  <title>EAS | ADVISER</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">

  <script src="assets/1.js"></script>




</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="#">EAS | MANAGE ACCOUNTS</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <div class="input-group-append">
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
          <a class="dropdown-item" href="facultyaccount.php">Account</a>
          <hr>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>


  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="facultyeduc.php">
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
          <h6 class="dropdown-header">MANAGE ACCOUNTS</h6>
          <a class="dropdown-item" href="facultymanageeduc.php">STUDENT OFFICER</a>
          <hr>
          <h6 class="dropdown-header">MANAGE ACTIVITY</h6>
          <a class="dropdown-item" href="facultyeventseduc.php">ACTIVITY LIST</a>
          <hr>
          <h6 class="dropdown-header">FINES</h6>
          <a class="dropdown-item" href="viewfineseduc.php">VIEW FINES</a>
          <hr>
        </div>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#.php">MANAGE </a>
          </li>
          <li class="breadcrumb-item active">STUDENT OFFICER</li>
        </ol>

        <!-- Page Content -->
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              STUDENT LIST</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>STUDENT NAME</th>
                      <th>YEAR LEVEL</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $dept = $row['department'];
                      $result = mysqli_query($connect,
                      "SELECT student.id, student.name, student.department, student.sem, student.year, student.year_level
                      FROM student,tmp
                      WHERE department='$dept'
                      AND tmp.sem = student.sem
                      AND tmp.year = student.year
                      ORDER BY student.year_level DESC");
                      while($row = mysqli_fetch_array($result))
                      {
                    ?>
                    <tr>
                         <td><?php echo $row["name"]; ?></td>
                         <td><?php echo $row["year_level"]; ?></td>
                         <td>
                           <input type="button" name="view" value="ASSIGN" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" />
                           <!--<input type="button" name="view" value="SET CARD" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-xs card_view" />-->
                        </td>
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


  <div id="dataModal" class="modal fade">
       <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">ASSIGN THIS STUDENT AS OFFICER?</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="employee_detail">
                 </div>
                 <div class="modal-body"><b><u><font color="red">REMINDER:</font></b></u><br> ASSIGNING DEPARTMENT OFFICER MEANS YOU ARE ALSO CREATING HIS/HER ACCOUBNT:<br><br><b><u><i>ID = Student_ID <br>Password = Birthdate</b></u></i></div>
                 <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">CANCEL</button>
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

  <div id="card_modal" class="modal fade">
       <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">ASSIGN CARD.</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="card_details">
                 </div>
                 <div class="modal-body"></div>
                 <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">CANCEL</button>
                   <input type="submit" class="btn btn-primary" value="Assign Card" name="card_assign"></a>
                 </form>
                 </div>
            </div>
       </div>
  </div>
  <script>
  $(document).ready(function(){
       $('.card_view').click(function(){
            var card_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{card_id:card_id},
                 success:function(data){
                      $('#card_details').html(data);
                      $('#card_modal').modal("show");
                 }
            });
       });
  });
  </script>

</script>

<script>
$(document).ready(function() {
  $('#dataTable').DataTable( {
      "order": [[ 1, "asc" ]]
  } );
} );
</script>

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
  <script src="assets/2.js"></script>
  <script src="assets/3.js"></script>

</body>

</html>
