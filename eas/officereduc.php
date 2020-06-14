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
  <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>EAS | OFFICER</title>

  <script src="assets/2.js"></script>
  <script src="assets/3.js"></script>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">

  <script src="assets/1.js"></script>
  <style>
  input[type="file"]{
    color: transparent;
  }
  </style>


</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="#">EAS | MANAGE ACTIVITIES</a>

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
          <p style="color:white;"><?php echo $row['name']; }?></p>
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
      <li class="nav-item">
        <a class="nav-link" href="officerdasheduc.php">
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
          <a class="dropdown-item" href="officersetcardeduc.php">REGISTER CARD</a>
          <hr>
          <h6 class="dropdown-header">MANAGE ACTIVITIES</h6>
          <a class="dropdown-item" href="officereduc.php">ACTIVITY LIST</a>
          <hr>
          <h6 class="dropdown-header">FINES</h6>
          <a class="dropdown-item" href="viewfineseduc.php">VIEW FINES</a>
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
          <li class="breadcrumb-item active">DEPARTMENT ACTIVITIES</li>
        </ol>

        <!-- Page Content -->

        <!-- Import File -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-2">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-bar"></i>
                  ADD ACTIVITY</div>
                <div class="card-body">
                  <div align="center">
                  <button class="btn btn-primary" value="&nbsp;&nbsp;Add Event&nbsp;&nbsp;" data-toggle="modal" data-target="#addmodal">ADD ACTIVITY</button>
                  <br>
                  <br>
                  <form method="POST" enctype='multipart/form-data'>
                    <input type="file" name="eventlist">
                    <input type="submit" name="uploadevent" class="btn btn-primary" value="IMPORT LIST">
                  </form>
                 </div>
                </div>
              </div>
            </div>
            <div class="col-lg-10">
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-table"></i>
                  CURRENTLY SET ACTIVITY FOR ATTENDANCE</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table width="100%" cellspacing="0">
                      <thead align="center">
                        <tr>
                          <th>ACTIVITY NAME</th>
                          <th>ACTIVITY DATE</th>
                          <th width="40%">ACTION</th>
                        </tr>
                      </thead>
                      <tbody align="center">
                        <?php
                        $connect = mysqli_connect("localhost", "root", "", "eas");
                        $try = $_SESSION['username'];
                        //$query = "SELECT * FROM student WHERE id = '".$try."'";
                        //$result = mysqli_query($connect, $query);
                        $query = mysqli_query($connect, "SELECT department FROM accounts WHERE id = '".$try."'");
                        while($row = mysqli_fetch_array($query))
                        {
                          $dept = $row['department'];
                          $result = mysqli_query($connect,"SELECT * FROM tmpevent WHERE department='$dept' ORDER BY id asc");
                          while($row = mysqli_fetch_array($result))
                          {
                            error_reporting(0);
                            ini_set('display_errors', 0);
                            $start = $row['start_date'];
                            $end = $row['end_date'];
                            $check_attendance_button_status="";
                            $event_id=$row["id"];
                        ?>
                        <tr>

                             <td><?php echo strtoupper($row["name"]); ?></td>
                             <td><?php echo strtoupper($row["start_date"]);?></td>
                             <td >
                               <button name="view" value="UNSET" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs event_unset_view">&nbsp;&nbsp;<i class="fas fa-times"></i>&nbsp;&nbsp;</button>
                               <button name="view" value="DETAILS" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs events_view ">&nbsp;&nbsp;&nbsp;<i class="fas fa-info"></i>&nbsp;&nbsp;&nbsp;</button>
                               <button name="view" value="SET TIME" id="<?php echo $row["id"]; ?>" class="btn btn-primary btn-xs set_time_view ">&nbsp;&nbsp;<i class="fas fa-cog"></i>&nbsp;&nbsp;</button>
                               <input type="button" name="view" value="CHECK ATTENDANCE" id="<?php echo $row["id"]; ?>" class="btn btn-success btn-xs check_attendance"<?php


                               if($date >= $start && $date <= $end){
                                 $sql4 = "SELECT cast(substring(first_start,1,2) as int) as first_start,
                                 cast(substring(first_end,1,2) as int) as first_end ,
                                 cast(substring(second_start,1,2) as int) as second_start,
                                 cast(substring(second_end,1,2) as int) as second_end,
                                 cast(substring(third_start,1,2) as int) as third_start,
                                 cast(substring(third_end,1,2) as int) as third_end,
                                 cast(substring(fourth_start,1,2) as int) as fourth_start,
                                 cast(substring(fourth_end,1,2) as int) as fourth_end FROM tmpsched
                                 WHERE id ='".$event_id."' ";
                                 $result4 = mysqli_query($connect, $sql4);

                                 while($row = mysqli_fetch_array($result4)){
                                   $first_start1 = $row['first_start'];
                                   $first_end2 = $row['first_end'];
                                   $second_start1 = $row['second_start'];
                                   $second_end2 = $row['second_end'];
                                   $third_start1 = $row['third_start'];
                                   $third_end2 = $row['third_end'];
                                   $fourth_start1 = $row['fourth_start'];
                                   $fourth_end2 = $row['fourth_end'];

                                   $sql6 = "SELECT
                                   concat(cast(substring(first_start,1,2) as int),'00') as first_start,
                                   concat(cast(substring(first_end,1,2) as int),'00') as first_end ,
                                   concat(cast(substring(second_start,1,2) as int),'00') as second_start,
                                   concat(cast(substring(second_end,1,2) as int),'00') as second_end,
                                   concat(cast(substring(third_start,1,2) as int),'00') as third_start,
                                   concat(cast(substring(third_end,1,2) as int),'00') as third_end,
                                   concat(cast(substring(fourth_start,1,2) as int),'00') as fourth_start,
                                   concat(cast(substring(fourth_end,1,2) as int),'00') as fourth_end FROM tmpsched
                                   WHERE id ='".$event_id."' ";
                                   $result6 = mysqli_query($connect, $sql6);

                                   while($row = mysqli_fetch_array($result6)){
                                     $first_starta = $row['first_start'];
                                     $first_endb = $row['first_end'];
                                     $second_starta = $row['second_start'];
                                     $second_endb = $row['second_end'];
                                     $third_starta = $row['third_start'];
                                     $third_endb = $row['third_end'];
                                     $fourth_starta = $row['fourth_start'];
                                     $fourth_endb = $row['fourth_end'];

                                     $time2= sprintf("%s%s",substr($time,0,2),  substr($time,3,2) );

                                     $time3=(int)$time2;

                                       if(($time3 >= $first_starta and $time3 <= $first_endb) ||
                                       ($time3 >= $second_starta and $time3 <= $second_endb)||
                                       ($time3 >= $third_starta and $time3 <= $third_endb)||
                                       ($time3 >= $fourth_starta and $time3 <= $fourth_endb))
                                       {
                                           echo "";
                                       }
                                       else {

                                           echo "disabled";
                                       }
                                   }
                               }
                           }
                               else {
                                   echo "disabled";
                               }
                                ?>/>

                              <!-- <button name="view" value="CHECK ATTENDANCE" id="< ?php echo $row["id"];  ?> " class="btn btn-primary btn-xs check_attendance"></button>
                               <!<input type="button" name="view" value="SET ATTENDEE" id="< ?php echo $row["id"]; ?>" class="btn btn-primary btn-xs set_part_view " />-->
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
            <table width="100%" cellspacing="0">
                <tbody align="right">
                    <tr>
                        <td>
                        </td>
                        <td>
                          <input type="button" name="print_summary" value="PRINT ATTENDANCE SUMMARY" id="5" class="btn btn-primary btn-xs print_summary_view"/>
                        </td>
                    </tr>
                </tbody>
              </table>
           </div>
          </div>



          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              EVENT LIST</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="40%">EVENT NAME</th>
                      <th width="30%">ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $connect = mysqli_connect("localhost", "root", "", "eas");
                    $try = $_SESSION['username'];
                    //$query = "SELECT * FROM student WHERE id = '".$try."'";
                    //$result = mysqli_query($connect, $query);
                    $query = mysqli_query($connect, "SELECT department,name FROM accounts WHERE id = '".$try."'");
                    while($row = mysqli_fetch_array($query))
                    {
                      $dept = $row['department'];
                      $result = mysqli_query($connect,"SELECT * FROM events WHERE department='$dept' ORDER BY id DESC");
                      while($row = mysqli_fetch_array($result))
                      {
                        $stat = $row['flag'];
                        $eq = $row['eqv'];
                        if($stat == 0 && $eq == 0){

                    ?>
                    <tr>
                         <td><?php echo strtoupper($row["name"]); ?></td>
                         <td>
                           <!--<input type="button" name="view" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs" />-->
                           <!--<input type="button" name="view" value="Absence" id="<?php echo $row["id"]; ?>" class="btn btn-secondary btn-xs absent_view" />-->
                           <button name="view" value="ATTENDANCE" id="<?php echo $row["id"]; ?>" class="btn btn-success btn-xs attendance_view">&nbsp;&nbsp;<i class="fas fa-users"></i>&nbsp;&nbsp;</button>
                           <input type="button" name="view" value="SET EVENT" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs event_set_view" />
                         </td>
                    </tr>
                    <?php
                      }
                        else if($stat == 0 && $eq >= 1){
                    ?>
                    <tr>
                        <td><?php echo strtoupper($row["name"]); ?></td>
                        <td>
                           <!--<input type="button" name="view" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs" />-->
                           <!--<input type="button" name="view" value="Absence" id="<?php echo $row["id"]; ?>" class="btn btn-secondary btn-xs absent_view" />-->
                           <button name="view" value="ATTENDANCE" id="<?php echo $row["id"]; ?>" class="btn btn-success btn-xs attendance_view">&nbsp;&nbsp;<i class="fas fa-users"></i>&nbsp;&nbsp;</button>
                            <b class='btn btn-secondary'>&nbsp;&nbsp;<i class='fas fa-check'></i>&nbsp;&nbsp;</b>
                         </td>
                    </tr>
                    <?php
                      }
                      else{
                    ?>
                    <tr>
                        <td><div class="alert alert-danger" role="alert"><b><?php echo strtoupper($row["name"]); ?></b></div></td>
                        <td>
                           <!--<input type="button" name="view" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs" />-->
                           <!--<input type="button" name="view" value="Absence" id="<?php echo $row["id"]; ?>" class="btn btn-secondary btn-xs absent_view" />-->
                           <div class="alert alert-danger" role="alert" align="center">
                            <b>EVENT IS CURRENTLY SET FOR ATTENDANCE</b>
                           </div>
                         </td>
                    </tr>

                    <?php
                      }
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

  <!-- Logout Modal-->
  <div class="modal fade" id="settime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST">
        <div class="modal-body">
          <label>First Attendance</label>
          <select name="first_start" class="form-control" required>
            <option value="" hidden>Select Start Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="13:00:00">1:00 PM</option>
            <option value="14:00:00">2:00 PM</option>
            <option value="15:00:00">3:00 PM</option>
            <option value="16:00:00">4:00 PM</option>
            <option value="17:00:00">5:00 PM</option>
          </select>
          <select name="first_end" class="form-control" required>
            <option value="" hidden>Select End Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="13:00:00">1:00 PM</option>
            <option value="14:00:00">2:00 PM</option>
            <option value="15:00:00">3:00 PM</option>
            <option value="16:00:00">4:00 PM</option>
            <option value="17:00:00">5:00 PM</option>
          </select>
          <br>
          <label>Second Attendance</label>
          <select name="second_start" class="form-control" required>
            <option value="" hidden>Select Start Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="01:00:00">1:00 PM</option>
            <option value="02:00:00">2:00 PM</option>
            <option value="03:00:00">3:00 PM</option>
            <option value="04:00:00">4:00 PM</option>
            <option value="05:00:00">5:00 PM</option>
          </select>
          <select name="second_end" class="form-control" required>
            <option value="" hidden>Select End Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="01:00:00">1:00 PM</option>
            <option value="02:00:00">2:00 PM</option>
            <option value="03:00:00">3:00 PM</option>
            <option value="04:00:00">4:00 PM</option>
            <option value="05:00:00">5:00 PM</option>
          </select>
          <br>
          <label>Third Attendance</label>
          <select name="third_start" class="form-control" required>
            <option value="" hidden>Select Start Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="01:00:00">1:00 PM</option>
            <option value="02:00:00">2:00 PM</option>
            <option value="03:00:00">3:00 PM</option>
            <option value="04:00:00">4:00 PM</option>
            <option value="05:00:00">5:00 PM</option>
          </select>
          <select name="third_end" class="form-control" required>
            <option value="" hidden>Select End Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="11:00:00">1:00 PM</option>
            <option value="02:00:00">2:00 PM</option>
            <option value="03:00:00">3:00 PM</option>
            <option value="04:00:00">4:00 PM</option>
            <option value="05:00:00">5:00 PM</option>
          </select>
          <br>
          <label>Fourth Attendance</label>
          <select name="fourth_start" class="form-control" required>
            <option value="" hidden>Select Start Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="01:00:00">1:00 PM</option>
            <option value="02:00:00">2:00 PM</option>
            <option value="03:00:00">3:00 PM</option>
            <option value="04:00:00">4:00 PM</option>
            <option value="05:00:00">5:00 PM</option>
          </select>
          <select name="fourth_end" class="form-control" required>
            <option value="" hidden>Select End Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="01:00:00">1:00 PM</option>
            <option value="02:00:00">2:00 PM</option>
            <option value="03:00:00">3:00 PM</option>
            <option value="04:00:00">4:00 PM</option>
            <option value="05:00:00">5:00 PM</option>
          </select>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" value="Set Time" class="btn btn-primary" name="set_time"></a>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="setpart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST">
        <div class="modal-body">
          <label>First Attendance</label>
          <select name="first_start" class="form-control" required>
            <option value="" hidden>Select Start Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="13:00:00">1:00 PM</option>
            <option value="14:00:00">2:00 PM</option>
            <option value="15:00:00">3:00 PM</option>
            <option value="16:00:00">4:00 PM</option>
            <option value="17:00:00">5:00 PM</option>
          </select>
          <select name="first_end" class="form-control" required>
            <option value="" hidden>Select End Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="13:00:00">1:00 PM</option>
            <option value="14:00:00">2:00 PM</option>
            <option value="15:00:00">3:00 PM</option>
            <option value="16:00:00">4:00 PM</option>
            <option value="17:00:00">5:00 PM</option>
          </select>
          <br>
          <label>Second Attendance</label>
          <select name="second_start" class="form-control" required>
            <option value="" hidden>Select Start Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="01:00:00">1:00 PM</option>
            <option value="02:00:00">2:00 PM</option>
            <option value="03:00:00">3:00 PM</option>
            <option value="04:00:00">4:00 PM</option>
            <option value="05:00:00">5:00 PM</option>
          </select>
          <select name="second_end" class="form-control" required>
            <option value="" hidden>Select End Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="01:00:00">1:00 PM</option>
            <option value="02:00:00">2:00 PM</option>
            <option value="03:00:00">3:00 PM</option>
            <option value="04:00:00">4:00 PM</option>
            <option value="05:00:00">5:00 PM</option>
          </select>
          <br>
          <label>Third Attendance</label>
          <select name="third_start" class="form-control" required>
            <option value="" hidden>Select Start Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="01:00:00">1:00 PM</option>
            <option value="02:00:00">2:00 PM</option>
            <option value="03:00:00">3:00 PM</option>
            <option value="04:00:00">4:00 PM</option>
            <option value="05:00:00">5:00 PM</option>
          </select>
          <select name="third_end" class="form-control" required>
            <option value="" hidden>Select End Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="11:00:00">1:00 PM</option>
            <option value="02:00:00">2:00 PM</option>
            <option value="03:00:00">3:00 PM</option>
            <option value="04:00:00">4:00 PM</option>
            <option value="05:00:00">5:00 PM</option>
          </select>
          <br>
          <label>Fourth Attendance</label>
          <select name="fourth_start" class="form-control" required>
            <option value="" hidden>Select Start Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="01:00:00">1:00 PM</option>
            <option value="02:00:00">2:00 PM</option>
            <option value="03:00:00">3:00 PM</option>
            <option value="04:00:00">4:00 PM</option>
            <option value="05:00:00">5:00 PM</option>
          </select>
          <select name="fourth_end" class="form-control" required>
            <option value="" hidden>Select End Time</option>
            <option value="08:00:00">8:00 AM</option>
            <option value="09:00:00">9:00 AM</option>
            <option value="10:00:00">10:00 AM</option>
            <option value="11:00:00">11:00 AM</option>
            <option value="12:00:00">12:00 AM</option>
            <option value="01:00:00">1:00 PM</option>
            <option value="02:00:00">2:00 PM</option>
            <option value="03:00:00">3:00 PM</option>
            <option value="04:00:00">4:00 PM</option>
            <option value="05:00:00">5:00 PM</option>
          </select>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" value="Set Time" class="btn btn-primary" name="set_time"></a>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Logout Modal-->
  <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADD ACTIVITY</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST">
        <div class="modal-body">
          <label>ACTIVITY NAME</label>
          <input type="text" class="form-control" name="event_name">
          <input type="text" class="form-control" value="Departmental" name="event_type" hidden>
          <?php
          $connect = mysqli_connect("localhost", "root", "", "eas");
          $try = $_SESSION['username'];
          //$query = "SELECT * FROM student WHERE id = '".$try."'";
          //$result = mysqli_query($connect, $query);
          $query = mysqli_query($connect, "SELECT department FROM accounts WHERE id = '".$try."'");
          while($row = mysqli_fetch_array($query))
          {
          ?>
          <input type="text" name="event_dept" class="form-control" value="<?php echo $row['department']; ?>" hidden>
          <?php
          }
          ?>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" value="Add" class="btn btn-primary" name="add_event"></a>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">System Log</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST">
        <div class="modal-body">
          <label>Event Name</label>
          <input type="text" class="form-control" name="event_name">
          <input type="text" class="form-control" value="Departmental" name="event_type" hidden>
          <?php
          $connect = mysqli_connect("localhost", "root", "", "eas");
          $try = $_SESSION['username'];
          //$query = "SELECT * FROM student WHERE id = '".$try."'";
          //$result = mysqli_query($connect, $query);
          $query = mysqli_query($connect, "SELECT department FROM accounts WHERE id = '".$try."'");
          while($row = mysqli_fetch_array($query))
          {
          ?>
          <input type="text" name="event_dept" class="form-control" value="<?php echo $row['department']; ?>" hidden>
          <?php
          }
          ?>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" value="Add" class="btn btn-primary" name="add_event"></a>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="eventsmodal" class="modal fade">
       <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">ACTIVITY DETAILS</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="event_details">
                 </div>
                 <div class="modal-footer">
                 </form>
                 </div>
            </div>
       </div>
  </div>
  <script>
  $(document).ready(function(){
       $('.events_view').click(function(){
            var events_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{events_id:events_id},
                 success:function(data){
                      $('#event_details').html(data);
                      $('#eventsmodal').modal("show");
                 }
            });
       });
  });
  </script>

  <div id="delete_modal" class="modal fade">
       <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel"></h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="delete_details">
                 </div>
                 <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <input type="submit" value="Delete" class="btn btn-danger" name="del_event"></a>
                 </form>
                 </div>
            </div>
       </div>
  </div>
  <script>
  $(document).ready(function(){
       $('.delete_view').click(function(){
            var delete_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{delete_id:delete_id},
                 success:function(data){
                      $('#delete_details').html(data);
                      $('#delete_modal').modal("show");
                 }
            });
       });
  });
  </script>

  <div id="set_time_modal" class="modal fade">
       <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">SET ATTENDANCE TIME AND PARTICIPANTS</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="set_time_details">
                 </div>
                 <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <input type="submit" value="Set Attendance" class="btn btn-primary" name="set_event_time"></a>
                 </form>
                 </div>
            </div>
       </div>
  </div>
  <script>
  $(document).ready(function(){
       $('.set_time_view').click(function(){
            var set_time_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{set_time_id:set_time_id},
                 success:function(data){
                      $('#set_time_details').html(data);
                      $('#set_time_modal').modal("show");
                 }
            });
       });
  });
  </script>








  <script>
  $(document).ready(function(){
       $('.check_attendance').click(function(){
            var student_id_for_attendance = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{student_id_for_attendance:student_id_for_attendance},
                 success:function(data){
                   window.location="catcheduc.php";
                 }
            });
       });
  });
  </script>









  <div id="set_part_modal" class="modal fade">
       <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Set Attendance Participants</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="set_part_details">
                 </div>
                 <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <input type="submit" value="Set Attendee" class="btn btn-primary" name="set_part"></a>
                 </form>
                 </div>
            </div>
       </div>
  </div>
  <script>
  $(document).ready(function(){
       $('.set_part_view').click(function(){
            var set_part_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{set_part_id:set_part_id},
                 success:function(data){
                      $('#set_part_details').html(data);
                      $('#set_part_modal').modal("show");
                 }
            });
       });
  });
  </script>

  <div id="add_modal" class="modal fade">
       <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">SET ATTENDANCE</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="add_details">
                 </div>
                 <div class="modal-body"><b><u><font color="red">REMINDER:</font></b></u><br>Do you wish to set this event as Current Event for Attendance?</div>
                 <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <input type="submit" value="SET ATTENDANCE"class="btn btn-warning" name="setevent_current"></a>
                 </form>
                 </div>
            </div>
       </div>
  </div>
  <script>
  $(document).ready(function(){
       $('.add_view').click(function(){
            var add_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{add_id:add_id},
                 success:function(data){
                      $('#add_details').html(data);
                      $('#add_modal').modal("show");
                 }
            });
       });
  });
  </script>

  <div id="event_set_modal" class="modal fade">
       <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">SET ACTIVITY AS ATTENDANCE</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="event_set_detail">
                 </div>
                 <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <input type="submit" value="SET"class="btn btn-warning" name="setevent_current"></a>
                 </form>
                 </div>
            </div>
       </div>
  </div>
  <script>
  $(document).ready(function(){
       $('.event_set_view').click(function(){
            var event_set_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{event_set_id:event_set_id},
                 success:function(data){
                      $('#event_set_detail').html(data);
                      $('#event_set_modal').modal("show");
                 }
            });
       });
  });
  </script>

  <div id="event_unset_modal" class="modal fade">
       <div class="modal-dialog" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">UNSET ACTIVITY</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form method="POST">
                 <div class="modal-body" id="event_unset_details">
                 </div>
                 <div class="modal-body"><b><u><font color="red">REMINDER:</font></b></u><br>This action removes current attendance on the system.</div>
                 <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <input type="submit" value="UNSET EVENT"class="btn btn-danger" name="event_unset"></a>
                 </form>
                 </div>
            </div>
       </div>
  </div>
  <script>
  $(document).ready(function(){
       $('.event_unset_view').click(function(){
            var event_unset_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{event_unset_id:event_unset_id},
                 success:function(data){
                      $('#event_unset_details').html(data);
                      $('#event_unset_modal').modal("show");
                 }
            });
       });
  });
  </script>

  <div id="attendance_modal" class="modal fade">
       <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">ATTENDANCE</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form action="studentreport.php" method="POST">
                 <div class="modal-body" id="attendance_details">
                 </div>
                 <div class="modal-footer">
                   <button value='Print Attendance' class='btn btn-primary' name='attend_report'>&nbsp;&nbsp;&nbsp;<i class="fas fa-print"></i>&nbsp;&nbsp;&nbsp;</button>
                 </div>
                 </form>
            </div>
       </div>
  </div>

  <script>
  $(document).ready(function(){
       $('.attendance_view').click(function(){
            var attendance_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{attendance_id:attendance_id},
                 success:function(data){
                      $('#attendance_details').html(data);
                      $('#attendance_modal').modal("show");
                 }
            });
       });
  });
  </script>

  <div id="absent_modal" class="modal fade">
       <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Absent</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form action="absent_report.php" method="POST">
                 <div class="modal-body" id="absent_details">
                 </div>
                 <div class="modal-footer">
                   <input type='submit' value='Print Absent' class='btn btn-primary' name='absent_report'>
                 </div>
                 </form>
            </div>
       </div>
  </div>

  <script>
  $(document).ready(function(){
       $('.absent_view').click(function(){
            var absent_id = $(this).attr("id");
            $.ajax({
                 url:"function.php",
                 method:"post",
                 data:{absent_id:absent_id},
                 success:function(data){
                      $('#absent_details').html(data);
                      $('#absent_modal').modal("show");
                 }
            });
       });
  });
  </script>






  <div id="print_summary_modal" class="modal fade">
       <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">OVERALL ATTENDANCE SUMMARY</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                   </button>
                 </div>
                 <form action="summary_report.php" method="POST" >
                 <div class="modal-body" id="print_summary_details">
                 </div>
                 <div class="modal-footer">
                   <input type='submit' value='Print Attendance' class='btn btn-primary'  name='summary_report'>
                 </div>
                 </form>
            </div>
       </div>
  </div>

  <script>
  $(document).ready(function(){
       $('.print_summary_view').click(function(){
         var ab_id = $(this).attr("id");
            $.ajax({

                 url:"function.php",
                 method:"post",
                    data:{ab_id:ab_id},
                 success:function(data){
                      $('#print_summary_details').html(data);
                      $('#print_summary_modal').modal("show");
                 }
            });
       });
  });
  </script>

  <script>
  $(document).ready(function() {
    $('#dataTable').DataTable( {
        "order": [[ 0, "desc" ]]
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


</body>

</html>

<style>
#myDIV {
  display: none
}
#myDIV2 {
  display: none
}
#myDIV3 {
  display: none
}
#myDIV4 {
  display: none
}
</style>
<script>
 function myFunction() {
   var x = document.getElementById("myDIV");
   if (x.style.display === "block") {
     x.style.display = "none";
   } else {
     x.style.display = "block";
   }
 }
 function myFunction2() {
   var x = document.getElementById("myDIV2");
   if (x.style.display === "block") {
     x.style.display = "none";
   } else {
     x.style.display = "block";
   }
 }
 function myFunction3() {
   var x = document.getElementById("myDIV3");
   if (x.style.display === "block") {
     x.style.display = "none";
   } else {
     x.style.display = "block";
   }
 }
 function myFunction4() {
   var x = document.getElementById("myDIV4");
   if (x.style.display === "block") {
     x.style.display = "none";
   } else {
     x.style.display = "block";
   }
 }
 </script>
