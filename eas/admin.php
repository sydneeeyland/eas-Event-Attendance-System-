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

    <a class="navbar-brand mr-1" href="admin.php">EAS | Dashboard</a>

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
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="adminaccount.php">Account</a>
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
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-12 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                </div>
                <div class="mr-5" align="center">Current Sem & S.Y:
                  <b><u>
                    <?php
                    $sql = "SELECT sem,year FROM tmp WHERE id='1' ";
                    $result = mysqli_query($db, $sql);
                    $row = $result->fetch_assoc();
                    echo $row['sem'];
                    echo " - ";
                    echo $row['year'];
                    ?>
                  </b></u>
                </div>
              </div>
            </div>
          </div>
        </div>

       <!-- SET CURRENT SEMESTER AND YEAR -->
       <div class="row">
         <div class="col-lg-4">
           <div class="card mb-3">
             <div class="card-header">
               <i class="fas fa-chart-bar"></i>
               Set Current Semester and School Year</div>
             <div class="card-body">
               <form class="semsy" method="POST">
                 <select class="form-control" name="setsem">
                   <option value="1st Semester">1st Semester</option>
                   <option value="2nd Semester">2nd Semester</option>
                 </select>
                 <br>
                 <select class="form-control" name="setyear">
                   <option value="2019-2020">2019 - 2020</option>
                   <option value="2020-2021">2020 - 2021</option>
                   <option value="2021-2022">2021 - 2022</option>
                   <option value="2022-2023">2022 - 2023</option>
                   <option value="2023-2024">2023 - 2024</option>
                   <option value="2024-2025">2024 - 2025</option>
                   <option value="2025-2026">2025 - 2026</option>
                   <option value="2026-2027">2026 - 2027</option>
                   <option value="2027-2028">2027 - 2028</option>
                   <option value="2028-2029">2028 - 2029</option>
                 </select>
                 <br>
                 <div align="right">
                 <input type="submit" name="setsy" class="btn btn-primary" value="&nbsp;&nbsp;SET&nbsp;&nbsp;">
               </form>
             </div>
           </div>
         </div>
        </div>
        <div class="col-lg-4">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-pie"></i>
              Numbers of Student in every Department</div>
            <div class="card-body">
              <canvas id="myPieChart" width="100%" height="100"></canvas>
            </div>
            <div class="card-footer small text-muted"><b><u>School Year 2019 - 2020</u></b></div>
          </div>
        </div>
         <div class="col-lg-4">
           <div class="card mb-3">
             <div class="card-header">
               <i class="fas fa-chart-pie"></i>
               Semester Remaining Days</div>
             <div class="card-body">
               <canvas id="myPieChart" width="100%" height="100"></canvas>
             </div>
             <div class="card-footer small text-muted"><b><u>School Year 2019 - 2020</u></b></div>
           </div>
         </div>
       </div>


      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © DWCC EAS 2019</span>
          </div>
        </div>
      </footer>

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
