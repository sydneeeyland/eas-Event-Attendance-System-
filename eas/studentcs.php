<?php
include("function.php");
date_default_timezone_set('Asia/Manila');
$connect = mysqli_connect("localhost", "root", "", "eas");
$try = $_SESSION['username'];
$time = date("h:i:s");
$date = date("Y-m-d");
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

  <title>EAS | VIEW FINES</title>

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

    <a class="navbar-brand mr-1" href="#">EAS | VIEW FINES</a>

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
          <p style="color:white;"><?php echo $row['name']; }?></p>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="facultyaccount.php">Account</a>
          <hr>
          <a class="dropdown-item" href="index.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>


  </nav>

  <div id="wrapper">

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Page Content -->
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <div class="alert alert-info">
                    <h4 class='modal-title' id='exampleModalLabel' align='center' style='color:'>COMPUTER STUDIES</h4>
                  </div>
                  <thead align='center'>
                    <tr>
                      <th>EVENT NAME</td>
                      <th>FINES</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody align='center'>
                    <?php
                    $connect = mysqli_connect("localhost", "root", "", "eas");
                      $result = mysqli_query($connect,"SELECT * FROM events WHERE department = 'COMPUTER STUDIES' AND id NOT IN (SELECT event_id FROM attendance WHERE stud_id = '".$try."')");
                      while($row = mysqli_fetch_array($result))
                      {
                        $name = $row['name'];
                        $fine = $row['eqv'];
                    ?>
                    <tr>
                         <td><?php echo $row["name"]; ?></td>
                         <td><?php echo $row['eqv']; ?></td>
                         <td><input type="button" name="view" value="MY FINES" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_fines" /></td>
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


  <div id="finesmodal" class="modal fade">
       <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">STUDENT FINES</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="finesdetail">
                 </div>
                 <div class="modal-footer">
                 </form>
                 </div>
            </div>
       </div>
  </div>
  <script>
  $(document).ready(function(){
       $('.view_fines').click(function(){
            var fines_id_cs = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{fines_id_cs:fines_id_cs},
                 success:function(data){
                      $('#finesdetail').html(data);
                      $('#finesmodal').modal("show");
                 }
            });
       });
  });
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
