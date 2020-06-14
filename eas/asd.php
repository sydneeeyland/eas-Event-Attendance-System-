<?php
include("function.php");
$connect = mysqli_connect("localhost", "root", "", "eas");
$try = $_SESSION['username'];
$time = date("h:i:s");
$date = date("Y-m-d");


?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title> </title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

<!-- Custom fonts for this template-->
<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="assets/css/sb-admin.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>

<div class="modal-body" >
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
          $start = $row['start_date'];
          $end = $row['end_date'];
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
          $check_attendance_button_status="";
          if($time >= $first_start && $time <= $first_end ||
          $time >= $second_start && $time <= $second_end ||
          $time >= $third_start && $time <= $third_end  ||
          $time >= $fourth_start && $time <= $fourth_end )
          {
                $check_attendance_button_status="";
          }
          else {
              $check_attendance_button_status="disabled";
          }
      ?>
      <tr>

           <td><?php echo strtoupper($row["name"]); ?></td>
           <td><?php echo strtoupper($row["start_date"]); ?></td>
           <td >
             <button name="view" value="UNSET" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs event_unset_view">&nbsp;&nbsp;<i class="fas fa-times"></i>&nbsp;&nbsp;</button>
             <button name="view" value="DETAILS" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs events_view ">&nbsp;&nbsp;&nbsp;<i class="fas fa-info"></i>&nbsp;&nbsp;&nbsp;</button>
             <button name="view" value="SET TIME" id="<?php echo $row["id"]; ?>" class="btn btn-primary btn-xs set_time_view ">&nbsp;&nbsp;<i class="fas fa-cog"></i>&nbsp;&nbsp;</button>
             <input type="button" name="view" value="CHECK ATTENDANCE" id="<?php echo $row["id"]; ?>" class="btn btn-success btn-xs check_attendance"<?php echo $check_attendance_button_status ?>/>
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
</div>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
