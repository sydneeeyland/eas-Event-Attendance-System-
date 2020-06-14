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

  <title>EAS | Admin</title>
  <script src="assets/2.js"></script>
  <script src="assets/3.js"></script>

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

    <a class="navbar-brand mr-1" href="#">EAS | Manage Accounts</a>

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
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#">Account</a>
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
        <a class="nav-link" href="admin.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Manage </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Import List</h6>
          <a class="dropdown-item" href="adminstudlist.php">Student List</a>
          <hr>
          <h6 class="dropdown-header">Manage Accounts</h6>
          <a class="dropdown-item" href="adminmanage.php">Faculty Accounts</a>
        </div>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="adminimport.php">Manage </a>
          </li>
          <li class="breadcrumb-item active">Faculty Accounts</li>
        </ol>

        <!-- Page Content -->

        <!-- Import File -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-bar"></i>
                  Import Faculty List</div>
                <div class="card-body">
                  <form method="POST" enctype='multipart/form-data'>
                    <input type="file" name="importfac">
                    <div align="right">
                    <input type="submit" name="uploadfac" class="btn btn-primary" value="&nbsp;&nbsp;Import List&nbsp;&nbsp;">
                  </form>
                </div>
              </div>
            </div>
           </div>
           <div class="col-lg-6">
             <div class="card mb-3">
               <div class="card-header">
                 <i class="fas fa-table"></i>
                 Adviser List</div>
               <div class="card-body">
                 <div class="table-responsive">
                   <table width="100%" cellspacing="0">
                     <thead>
                       <tr>
                         <th>Faculty Name</th>
                         <th>Department</th>
                         <th>Action</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php
                       $connect = mysqli_connect("localhost", "root", "", "eas");
                       $query = "SELECT * FROM tmpadv";
                       $result = mysqli_query($connect, $query);
                       while($row = mysqli_fetch_array($result))
                       {
                       ?>
                       <tr>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["department"]; ?></td>
                            <td><input type="button" name="view" value="View" id="<?php echo $row["id"]; ?>" class="btn btn-primary btn-xs tmpadv_view" /></td>
                       </tr>
                       <?php
                       }
                       ?>
                     </tbody>
                   </table>
                 </div>
               </div>
             </div>
           </div>
          </div>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Faculty List</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Faculty Name</th>
                      <th>Department</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $connect = mysqli_connect("localhost", "root", "", "eas");
                    $query = "SELECT * FROM faculty";
                    $result = mysqli_query($connect, $query);
                    while($row = mysqli_fetch_array($result))
                    {
                    ?>
                    <tr>
                         <td><?php echo $row["name"]; ?></td>
                         <td><?php echo $row["department"]; ?></td>
                         <td><input type="button" name="view" value="Assign" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" /></td>
                    </tr>
                    <?php
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

  <div id="tmpadv" class="modal fade">
       <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Unassigned This Faculty?</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="tmpadv_detail">
                 </div>
                 <div class="modal-body"><b><u><font color="red">REMINDER:</font></b></u><br>Unassining Adviser means you are also revoking his/her account <br><br><b><u><i><br></b></u></i></div>
                 <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <input type="submit" value="Revoke" class="btn btn-danger" name="tmpadv_revoke"></a>
                 </form>
                 </div>
            </div>
       </div>
  </div>
  <script>
  $(document).ready(function(){
       $('.tmpadv_view').click(function(){
            var tmpadv_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{tmpadv_id:tmpadv_id},
                 success:function(data){
                      $('#tmpadv_detail').html(data);
                      $('#tmpadv').modal("show");
                 }
            });
       });
  });
  </script>

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
                   <h5 class="modal-title" id="exampleModalLabel">Assign this as Faculty Adviser?</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="employee_detail">
                 </div>
                 <div class="modal-body"><b><u><font color="red">REMINDER:</font></b></u><br> Assigning Department Adviser means you are also creating his/her Account using the Following:<br><br><b><u><i>ID = Employee_ID <br>Password = Birthdate</b></u></i></div>
                 <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <input type="submit" value="Assign" class="btn btn-primary" name="assignfac"></a>
                 </form>
                 </div>
            </div>
       </div>
  </div>
  <script>
  $(document).ready(function(){
       $('.view_data').click(function(){
            var employee_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{employee_id:employee_id},
                 success:function(data){
                      $('#employee_detail').html(data);
                      $('#dataModal').modal("show");
                 }
            });
       });
  });
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


</body>

</html>
