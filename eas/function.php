<?php

//error_reporting(0);
//ini_set('display_errors', 0);

session_start();

  //LOGIN SESSION//

  //connect to database
  $db = mysqli_connect("localhost" , "root" , "" , "eas");

  if(!$db) {
    die("Connection failed: ".mysqli_connect_error());
  }

  //LOGIN MODULE//

  $setsy_year="";
  $connect = mysqli_connect("localhost", "root", "", "eas");
  $query99 = "SELECT year from setsy order by id desc LIMIT 1  ";

  $result99 = mysqli_query($db, $query99);
  while($row = mysqli_fetch_array($result99))
  {
        $setsy_year= $row['year'];
  }
  $_SESSION['$setsy_year'] = $setsy_year;

  if(isset($_POST['login'])) {
    //session_start();

    $uid = mysqli_real_escape_string($db,$_POST['username']);
    $password = mysqli_real_escape_string($db,$_POST['password']);


    $sql = "SELECT * FROM accounts WHERE id='$uid' AND pw='$password'";
    $result = mysqli_query($db, $sql);

    if (!$row = $result->fetch_assoc()){
      echo "<script>alert('Username or Password is Incorrect ! ');window.location.href='index.php';</script>";
    }
    else {
        $_SESSION['username'] = $row['id'];
        $sql = "SELECT * FROM accounts WHERE id = '$uid' and pw = '$password' ";
        $result = mysqli_query($db, $sql);
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $uid;
        if ($row['type'] === 'admin')
              header("Location: admin.php");

        elseif ($row['type'] === 'ADVISER' && $row['department'] === 'COMPUTER STUDIES')
              header("Location: facultycs.php");

        elseif ($row['type'] === 'ADVISER' && $row['department'] === 'ACCOUNTANCY')
              header("Location: facultyac.php");

        elseif ($row['type'] === 'ADVISER' && $row['department'] === 'ENGINEERING')
              header("Location: facultyea.php");

        elseif ($row['type'] === 'ADVISER' && $row['department'] === 'AB')
              header("Location: facultyab.php");

        elseif ($row['type'] === 'ADVISER' && $row['department'] === 'BUSINESS')
              header("Location: facultybhm.php");

        elseif ($row['type'] === 'ADVISER' && $row['department'] === 'EDUCATION')
              header("Location: facultyeduc.php");

        elseif ($row['type'] === 'OFFICER' && $row['department'] === 'COMPUTER STUDIES')
              header("Location: officercs.php");

        elseif ($row['type'] === 'OFFICER' && $row['department'] === 'ACCOUNTANCY')
              header("Location: officerac.php");

        elseif ($row['type'] === 'OFFICER' && $row['department'] === 'ENGINEERING')
              header("Location: officerea.php");

        elseif ($row['type'] === 'OFFICER' && $row['department'] === 'AB')
              header("Location: officerab.php");

        elseif ($row['type'] === 'OFFICER' && $row['department'] === 'BUSINESS')
              header("Location: officerbhm.php");

        elseif ($row['type'] === 'OFFICER' && $row['department'] === 'EDUCATION')
              header("Location: officereduc.php");

        elseif ($row['type'] === 'STUDENT' && $row['department'] === 'COMPUTER STUDIES')
              header("Location: studentcs.php");

        elseif ($row['type'] === 'STUDENT' && $row['department'] === 'ACCOUNTANCY')
              header("Location: studentac.php");

        elseif ($row['type'] === 'STUDENT' && $row['department'] === 'ENGINEERING')
              header("Location: studentea.php");

        elseif ($row['type'] === 'STUDENT' && $row['department'] === 'AB')
              header("Location: studentab.php");

        elseif ($row['type'] === 'STUDENT' && $row['department'] === 'BUSINESS')
              header("Location: studentbhm.php");

        elseif ($row['type'] === 'STUDENT' && $row['department'] === 'EDUCATION')
              header("Location: studenteduc.php");

        else
        echo "<script>alert('walang dept');window.location.href='index.php';</script>";

        die();
        }
    }

    //LOGIN MODULE//

    //LOGOUT MODULE//
    if(isset($_POST['logout'])) {
    session_start();
    if(session_destroy())
    {
      header("Location: index.php");

    }
  }
    //LOGOUT MODULE//

    //Register admin//
    if(isset($_POST['registeradmin'])) {
      $sql = "SELECT * FROM accounts WHERE type = 'admin' ";
      $result = mysqli_query($db,$sql);
      if($result->num_rows > 0)
      {
        echo "<script>alert('Admin is already Registered ! ');window.location.href='index.php';</script>";
      }
      else {

        $id = $_POST['regid'];
        $name = $_POST['regname'];
        $pass1 = $_POST['regpass1'];
        $pass2 = $_POST['regpass2'];
        $type = $_POST['type'];

        if($pass1 == $pass2){
          $regsql = "INSERT INTO accounts (id,pw,name,type) VALUES ('$id','$pass1','$name','$type')";
          $regres = mysqli_query($db,$regsql);
          echo "<script>alert('Admin has been created ! ');window.location.href='index.php';</script>";
        }
      }
  }
  //Register admin//

    //DISPLAY DATA ON ADMIN MANAGE MODULE//


   if(isset($_POST["employee_id"]))
   {
        $output = '';
        $connect = mysqli_connect("localhost", "root", "", "eas");
        $query = "SELECT * FROM faculty WHERE id = '".$_POST["employee_id"]."'";
        $result = mysqli_query($connect, $query);
        $output .= '
        <form method="POST">';
        while($row = mysqli_fetch_array($result))
        {
              $id = $row["id"];
              $name = $row['name'];
              $dept = $row['department'];
              $bdate = $row['birthdate'];

             $output .= '
                  <label>Employee ID</label>
                  <input type="text" name="emp_id" class="form-control" value="'.$id.'" readonly>
                  <label>Faculty Name</label>
                  <input type="text" name="emp_name" class="form-control" value="'.$name.'" readonly>
                  <label>Department</label>
                  <input type="text" name="emp_dept" class="form-control" value="'.$dept.'" readonly>
                  <label>Birthdate</label>
                  <input type="text" name="emp_bdate" class="form-control" value="'.$bdate.'" readonly>
                  <input type="text" name="emp_type" class="form-control" value="ADVISER" hidden>
                  <input type="text" name="sem" class="form-control" value="" hidden>
                  <input type="text" name="year" class="form-control" value="" hidden>
                  ';
        }
        $output .= "</form>";
        echo $output;

   }
  //DISPLAY DATA ON ADMIN MANAGE MODULE//

  //CREATES ACCOUNT FOR FACULTY//
   if(isset($_POST["assignfac"]))
   {
     $empid = mysqli_real_escape_string($db,$_POST['emp_id']);
     $empname = mysqli_real_escape_string($db,$_POST['emp_name']);
     $empbdate = mysqli_real_escape_string($db,$_POST['emp_bdate']);
     $emptype = mysqli_real_escape_string($db,$_POST['emp_type']);
     $empdept = mysqli_real_escape_string($db,$_POST['emp_dept']);
     $sem = mysqli_real_escape_string($db,$_POST['sem']);
     $year = mysqli_real_escape_string($db,$_POST['year']);

     $sql = "INSERT INTO accounts (id, pw, name, type, department) VALUES('$empid', '$empbdate', '$empname' , '$emptype' , '$empdept')";
     $result = mysqli_query($db, $sql);
     $sqltmp = "INSERT INTO tmpadv (id,name,department,birthdate) VALUES ('$empid','$empname','$empdept', '$empbdate')";
     $resulttmp = mysqli_query($db, $sqltmp);
     $sqlrem = "DELETE FROM FACULTY WHERE id = '".$empid."'";
     $resultrem = mysqli_query($db, $sqlrem);
     echo '<script type="text/javascript">';
     echo 'setTimeout(function () { Swal.fire("Assigning Department Adviser Success ! ","","success");';
     echo '},);</script>';
   }
  //CREATES ACCOUNT FOR FACULTY//

  //DISPLAY DATA ON ADMIN MANAGE MODULE TEMPORARY ADVISER//
 if(isset($_POST["tmpadv_id"]))
 {
      $output = '';
      $connect = mysqli_connect("localhost", "root", "", "eas");
      $query = "SELECT * FROM tmpadv WHERE id = '".$_POST["tmpadv_id"]."'";
      $result = mysqli_query($connect, $query);
      $output .= '
      <form method="POST">';
      while($row = mysqli_fetch_array($result))
      {
            $id = $row["id"];
            $name = $row['name'];
            $dept = $row['department'];
            $bdate = $row['birthdate'];

           $output .= '
                <label >Employee ID</label>
                <input type="text" name="emp_id" class="form-control" value="'.$id.'" readonly>
                <label >Faculty Name</label>
                <input type="text" name="emp_name" class="form-control" value="'.$name.'" readonly>
                <label >Department</label>
                <input type="text" name="emp_dept" class="form-control" value="'.$dept.'" readonly>
                <label >Birthdate</label>
                <input type="text" name="emp_bdate" class="form-control" value="'.$bdate.'" readonly>
                <input type="text" name="emp_type" class="form-control" value="ADVISER" hidden>
                <input type="text" name="sem" class="form-control" value="" hidden>
                <input type="text" name="year" class="form-control" value="" hidden>
                ';
      }
      $output .= "</form>";
      echo $output;

 }
 //DISPLAY DATA ON ADMIN MANAGE MODULE TEMPORARY ADVISER//

 //TEMPORARY ADVISER//
  if(isset($_POST["tmpadv_revoke"]))
  {
    $empid = mysqli_real_escape_string($db,$_POST['emp_id']);
    $empname = mysqli_real_escape_string($db,$_POST['emp_name']);
    $empbdate = mysqli_real_escape_string($db,$_POST['emp_bdate']);
    $emptype = mysqli_real_escape_string($db,$_POST['emp_type']);
    $empdept = mysqli_real_escape_string($db,$_POST['emp_dept']);
    $sem = mysqli_real_escape_string($db,$_POST['sem']);
    $year = mysqli_real_escape_string($db,$_POST['year']);

    $sqltmp = "INSERT INTO faculty (id,name,department,birthdate) VALUES ('$empid','$empname','$empdept', '$empbdate')";
    $resulttmp = mysqli_query($db, $sqltmp);
    $sql = "DELETE FROM accounts WHERE id = '".$empid."'";
    $sqlrem = "DELETE FROM tmpadv WHERE id = '".$empid."'";
    $result = mysqli_query($db, $sql);
    $resultrem = mysqli_query($db, $sqlrem);
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { Swal.fire("Unassigning Department Adviser Success ! ","","success");';
    echo '},);</script>';
  }
  //TEMPORARY ADVISER//

  //DISPLAY STUDENT DATA ON FACULTY MANAGE MODULE//
 if(isset($_POST["student_id"]))
 {
      $output = '';
      $connect = mysqli_connect("localhost", "root", "", "eas");
      $query =
      "SELECT student.id, student.name, student.department, student.birthdate, student.sem, student.year, student.year_level
      FROM student,tmp
      WHERE student.id = '".$_POST["student_id"]."'
      AND tmp.sem = student.sem
      AND tmp.year = student.year";
      $result = mysqli_query($connect, $query);
      $output .= '
      <form method="POST">';
      while($row = mysqli_fetch_array($result))
      {
            $id = $row["id"];
            $name = $row['name'];
            $dept = $row['department'];
            $bdate = $row['birthdate'];
            $sem = $row['sem'];
            $year = $row['year'];
            $level = $row['year_level'];

           $output .= '
                <label>Position</label>
                <select name="position" class="form-control" required>
                  <option value="" hidden selected>Select Position</option>
                  <option value="President">President</option>
                  <option value="Vice - President">Vice - President</option>
                  <option value="Secretary">Secretary</option>
                  <option value="Auditor">Auditor</option>
                  <option value="Business Manager">Business Manager</option>
                  <option value="Sports Coordinator">Sports Coordinator</option>
                  <option value="PRO">P.R.O</option>
                  <option value="Academics Coordinator">Academic Coordinator</option>
                  <option value="Cultural Coordinator">Cultural Events Coordinator</option>
                </select>
                <label>Student ID</label>
                <input type="text" name="stud_id" class="form-control" value="'.$id.'" readonly>
                <label>Student Name</label>
                <input type="text" name="stud_name" class="form-control" value="'.$name.'" readonly>
                <label hidden>Department</label>
                <input type="text" name="stud_dept" class="form-control" value="'.$dept.'" readonly hidden>
                <label>Birthdate</label>
                <input type="text" name="stud_bdate" class="form-control" value="'.$bdate.'" readonly>
                <input type="text" name="stud_sem" class="form-control" value="'.$sem.'" readonly hidden>
                <input type="text" name="stud_year" class="form-control" value="'.$year.'" readonly hidden>
                <input type="text" name="stud_year_level" class="form-control" value="'.$level.'" readonly hidden>
                <input type="text" name="stud_type" class="form-control" value="OFFICER" hidden>
                ';
      }
      $output .= "</form>";
      echo $output;

 }

//DISPLAY STUDENT DATA ON FACULTY MANAGE MODULE//

   //Assign Department Officer//
   if(isset($_POST["assignofficer"]))
   {
     $studpos = mysqli_real_escape_string($db,$_POST['position']);
     $studid = mysqli_real_escape_string($db,$_POST['stud_id']);
     $studname = mysqli_real_escape_string($db,$_POST['stud_name']);
     $studdept = mysqli_real_escape_string($db,$_POST['stud_dept']);
     $studbdate = mysqli_real_escape_string($db,$_POST['stud_bdate']);
     $studtype = mysqli_real_escape_string($db,$_POST['stud_type']);
     $studsem = mysqli_real_escape_string($db,$_POST['stud_sem']);
     $studyear = mysqli_real_escape_string($db,$_POST['stud_year']);
     $yearlevel = mysqli_real_escape_string($db,$_POST['stud_year_level']);

     $testquery = "SELECT * FROM tmpoff WHERE pos = '".$studpos."' AND department = '".$studdept."'";
     $testresult = mysqli_query($db, $testquery);
     if(mysqli_num_rows($testresult) > 0)
     {
       echo '<script type="text/javascript">';
       echo 'setTimeout(function () { Swal.fire("Assigning Officer Failed","Position is already Filled !","error");';
       echo '},);</script>';
       //echo "<script>alert('Position is already Filled ! ');window.location.href='facultymanage.php';</script>";
     }
     else{

     $sql = "INSERT INTO accounts (id, name, pw, type, department) VALUES('$studid', '$studname', '$studbdate' , '$studtype' , '$studdept')";
     $result = mysqli_query($db, $sql);
     $sql2 = "INSERT INTO tmpoff (id, name, department, birthdate, pos, sem, year, year_level ) VALUES('$studid', '$studname', '$studdept' , '$studbdate' , '$studpos' , '$studsem' , '$studyear', '$yearlevel')";
     $result2 = mysqli_query($db, $sql2);
     $sql3 = "DELETE FROM student WHERE id = '".$studid."'";
     $result3 = mysqli_query($db, $sql3);
     echo '<script type="text/javascript">';
     echo 'setTimeout(function () { Swal.fire("Assigning Officer Success ! ","","success");';
     echo '},);</script>';
     }

   }
    //Assign Department Officer//

    //set student attendance card//
   if(isset($_POST["card_id"]))
   {
        $output = '';
        $connect = mysqli_connect("localhost", "root", "", "eas");
        $query = "SELECT * FROM stud_pool WHERE id = '".$_POST["card_id"]."'";
        $result = mysqli_query($connect, $query);
        $output .= '
        <form method="POST">';
        while($row = mysqli_fetch_array($result))
        {
              $id = $row["id"];
              $name = $row['name'];
              $tag = $row['card'];

             $output .= '
                  <label>Card Tag</label>
                  <input type="text" name="card_tag" class="form-control" value="'.$tag.'">
                  <label>Student ID</label>
                  <input type="text" name="stud_id" class="form-control" value="'.$id.'" readonly>
                  <label>Student Name</label>
                  <input type="text" name="stud_name" class="form-control" value="'.$name.'" readonly>
                  ';
        }
        $output .= "</form>";
        echo $output;

   }

   //set student attendance card//

  //set student attendance card//
     if(isset($_POST["card_assign"]))
     {
       //$studpos = mysqli_real_escape_string($db,$_POST['position']);
       $studid = mysqli_real_escape_string($db,$_POST['stud_id']);
       $studname = mysqli_real_escape_string($db,$_POST['stud_name']);
       $stud_tag = mysqli_real_escape_string($db,$_POST['card_tag']);

       $sql = "UPDATE stud_pool SET card = '".$stud_tag."'
       WHERE id = '".$studid."'";
       $result = mysqli_query($db, $sql);

       echo '<script type="text/javascript">';
       echo 'setTimeout(function () { Swal.fire("Student Attendance card tag has been assigned ! ","","success");';
       echo '},);</script>';

     }
      //set student attendance card//

    //DISPLAY STUDENT DATA ON FACULTY MANAGE MODULE//
   if(isset($_POST["tmpoff_id"]))
   {
        $output = '';
        $connect = mysqli_connect("localhost", "root", "", "eas");
        $query = "SELECT * FROM tmpoff WHERE id = '".$_POST["tmpoff_id"]."'";
        $result = mysqli_query($connect, $query);
        $output .= '
        <form method="POST">';
        while($row = mysqli_fetch_array($result))
        {
              $id = $row["id"];
              $name = $row['name'];
              $dept = $row['department'];
              $bdate = $row['birthdate'];
              $sem = $row['sem'];
              $year = $row['year'];
              $level = $row['year_level'];

             $output .= '
                  <label>Student ID</label>
                  <input type="text" name="stud_id" class="form-control" value="'.$id.'" readonly>
                  <label>Student Name</label>
                  <input type="text" name="stud_name" class="form-control" value="'.$name.'" readonly>
                  <label hidden>Department</label>
                  <input type="text" name="stud_dept" class="form-control" value="'.$dept.'" readonly hidden>
                  <label>Birthdate</label>
                  <input type="text" name="stud_bdate" class="form-control" value="'.$bdate.'" readonly>
                  <input type="text" name="stud_sem" class="form-control" value="'.$sem.'" readonly hidden>
                  <input type="text" name="stud_year" class="form-control" value="'.$year.'" readonly hidden>
                  <input type="text" name="stud_year_level" class="form-control" value="'.$level.'" readonly hidden>
                  <input type="text" name="stud_type" class="form-control" value="OFFICER" hidden>
                  ';
        }
        $output .= "</form>";
        echo $output;

   }

  //DISPLAY STUDENT DATA ON FACULTY MANAGE MODULE//

     //Revoke Department Officer//
     if(isset($_POST["tmpoff_revoke"]))
     {
       //$studpos = mysqli_real_escape_string($db,$_POST['position']);
       $studid = mysqli_real_escape_string($db,$_POST['stud_id']);
       $studname = mysqli_real_escape_string($db,$_POST['stud_name']);
       $studdept = mysqli_real_escape_string($db,$_POST['stud_dept']);
       $studbdate = mysqli_real_escape_string($db,$_POST['stud_bdate']);
       $studtype = mysqli_real_escape_string($db,$_POST['stud_type']);
       $studsem = mysqli_real_escape_string($db,$_POST['stud_sem']);
       $studyear = mysqli_real_escape_string($db,$_POST['stud_year']);
       $yearlevel = mysqli_real_escape_string($db,$_POST['stud_year_level']);


       $sqltmp = "INSERT INTO student (id,name,department,birthdate,sem,year,year_level) VALUES ('$studid','$studname','$studdept', '$studbdate', '$studsem', '$studyear', '$yearlevel')";
       $resulttmp = mysqli_query($db, $sqltmp);
       $sql = "DELETE FROM accounts WHERE id = '".$studid."'";
       $sqlrem = "DELETE FROM tmpoff WHERE id = '".$studid."'";
       $result = mysqli_query($db, $sql);
       $resultrem = mysqli_query($db, $sqlrem);
       echo '<script type="text/javascript">';
       echo 'setTimeout(function () { Swal.fire("Department Unassigning Success ! ","","success");';
       echo '},);</script>';

     }
      //Revoke Department Officer//

      //DISPLAY EVENT ON FACULTY MANAGE MODULE//
     if(isset($_POST["events_id"]))
     {
          $user = $_SESSION['username'];
          $checkquery = "SELECT * FROM accounts WHERE id ='$user'";
          $resultquery = mysqli_query($db,$checkquery);
          while($row = mysqli_fetch_array($resultquery))
          {
          $dept = $row['department'];
          $output = '';
          $connect = mysqli_connect("localhost", "root", "", "eas");
          $query = "SELECT
          tmpevent.id,
          tmpevent.name,
          tmpevent.start_time,
          tmpevent.end_time,
          tmpevent.second_start,
          tmpevent.second_end,
          tmpevent.third_start,
          tmpevent.third_end,
          tmpevent.fourth_start,
          tmpevent.fourth_end,
          tmpevent.eqv_first,
          tmpevent.eqv_second,
          tmpevent.eqv_third,
          tmpevent.eqv_fourth,
          tmpparticipants.first_p,
          tmpparticipants.second_p,
          tmpparticipants.third_p,
          tmpparticipants.fourth_p
          FROM tmpevent, tmpparticipants
          WHERE tmpparticipants.event_id = tmpevent.id AND tmpevent.department = '$dept' AND tmpevent.id = '".$_POST["events_id"]."' LIMIT 1";
          $result = mysqli_query($connect, $query);
          $output .= '
          <form method="POST">';
          while($row = mysqli_fetch_array($result))
          {
                $id = $row["id"];
                $name = $row['name'];

                $first_start = $row['start_time'];
                $first_end = $row['end_time'];
                $eqv1 = $row['eqv_first'];

                $second_start = $row['second_start'];
                $second_end = $row['second_end'];
                $eqv2 = $row['eqv_second'];

                $third_start = $row['third_start'];
                $third_end = $row['third_end'];
                $eqv3 = $row['eqv_third'];

                $fourth_start = $row['fourth_start'];
                $fourth_end = $row['fourth_end'];
                $eqv4 = $row['eqv_fourth'];

                $p1 = $row['first_p'];
                $p2 = $row['second_p'];
                $p3 = $row['third_p'];
                $p4 = $row['fourth_p'];

                $part = '('. $p1 . ') (' . $p2 . ') (' . $p3 . ') (' . $p4 . ')';

               $output .= '
                    <div align="center">
                    <label hidden>Event ID</label>
                    <input type="text" name="event_id" class="form-control" value="'.$id.'" readonly hidden>
                    <p><b>ACTIVITY NAME</b></p>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.strtoupper($name).'" readonly>
                    <br>
                    <p><b>FIRST ATTENDANCE</b></p>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.$first_start.'" readonly>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.$first_end.'" readonly>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.$eqv1.'" readonly>
                    <br>
                    <p><b>SECOND ATTENDANCE</b></p>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.$second_start.'" readonly>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.$second_end.'" readonly>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.$eqv2.'" readonly>
                    <br>
                    <p><b>THIRD ATTENDANCE</b></p>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.$third_start.'" readonly>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.$third_end.'" readonly>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.$eqv3.'" readonly>
                    <br>
                    <p><b>FOURTH ATTENDANCE</b></p>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.$fourth_start.'" readonly>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.$fourth_end.'" readonly>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.$eqv4.'" readonly>
                    <br>
                    <p><b>ATTENDEE</b></p>
                    <input type="text" style="text-align:center;" name="event_name" class="form-control" value="'.$part.'" readonly>
                    </div>
                    ';
          }
          $output .= "</form>";
          echo $output;
        }

     }
    //DISPLAY EVENT ON FACULTY MANAGE MODULE//

    //SET EVENT FOR FACULTY//
     if(isset($_POST["delete_event"]))
     {
       $id = mysqli_real_escape_string($db,$_POST['event_id']);

       $sql = "DELETE FROM events WHERE id = '".$id."'";
       $result = mysqli_query($db, $sql);

       echo '<script type="text/javascript">';
       echo 'setTimeout(function () { Swal.fire("Event Has been Deleted ! ","","success");';
       echo '},);</script>';

     }
    //SET EVENT FOR FACULTY//

    //SET EVENT ON FACULTY MANAGE MODULE//
   if(isset($_POST["event_set_id"]))
   {
        $output = '';
        $connect = mysqli_connect("localhost", "root", "", "eas");
        $query = "SELECT * FROM events WHERE id = '".$_POST["event_set_id"]."'";
        $result = mysqli_query($connect, $query);
        $output .= '
        <form method="POST">';
        while($row = mysqli_fetch_array($result))
        {
              $id = $row["id"];
              $name = $row['name'];
              $type = $row['type'];
              $dept = $row['department'];

             $output .= '
                 <label><b>ACTIVITY DATE</b></label>
                  <input type="date" name="start_date" class="form-control" id = "datetimepicker" required>
                  <input type="text" name="event_id" class="form-control" value="'.$id.'" readonly hidden>
                  <input type="text" name="event_name" class="form-control" value="'.$name.'" readonly hidden>
                  <input type="text" name="event_type" class="form-control" value="'.$type.'" readonly hidden>
                  <input type="text" name="event_dept" class="form-control" value="'.$dept.'" readonly hidden >
                  ';
        }
        $output .= "</form>";
        echo $output;

   }
  //SET EVENT ON FACULTY MANAGE MODULE//

  //SET EVENT FOR FACULTY//
   if(isset($_POST["setevent_current"]))
   {
     $eventid = mysqli_real_escape_string($db,$_POST['event_id']);
     $eventname = mysqli_real_escape_string($db,$_POST['event_name']);
     $eventstart = mysqli_real_escape_string($db,$_POST['start_date']);
     $eventtype = mysqli_real_escape_string($db,$_POST['event_type']);
     $eventdept = mysqli_real_escape_string($db,$_POST['event_dept']);

     $st = 1;
     $sql = "INSERT INTO tmpevent (id, name, start_date, end_date, type, department)
     VALUES('$eventid', '$eventname', '$eventstart' , '$eventstart' , '$eventtype', '$eventdept')";
     $result = mysqli_query($db, $sql);
     $sql2 = "INSERT INTO tmpsched (id) VALUES ('$eventid')";
     $result2 = mysqli_query($db, $sql2);
     $sql3 = "INSERT INTO tmpeqv (id) VALUES ('$eventid')";
     $result3 = mysqli_query($db, $sql3);
     $sql4 = "INSERT INTO tmpparticipants (event_id)
     VALUES ('$eventid')";
     $result4 = mysqli_query($db, $sql4);
     $sql3 = "UPDATE events SET flag = '".$st."' WHERE id = '".$eventid."'";
     $result3 = mysqli_query($db, $sql3);
     echo '<script type="text/javascript">';
     echo 'setTimeout(function () { Swal.fire("Event Attendance Has been set! ","","success");';
     echo '},);</script>';

   }
  //SET EVENT FOR FACULTY//

  //SET EVENT ON FACULTY MANAGE MODULE//
  if(isset($_POST["set_time_id"]))
  {
       $output = '';
       $connect = mysqli_connect("localhost", "root", "", "eas");
       $query =
       "SELECT
       timesched.1,
       timesched.2,
       timesched.3,
       timesched.4,
       timesched.5,
       timesched.6,
       timesched.7,
       timesched.8,
       timesched.9,
       timesched.10,
       tmpevent.id,
       tmpevent.name,
       tmpevent.department,
       tmpevent.start_time,
       tmpevent.end_time,
       tmpevent.eqv_first,
       tmpevent.second_start,
       tmpevent.second_end,
       tmpevent.eqv_second,
       tmpevent.third_start,
       tmpevent.third_end,
       tmpevent.eqv_third,
       tmpevent.fourth_start,
       tmpevent.fourth_end,
       tmpevent.eqv_fourth,
       tmpparticipants.first_p,
       tmpparticipants.second_p,
       tmpparticipants.third_p,
       tmpparticipants.fourth_p
       FROM tmpevent,timesched,tmpparticipants
       WHERE tmpevent.id = '".$_POST["set_time_id"]."' LIMIT 1";
       $result = mysqli_query($connect, $query);

       $output .= '
       <form method="POST">';
       while($row = mysqli_fetch_array($result))
       {
             $id = $row["id"];
             $name = $row['name'];
             $dept = $row['department'];
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
             $t1 = $row['1'];
             $t2 = $row['2'];
             $t3 = $row['3'];
             $t4 = $row['4'];
             $t5 = $row['5'];
             $t6 = $row['6'];
             $t7 = $row['7'];
             $t8 = $row['8'];
             $t9 = $row['9'];
             $t10 = $row['10'];
             $first = $row['first_p'];
             $second = $row['second_p'];
             $third = $row['third_p'];
             $fourth = $row['fourth_p'];

            $output .= '
                <input type="text" name="event_id" class="form-control" value="'.$id.'" readonly hidden>
                <input type="text" name="event_name" class="form-control" value="'.$name.'" readonly hidden>
                <input type="text" name="event_dept" class="form-control" value="'.$dept.'" readonly hidden>

                <div align="right">
                <input type="button" class="btn btn-success" value="+" onclick="myFunction()"></button>
                </div>
                <div id="myDIV">
                <label><b>FIRST ATTENDANCE</b></label>
                <select name="first_start" class="form-control">
                  <option hidden>'.$first_start.'</option>
                  <option value="00:00:00">NO TIME</option>
                  <option value='.$t1.'>'.$t1.'</option>
                  <option value='.$t2.'>'.$t2.'</option>
                  <option value='.$t3.'>'.$t3.'</option>
                  <option value='.$t4.'>'.$t4.'</option>
                  <option value="00:00:00">LUNCH BREAK</option>
                  <option value='.$t6.'>'.$t6.'</option>
                  <option value='.$t7.'>'.$t7.'</option>
                  <option value='.$t8.'>'.$t8.'</option>
                  <option value='.$t9.'>'.$t9.'</option>
                  <option value='.$t10.'>'.$t10.'</option>
                </select>
                <select name="first_end" class="form-control">
                  <option hidden>'.$first_end.'</option>
                  <option value="00:00:00">NO TIME</option>
                  <option value='.$t1.'>'.$t1.'</option>
                  <option value='.$t2.'>'.$t2.'</option>
                  <option value='.$t3.'>'.$t3.'</option>
                  <option value='.$t4.'>'.$t4.'</option>
                  <option value="00:00:00">LUNCH BREAK</option>
                  <option value='.$t6.'>'.$t6.'</option>
                  <option value='.$t7.'>'.$t7.'</option>
                  <option value='.$t8.'>'.$t8.'</option>
                  <option value='.$t9.'>'.$t9.'</option>
                  <option value='.$t10.'>'.$t10.'</option>
                </select>
                <input type="text" class="form-control" value="'.$first_eqv.'" name="first" placeholder="Enter Equivalent Points">
                <br>
                </div>
                <hr>

                <div align="right">
                <input type="button" class="btn btn-success" value="+" onclick="myFunction2()"></button>
                </div>
                <div id="myDIV2">
                <label><b>SECOND ATTENDANCE</b></label>
                <select name="second_start" class="form-control">
                  <option hidden>'.$second_start.'</option>
                  <option value="00:00:00">NO TIME</option>
                  <option value='.$t1.'>'.$t1.'</option>
                  <option value='.$t2.'>'.$t2.'</option>
                  <option value='.$t3.'>'.$t3.'</option>
                  <option value='.$t4.'>'.$t4.'</option>
                  <option value="00:00:00">LUNCH BREAK</option>
                  <option value='.$t6.'>'.$t6.'</option>
                  <option value='.$t7.'>'.$t7.'</option>
                  <option value='.$t8.'>'.$t8.'</option>
                  <option value='.$t9.'>'.$t9.'</option>
                  <option value='.$t10.'>'.$t10.'</option>
                </select>
                <select name="second_end" class="form-control">
                  <option hidden>'.$second_end.'</option>
                  <option value="00:00:00">NO TIME</option>
                  <option value='.$t1.'>'.$t1.'</option>
                  <option value='.$t2.'>'.$t2.'</option>
                  <option value='.$t3.'>'.$t3.'</option>
                  <option value='.$t4.'>'.$t4.'</option>
                  <option value="00:00:00">LUNCH BREAK</option>
                  <option value='.$t6.'>'.$t6.'</option>
                  <option value='.$t7.'>'.$t7.'</option>
                  <option value='.$t8.'>'.$t8.'</option>
                  <option value='.$t9.'>'.$t9.'</option>
                  <option value='.$t10.'>'.$t10.'</option>
                </select>
                <input type="text" class="form-control" value="'.$second_eqv.'" name="second" placeholder="Enter Equivalent Points">
                <br>
                </div>
                <hr>

                <div align="right">
                <input type="button" class="btn btn-success" value="+" onclick="myFunction3()"></button>
                </div>
                <div id="myDIV3">
                <label><b>THIRD ATTENDANCE</b></label>
                <select name="third_start" class="form-control">
                  <option hidden>'.$third_start.'</option>
                  <option value="00:00:00">NO TIME</option>
                  <option value='.$t1.'>'.$t1.'</option>
                  <option value='.$t2.'>'.$t2.'</option>
                  <option value='.$t3.'>'.$t3.'</option>
                  <option value='.$t4.'>'.$t4.'</option>
                  <option value="00:00:00">LUNCH BREAK</option>
                  <option value='.$t6.'>'.$t6.'</option>
                  <option value='.$t7.'>'.$t7.'</option>
                  <option value='.$t8.'>'.$t8.'</option>
                  <option value='.$t9.'>'.$t9.'</option>
                  <option value='.$t10.'>'.$t10.'</option>
                </select>
                <select name="third_end" class="form-control">
                  <option hidden>'.$third_end.'</option>
                  <option value="00:00:00">NO TIME</option>
                  <option value='.$t1.'>'.$t1.'</option>
                  <option value='.$t2.'>'.$t2.'</option>
                  <option value='.$t3.'>'.$t3.'</option>
                  <option value='.$t4.'>'.$t4.'</option>
                  <option value="00:00:00">LUNCH BREAK</option>
                  <option value='.$t6.'>'.$t6.'</option>
                  <option value='.$t7.'>'.$t7.'</option>
                  <option value='.$t8.'>'.$t8.'</option>
                  <option value='.$t9.'>'.$t9.'</option>
                  <option value='.$t10.'>'.$t10.'</option>
                </select>
                <input type="text" class="form-control" value="'.$third_eqv.'" name="third" placeholder="Enter Equivalent Points">
                <br>
                </div>
                <hr>

                <div align="right">
                <input type="button" class="btn btn-success" value="+" onclick="myFunction4()"></button>
                </div>
                <div id="myDIV4">
                <label><b>FOURTH ATTENDANCE</b></label>
                <select name="fourth_start" class="form-control">
                  <option hidden>'.$fourth_start.'</option>
                  <option value="00:00:00">NO TIME</option>
                  <option value='.$t1.'>'.$t1.'</option>
                  <option value='.$t2.'>'.$t2.'</option>
                  <option value='.$t3.'>'.$t3.'</option>
                  <option value='.$t4.'>'.$t4.'</option>
                  <option value="00:00:00">LUNCH BREAK</option>
                  <option value='.$t6.'>'.$t6.'</option>
                  <option value='.$t7.'>'.$t7.'</option>
                  <option value='.$t8.'>'.$t8.'</option>
                  <option value='.$t9.'>'.$t9.'</option>
                  <option value='.$t10.'>'.$t10.'</option>
                </select>
                <select name="fourth_end" class="form-control">
                  <option hidden>'.$fourth_end.'</option>
                  <option value="00:00:00">NO TIME</option>
                  <option value='.$t1.'>'.$t1.'</option>
                  <option value='.$t2.'>'.$t2.'</option>
                  <option value='.$t3.'>'.$t3.'</option>
                  <option value='.$t4.'>'.$t4.'</option>
                  <option value="00:00:00">LUNCH BREAK</option>
                  <option value='.$t6.'>'.$t6.'</option>
                  <option value='.$t7.'>'.$t7.'</option>
                  <option value='.$t8.'>'.$t8.'</option>
                  <option value='.$t9.'>'.$t9.'</option>
                  <option value='.$t10.'>'.$t10.'</option>
                </select>
                <input type="text" class="form-control" value="'.$fourth_eqv.'" name="fourth" placeholder="Enter Equivalent Points">
                <br>
                </div>
                <hr>

                <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
                      <tbody align="center">
                <form method="POST">
                <tr>
                   <td width="10%"><input type="checkbox" name="1st" value="1st - Year" '.(($first=="1st - Year")?"checked='checked'":"").'> <b>FIRST YEAR</b></td>
                   <td width="10%"><input type="checkbox" name="2nd" value="2nd - Year" '.(($second=="2nd - Year")?"checked='checked'":"").'> <b>SECOND YEAR</b></td>
                   <td width="10%"><input type="checkbox" name="3rd" value="3rd - Year" '.(($third=="3rd - Year")?"checked='checked'":"").'> <b>THIRD YEAR</b></td>
                   <td width="10%"><input type="checkbox" name="4th" value="4th - Year" '.(($fourth=="4th - Year")?"checked='checked'":"").'> <b>FOURTH YEAR</b></td>
                </tr>
                 ';
       }
       $output .= "</form>
       </div>
       </table>";
       echo $output;

  }
//SET EVENT ON FACULTY MANAGE MODULE//

//SET EVENT FOR FACULTY//
 if(isset($_POST["set_event_time"]))
 {
   error_reporting(0);
   ini_set('display_errors', 0);
   $eventid = mysqli_real_escape_string($db,$_POST['event_id']);
   $eventname = mysqli_real_escape_string($db,$_POST['event_name']);
   $firststart = mysqli_real_escape_string($db,$_POST['first_start']);
   $firstend = mysqli_real_escape_string($db,$_POST['first_end']);
   $secondstart = mysqli_real_escape_string($db,$_POST['second_start']);
   $secondend = mysqli_real_escape_string($db,$_POST['second_end']);
   $thirdstart = mysqli_real_escape_string($db,$_POST['third_start']);
   $thirdend = mysqli_real_escape_string($db,$_POST['third_end']);
   $fourthstart = mysqli_real_escape_string($db,$_POST['fourth_start']);
   $fourthend = mysqli_real_escape_string($db,$_POST['fourth_end']);
   $eqv1 = mysqli_real_escape_string($db,$_POST['first']);
   $eqv2 = mysqli_real_escape_string($db,$_POST['second']);
   $eqv3 = mysqli_real_escape_string($db,$_POST['third']);
   $eqv4 = mysqli_real_escape_string($db,$_POST['fourth']);
   $p1 = mysqli_real_escape_string($db,$_POST['1st']);
   $p2 = mysqli_real_escape_string($db,$_POST['2nd']);
   $p3 = mysqli_real_escape_string($db,$_POST['3rd']);
   $p4 = mysqli_real_escape_string($db,$_POST['4th']);

   $sql = "UPDATE tmpevent SET
   start_time = '".$firststart."' ,
   end_time = '".$firstend."' ,
   eqv_first = '".$eqv1."' ,

   second_start= '".$secondstart."' ,
   second_end = '".$secondend."' ,
   eqv_second = '".$eqv2."' ,

   third_start= '".$thirdstart."' ,
   third_end = '".$thirdend."' ,
   eqv_third = '".$eqv3."' ,

   fourth_start = '".$fourthstart."' ,
   fourth_end = '".$fourthend."',
   eqv_fourth = '".$eqv4."'

   WHERE id = '".$eventid."'";
   $result = mysqli_query($db, $sql);

   $fin = ($eqv1+$eqv2+$eqv3+$eqv4);

   $sql2 = "UPDATE events SET
   eqv = '".$fin."' ,
   p1 = '".$p1."' ,
   p2 = '".$p2."' ,
   p3 = '".$p3."' ,
   p4 = '".$p4."'
   WHERE id = '".$eventid."'";
   $result2 = mysqli_query($db, $sql2);

   $sql3 = "UPDATE tmpsched SET
   first_start = '".$firststart."' ,
   first_end = '".$firstend."' ,

   second_start= '".$secondstart."' ,
   second_end = '".$secondend."' ,

   third_start= '".$thirdstart."' ,
   third_end = '".$thirdend."' ,

   fourth_start = '".$fourthstart."' ,
   fourth_end = '".$fourthend."'
   WHERE id = '".$eventid."'";
   $result3 = mysqli_query($db, $sql3);

   $sql4 = "UPDATE tmpeqv SET
   eqv_first = '".$eqv1."' ,
   eqv_second = '".$eqv2."' ,
   eqv_third = '".$eqv3."' ,
   eqv_fourth = '".$eqv4."'
   WHERE id = '".$eventid."'";
   $result4 = mysqli_query($db, $sql4);

   $sql1 = "UPDATE tmpparticipants SET
   first_p = '".$p1."' ,
   second_p = '".$p2."' ,
   third_p = '".$p3."' ,
   fourth_p = '".$p4."'
   WHERE event_id = '".$eventid."'";
   $result1 = mysqli_query($db, $sql1);

   echo '<script type="text/javascript">';
   echo 'setTimeout(function () { Swal.fire("Attendance Time has been Set !","","success");';
   echo '},);</script>';

   echo '
          <script type="text/javascript">
              function myFunction() {
                var x = document.getElementById("myDIV");
                if (x.style.display === "none") {
                  x.style.display = "block";
                } else {
                  x.style.display = "none";
                }
              }
              function myFunction2() {
                var x = document.getElementById("myDIV2");
                if (x.style.display === "none") {
                  x.style.display = "block";
                } else {
                  x.style.display = "none";
                }
              }
              function myFunction3() {
                var x = document.getElementById("myDIV3");
                if (x.style.display === "none") {
                  x.style.display = "block";
                } else {
                  x.style.display = "none";
                }
              }
              function myFunction4() {
                var x = document.getElementById("myDIV4");
                if (x.style.display === "none") {
                  x.style.display = "block";
                } else {
                  x.style.display = "none";
                }
              }
          </script>

          ';

 }
//SET EVENT FOR FACULTY//

//SET EVENT PARTICIPANTS ON FACULTY MANAGE MODULE//
if(isset($_POST["set_part_id"]))
{
    $output = '';
    $connect = mysqli_connect("localhost", "root", "", "eas");
    $query = "SELECT * FROM tmpparticipants WHERE event_id = '".$_POST["set_part_id"]."'";
    $result = mysqli_query($connect, $query);
    $output .= '
    <div class="table-responsive">
    <table id="example2" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
          <tbody align="center">
    <form method="POST">';
    while($row = mysqli_fetch_array($result))
    {
          $id = $row["event_id"];
          $first = $row['first_p'];
          $second = $row['second_p'];
          $third = $row['third_p'];
          $fourth = $row['fourth_p'];
         $output .= '
             <input type="text" name="event_id" class="form-control" value="'.$id.'" readonly hidden>
             <tr>
                <td width="10%"><input type="checkbox" name="1st" value="1st - Year"> <b>First Year</b></td>
                <td width="10%"><input type="checkbox" name="2nd" value="2nd - Year"> <b>Second Year</b></td>
                <td width="10%"><input type="checkbox" name="3rd" value="3rd - Year"> <b>Third Year</b></td>
                <td width="10%"><input type="checkbox" name="4th" value="4th - Year"> <b>Fourth Year</b></td>
             </tr>
              ';
    }
    $output .= "</form>
    </div>
    </table>";
    echo $output;

}
//SET EVENT PARTICIPANTS ON FACULTY MANAGE MODULE//

//SET EVENT PARTICIPANT FOR FACULTY//
 if(isset($_POST["set_part"]))
 {
   error_reporting(0);
   ini_set('display_errors', 0);

   $eventid = mysqli_real_escape_string($db,$_POST['event_id']);
   $p1 = mysqli_real_escape_string($db,$_POST['1st']);
   $p2 = mysqli_real_escape_string($db,$_POST['2nd']);
   $p3 = mysqli_real_escape_string($db,$_POST['3rd']);
   $p4 = mysqli_real_escape_string($db,$_POST['4th']);

   $sql1 = "UPDATE tmpparticipants SET
   first_p = '".$p1."' ,
   second_p = '".$p2."' ,
   third_p = '".$p3."' ,
   fourth_p = '".$p4."'
   WHERE event_id = '".$eventid."'";
   $result1 = mysqli_query($db, $sql1);

   echo '<script type="text/javascript">';
   echo 'setTimeout(function () { Swal.fire("Attendance Participants has been Set !","","success");';
   echo '},);</script>';

 }
//SET EVENT PARTICIPANT FOR FACULTY//


  //ADD EVENT FOR FACULTY//
   if(isset($_POST["add_event"]))
   {
     $eventname = mysqli_real_escape_string($db,$_POST['event_name']);
     $eventtype = mysqli_real_escape_string($db,$_POST['event_type']);
     $eventdept = mysqli_real_escape_string($db,$_POST['event_dept']);

     $sql1 = "SELECT * FROM tmp";
     $result1 = mysqli_query($db, $sql1);
     while($row = mysqli_fetch_array($result1))
     {
       $s_y = $row['year'];
       $sql = "INSERT INTO events (name, sy, type, department)
       VALUES('$eventname', '$s_y', '$eventtype', '$eventdept')";
       $result = mysqli_query($db, $sql);

     }
     echo '<script type="text/javascript">';
     echo 'setTimeout(function () { Swal.fire("Event Has been Added ! ","","success");';
     echo '},);</script>';

   }
  //ADD EVENT FOR FACULTY//

  //REVOKE EVENT DATA ON FACULTY MANAGE MODULE//
  if(isset($_POST["event_unset_id"]))
  {
       $output = '';
       $connect = mysqli_connect("localhost", "root", "", "eas");
       $query = "SELECT * FROM tmpevent WHERE id = '".$_POST["event_unset_id"]."'";
       $result = mysqli_query($connect, $query);
       $output .= '
       <form method="POST">';
       while($row = mysqli_fetch_array($result))
       {
             $id = $row["id"];

            $output .= '
                 <input type="text" name="event_id" class="form-control" value="'.$id.'" readonly hidden>
                 ';
       }
       $output .= "</form>";
       echo $output;

  }

 //REVOKE EVENT DATA ON FACULTY MANAGE MODULE//

    //Revoke Event Officer//
    if(isset($_POST["event_unset"]))
    {
      $eventid = mysqli_real_escape_string($db,$_POST['event_id']);
        $st = 0;
        $sqlrem = "DELETE FROM tmpevent WHERE id = '".$eventid."'";
        $sqlrem2 = "DELETE FROM tmpsched WHERE id = '".$eventid."'";
        $sqlrem3 = "DELETE FROM tmpeqv WHERE id = '".$eventid."'";
        $sql2 = "DELETE FROM tmpparticipants WHERE event_id = '$eventid'";
        $sql3 = "UPDATE events SET flag = '".$st."' WHERE id = '$eventid'";
        $result3 = mysqli_query($db, $sql3);
        $result2 = mysqli_query($db, $sql2);
        $resultrem = mysqli_query($db, $sqlrem);
        $resultrem2 = mysqli_query($db, $sqlrem2);
        $resultrem3 = mysqli_query($db, $sqlrem3);
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { Swal.fire("Event Attendance has been Unset! ","","success");';
        echo '},);</script>';

    }
     //Revoke Event Officer//

     //DELETE EVENT DATA ON FACULTY MANAGE MODULE//
     if(isset($_POST["delete_id"]))
     {
          $output = '';
          $connect = mysqli_connect("localhost", "root", "", "eas");
          $query = "SELECT * FROM events WHERE id = '".$_POST["delete_id"]."'";
          $result = mysqli_query($connect, $query);
          $output .= '
          <form method="POST">';
          while($row = mysqli_fetch_array($result))
          {
                $id = $row["id"];
                $name = $row['name'];

               $output .= '
                    <input type="text" name="event_id" class="form-control" value="'.$id.'" readonly hidden>
                    <h6>Delete Event: '.$name.' ?</h6>
                    ';
          }
          $output .= "</form>";
          echo $output;

     }

    //DELETE EVENT DATA ON FACULTY MANAGE MODULE//

       //DELETE Event Officer//
       if(isset($_POST["del_event"]))
       {
         $eventid = mysqli_real_escape_string($db,$_POST['event_id']);

           $sqlrem = "DELETE FROM events WHERE id = '".$eventid."'";
           $resultrem = mysqli_query($db, $sqlrem);
           $sql = "DELETE FROM tmpevent WHERE id = '".$eventid."'";
           $result = mysqli_query($db, $sql);
           echo '<script type="text/javascript">';
           echo 'setTimeout(function () { Swal.fire("Event has been Deleted ! ","","success");';
           echo '},);</script>';

       }
        //DELETE Event Officer//

        //VIEW EVENT ATTENDANCE ON FACULTY MANAGE MODULE//
if(isset($_POST["attendance_id"]))
{
     error_reporting(0);
     ini_set('display_errors', 0);
     $output = '';
     $ses = $_SESSION['username'];
     $check = "SELECT * FROM accounts WHERE id = '$ses'";
     $res = mysqli_query($db,$check);
     $year_level="year_level";
     $querya="";

     while($row = mysqli_fetch_array($res))
     {
       $dep = $row['department'];
     }
     $connect = mysqli_connect("localhost", "root", "", "eas");

     $query2 = "SELECT concat(cast(`p1` as int),cast(`p2` as int),cast(`p3` as int),cast(`p4` as int))  as year_level from events
     WHERE events.id = '".$_POST["attendance_id"]."'  ";

     $result2 = mysqli_query($connect, $query2);
     while($row = mysqli_fetch_array($result2))
     {
       $year_level= $row['year_level'];
       $queryb=false;

         if (strstr($year_level,'1') ){
           if ( $queryb==true){
             $querya=$querya.' || year_level = ';
             $querya=$querya.'"1st - Year"';
           }
           else if( $queryb==false){
             $querya=$querya.' and   (year_level = ';
             $querya=$querya.'"1st - Year"';
              $queryb=true;
           }

         }
         if (strstr($year_level,'2') ){
           if ( $queryb==true){
             $querya=$querya.' || year_level = ';
             $querya=$querya.'"2nd - Year"';
           }
           else if($queryb==false){
             $querya=$querya.' and (year_level = ';
             $querya=$querya.'"2nd - Year"';
             $queryb=true;
           }
         }

         if (strstr($year_level,'3') ){
           if ( $queryb==true){
             $querya=$querya.' || year_level = ';
             $querya=$querya.'"3rd - Year"';
           }
           else if($queryb==false){
             $querya=$querya.' and (year_level = ';
             $querya=$querya.'"3rd - Year"';
             $queryb=true;
           }
         }

         if (strstr($year_level,'4') ){
           if ( $queryb==true){
             $querya=$querya.' || year_level = ';
             $querya=$querya.'"4th - Year"';
           }
           else if($queryb==false){
             $querya=$querya.' and (year_level = ';
             $querya=$querya.'"4th - Year"';
             $queryb=true;
           }
         }
              $querya=$querya.' )';
}

     $_SESSION['$querya']=$querya;


     $query = "SELECT events.name as event_name from events
     WHERE events.id = '".$_POST["attendance_id"]."'  ";

     $result = mysqli_query($connect, $query);
     while($row = mysqli_fetch_array($result))
     {
           $events_name= $row['event_name'];
     }

     $query ="SELECT `stud_id`, `stud_name`, `stud_department`, `event_name`,year_level, `School Year`, `Attendance`, `Deficiency`, `Total Points`, `Percentage`
     FROM `per_event_year_points` where  event_name= '".$events_name."' and stud_department='$dep' and `School Year` = '".$setsy_year."' ".$querya." ORDER BY year_level ASC";
     $event = strtoupper($events_name);

     $result = mysqli_query($connect, $query);
     echo '<div class="alert alert-primary" role="alert">';
     echo "<h4 class='modal-title' id='exampleModalLabel' align='center' style='color:'>$event</h4>";
     echo '</div>';

     $output .= '
       <div class="table-responsive">
       <table id="example5" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
             <thead align="center">
               <tr>
                 <th>YEAR</th>
                 <th>NAME</th>
                 <th>EQUIVALENT POINTS</th>
                 <th>ATTENDANCE</th>
               </tr>
             </thead>
             <tbody align="center">
             <form method="POST">

     ';
     while($row = mysqli_fetch_array($result))
     {
           $stud_id = $row['stud_id'];
           $name = $row['stud_name'];
           $stud_department = $row['stud_department'];
           $event_name = $row['event_name'];
           $School_Year = $row['School Year'];
           $Attendance = $row['Attendance'];
           $Deficiency = $row['Deficiency'];
           $Total = $row['Total Points'];
           $year = $row['year_level'];

           if($Deficiency == $Total){
             $stats = "<p class='btn btn-danger'>X</p>";
             echo "</i>";
           }
           else if($Deficiency == 0){
             $stats = "<p class='btn btn-success'>✓</p>";
           }
           else{
             $stats = "<p class='btn btn-warning'>&nbsp;<b>!</b>&nbsp;</p>";
           }

          $output .= '

              <tr>
                <td>'.$year.'</td>
                <td>'.$name.'</td>
                <td>'.$Total.'</td>
                <td>'.$stats.'</td>
              </tr>
               ';
               }
                 $output .= "
                         </tbody>
                       </table>
                     </div>
                  <input type='text' name='event_report' value='$event_name' hidden>
                </form>
                <script>
                $(document).ready(function() {
                   $.fn.DataTable.ext.pager.numbers_length = 5;
                     $('#example5').DataTable( {
                        'pagingType':'full_numbers',
                        'order': [[ 0, 'asc' ]]
                     } );
                  } );
                </script>
                ";
               echo $output;

          }

        //VIEW EVENT ATTENDANCE ON FACULTY MANAGE MODULE//

        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//
        if(isset($_POST["absent_id"]))
        {
             error_reporting(0);
             ini_set('display_errors', 0);
             $event_id = $_POST["absent_id"];
             $output = '';
             $connect = mysqli_connect("localhost", "root", "", "eas");
             $try = $_SESSION['username'];
             $id = $_POST['event_id'];
             $results = mysqli_query($db,
              "SELECT
              accounts.id,
              accounts.pw,
              accounts.name,
              accounts.type,
              accounts.department,
              tmpparticipants.event_id,
              tmpparticipants.first_p,
              tmpparticipants.second_p,
              tmpparticipants.third_p,
              tmpparticipants.fourth_p
              FROM accounts,tmpparticipants
              WHERE accounts.id = '$try'
              AND tmpparticipants.event_id = '$event_id'");
               while ($row = mysqli_fetch_array($results))
               {
                 $dept = $row['department'];
                 $par1 = $row['first_p'];
                 $par2 = $row['second_p'];
                 $par3 = $row['third_p'];
                 $par4 = $row['fourth_p'];
                   $query = "SELECT
                    student.id,
                    student.name,
                    student.year_level
                    FROM student,tmpparticipants
                    WHERE
                    (
                      student.year_level = tmpparticipants.first_p
                      OR student.year_level = tmpparticipants.second_p
                      OR student.year_level = tmpparticipants.third_p
                      OR student.year_level = tmpparticipants.fourth_p
                    )
                    AND
                    department = '$dept'
                    AND
                    NOT EXISTS
                    (
                        SELECT
                        attendance.stud_id
                        FROM attendance
                        WHERE student.id = attendance.stud_id
                        AND
                        event_id = '$event_id'
                    )";
                   $result = mysqli_query($connect, $query);
                 $output .= '
                   <div class="table-responsive">
                     <table id="example" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
                         <thead align="center">
                           <tr>
                             <th>ID Number</th>
                             <th>Student Name</th>
                           </tr>
                         </thead>
                         <tbody align="center">
                         <form method="POST">
                 ';
                 while($row = mysqli_fetch_array($result))
                 {
                       $name = $row['name'];
                       $id = $row['id'];

                      $output .= '

                          <tr>
                            <td>'.$id.'</td>
                            <td>'.$name.'</td>
                          </tr>
                           ';
                 }
                   $output .= "
                           </tbody>
                         </table>
                       </div>
                    <input type='text' name='event_id' value='$event_id' hidden>
                  </form>
                  <script>
                  $(document).ready(function() {
                     $.fn.DataTable.ext.pager.numbers_length = 5;
                       $('#example').DataTable( {
                          'pagingType':'full_numbers',
                       } );
                    } );
                  </script>
                  ";
                 echo $output;

        }
      }

        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//


        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//
        if(isset($_POST["fines_id_cs"]))
        {
          //error_reporting(0);
          //ini_set('display_errors', 0);
          $stud_id = $_POST["fines_id_cs"];
          //$stud_dept = $_POST["dept"];
          $output = '';
          $connect = mysqli_connect("localhost", "root", "", "eas");
          $query = "SELECT * FROM events WHERE department = 'COMPUTER STUDIES' AND id NOT IN (SELECT event_id FROM attendance WHERE stud_id = '".$stud_id."')";
          $result = mysqli_query($connect, $query);
          $output .= '
            <div class="table-responsive">
              <table id="example" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
                  <thead align="center">
                    <tr>
                      <th>Event Name</th>
                      <th>Equivalent</th>
                    </tr>
                  </thead>
                  <tbody align="center">
                  <form method="POST">
          ';
          while($row = mysqli_fetch_array($result))
          {
                $name = $row['name'];
                $fine = $row['eqv'];
               $output .= '

                   <tr>
                     <td>'.$name.'</td>
                     <td>'.$fine.'</td>

                   </tr>
                    ';
          }
            $output .= "
                    </tbody>
                  </table>
                </div>
           </form>
           <script>
           $(document).ready(function() {
              $.fn.DataTable.ext.pager.numbers_length = 5;
                $('#example').DataTable( {
                   'pagingType':'full_numbers',
                } );
             } );
           </script>
           ";
          echo $output;

        }
        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//

        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//
        if(isset($_POST["fines_id_ac"]))
        {
             //error_reporting(0);
             //ini_set('display_errors', 0);
             $stud_id = $_POST["fines_id_ac"];
             //$stud_dept = $_POST["dept"];
             $output = '';
             $connect = mysqli_connect("localhost", "root", "", "eas");
             $query =
             "SELECT *
             FROM events
             WHERE department = 'ACCOUNTANCY'
             AND id
             NOT IN
             (SELECT event_id
               FROM attendance
               WHERE stud_id =
               '".$stud_id."')";
             $result = mysqli_query($connect, $query);
             $output .= '
               <div class="table-responsive">
                 <table id="example" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
                     <thead align="center">
                       <tr>
                         <th>Event Name</th>
                         <th>Equivalent</th>
                       </tr>
                     </thead>
                     <tbody align="center">
                     <form method="POST">
             ';
             while($row = mysqli_fetch_array($result))
             {
                   $name = $row['name'];
                   $fine = $row['eqv'];
                  $output .= '

                      <tr>
                        <td>'.$name.'</td>
                        <td>'.$fine.'</td>

                      </tr>
                       ';
             }
               $output .= "
                       </tbody>
                     </table>
                   </div>
              </form>
              <script>
              $(document).ready(function() {
                 $.fn.DataTable.ext.pager.numbers_length = 5;
                   $('#example').DataTable( {
                      'pagingType':'full_numbers',
                   } );
                } );
              </script>
              ";
             echo $output;

        }
        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//

        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//
        if(isset($_POST["fines_id_ea"]))
        {
             //error_reporting(0);
             //ini_set('display_errors', 0);
             $stud_id = $_POST["fines_id_ea"];
             //$stud_dept = $_POST["dept"];
             $output = '';
             $connect = mysqli_connect("localhost", "root", "", "eas");
             $query =
             "SELECT *
             FROM events
             WHERE department = 'ENGINEERING'
             AND id
             NOT IN
             (SELECT event_id
               FROM attendance
               WHERE stud_id =
               '".$stud_id."')";
             $result = mysqli_query($connect, $query);
             $output .= '
               <div class="table-responsive">
                 <table id="example" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
                     <thead align="center">
                       <tr>
                         <th>Event Name</th>
                         <th>Equivalent</th>
                       </tr>
                     </thead>
                     <tbody align="center">
                     <form method="POST">
             ';
             while($row = mysqli_fetch_array($result))
             {
                   $name = $row['name'];
                   $fine = $row['eqv'];
                  $output .= '

                      <tr>
                        <td>'.$name.'</td>
                        <td>'.$fine.'</td>

                      </tr>
                       ';
             }
               $output .= "
                       </tbody>
                     </table>
                   </div>
              </form>
              <script>
              $(document).ready(function() {
                 $.fn.DataTable.ext.pager.numbers_length = 5;
                   $('#example').DataTable( {
                      'pagingType':'full_numbers',
                   } );
                } );
              </script>
              ";
             echo $output;

        }
        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//

        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//
        if(isset($_POST["fines_id_educ"]))
        {
             //error_reporting(0);
             //ini_set('display_errors', 0);
             $stud_id = $_POST["fines_id_educ"];
             //$stud_dept = $_POST["dept"];
             $output = '';
             $connect = mysqli_connect("localhost", "root", "", "eas");
             $query =
             "SELECT *
             FROM events
             WHERE department = 'EDUCATION'
             AND id
             NOT IN
             (SELECT event_id
               FROM attendance
               WHERE stud_id =
               '".$stud_id."')";
             $result = mysqli_query($connect, $query);
             $output .= '
               <div class="table-responsive">
                 <table id="example" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
                     <thead align="center">
                       <tr>
                         <th>Event Name</th>
                         <th>Equivalent</th>
                       </tr>
                     </thead>
                     <tbody align="center">
                     <form method="POST">
             ';
             while($row = mysqli_fetch_array($result))
             {
                   $name = $row['name'];
                   $fine = $row['eqv'];
                  $output .= '

                      <tr>
                        <td>'.$name.'</td>
                        <td>'.$fine.'</td>

                      </tr>
                       ';
             }
               $output .= "
                       </tbody>
                     </table>
                   </div>
              </form>
              <script>
              $(document).ready(function() {
                 $.fn.DataTable.ext.pager.numbers_length = 5;
                   $('#example').DataTable( {
                      'pagingType':'full_numbers',
                   } );
                } );
              </script>
              ";
             echo $output;

        }
        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//

        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//
        if(isset($_POST["fines_id_ab"]))
        {
             //error_reporting(0);
             //ini_set('display_errors', 0);
             $stud_id = $_POST["fines_id_ab"];
             //$stud_dept = $_POST["dept"];
             $output = '';
             $connect = mysqli_connect("localhost", "root", "", "eas");
             $query =
             "SELECT *
             FROM events
             WHERE department = 'AB'
             AND id
             NOT IN
             (SELECT event_id
               FROM attendance
               WHERE stud_id =
               '".$stud_id."')";
             $result = mysqli_query($connect, $query);
             $output .= '
               <div class="table-responsive">
                 <table id="example" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
                     <thead align="center">
                       <tr>
                         <th>Event Name</th>
                         <th>Equivalent</th>
                       </tr>
                     </thead>
                     <tbody align="center">
                     <form method="POST">
             ';
             while($row = mysqli_fetch_array($result))
             {
                   $name = $row['name'];
                   $fine = $row['eqv'];
                  $output .= '

                      <tr>
                        <td>'.$name.'</td>
                        <td>'.$fine.'</td>

                      </tr>
                       ';
             }
               $output .= "
                       </tbody>
                     </table>
                   </div>
              </form>
              <script>
              $(document).ready(function() {
                 $.fn.DataTable.ext.pager.numbers_length = 5;
                   $('#example').DataTable( {
                      'pagingType':'full_numbers',
                   } );
                } );
              </script>
              ";
             echo $output;

        }
        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//

        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//
        if(isset($_POST["fines_id_bhm"]))
        {
             //error_reporting(0);
             //ini_set('display_errors', 0);
             $stud_id = $_POST["fines_id_bhm"];
             //$stud_dept = $_POST["dept"];
             $output = '';
             $connect = mysqli_connect("localhost", "root", "", "eas");
             $query =
             "SELECT *
             FROM events
             WHERE department = 'BUSINESS'
             AND id
             NOT IN
             (SELECT event_id
               FROM attendance
               WHERE stud_id =
               '".$stud_id."')";
             $result = mysqli_query($connect, $query);
             $output .= '
               <div class="table-responsive">
                 <table id="example" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
                     <thead align="center">
                       <tr>
                         <th>Event Name</th>
                         <th>Equivalent</th>
                       </tr>
                     </thead>
                     <tbody align="center">
                     <form method="POST">
             ';
             while($row = mysqli_fetch_array($result))
             {
                   $name = $row['name'];
                   $fine = $row['eqv'];
                  $output .= '

                      <tr>
                        <td>'.$name.'</td>
                        <td>'.$fine.'</td>

                      </tr>
                       ';
             }
               $output .= "
                       </tbody>
                     </table>
                   </div>
              </form>
              <script>
              $(document).ready(function() {
                 $.fn.DataTable.ext.pager.numbers_length = 5;
                   $('#example').DataTable( {
                      'pagingType':'full_numbers',
                   } );
                } );
              </script>
              ";
             echo $output;

        }
        //VIEW EVENT ABSENT ON FACULTY MANAGE MODULE//

        //Change Password//
        if(isset($_POST["changepw"]))
        {
          $pw1 = $_POST['newpw'];
          $pw2 = $_POST['confpw'];
          $user = $_SESSION['username'];
          if($pw1 == $pw2){
            $connect = mysqli_connect("localhost", "root", "", "eas");
            $query = "UPDATE accounts SET pw = '".$pw1."' WHERE id = '".$user."'";
            $result = mysqli_query($connect, $query);
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { Swal.fire("Password has been changed ! ","","success");';
            echo '},);</script>';

          }
          else{
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { Swal.fire("Password Not Match ! ","Try Again","error");';
            echo '},);</script>';
          }

        }
        //Change Password//

   $connect = mysqli_connect("localhost", "root", "", "eas");
   $message = '';

   if(isset($_POST["uploadfac"]))
   {
    if($_FILES['importfac']['name'])
    {
     $filename = explode(".", $_FILES['importfac']['name']);
     if(end($filename) == "csv")
     {
      $handle = fopen($_FILES['importfac']['tmp_name'], "r");
      while($data = fgetcsv($handle))
      {
       $facult_id = mysqli_real_escape_string($connect, $data[0]);
       $faculty_name = mysqli_real_escape_string($connect, $data[1]);
       $faculty_department = mysqli_real_escape_string($connect, $data[2]);
       $faculty_bdate = mysqli_real_escape_string($connect, $data[3]);
       $query = "
       INSERT INTO faculty (id, name, department, birthdate)
                 VALUES('$facult_id', '$faculty_name', '$faculty_department', '$faculty_bdate')";
       mysqli_query($connect, $query);
      }
      fclose($handle);
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { Swal.fire("Success","Faculty List has been Imported","success");';
      echo '},);</script>';
      //header("location: adminmanage.php?updation=1");
     }
     else
     {
       echo '<script type="text/javascript">';
       echo 'setTimeout(function () { Swal.fire("UPLOAD CSV FILE ONLY","","error");';
       echo '},);</script>';     }
    }
    else
    {
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { Swal.fire("YOU DID NOT SELECT A FILE PLEASE CHOOSE ONE","","warning");';
      echo '},);</script>';    }
   }

   if(isset($_GET["updation"]))
   {
    $message = '<label class="text-success">Product Updation Done</label>';
   }

   $query = "SELECT * FROM faculty";
   $result = mysqli_query($connect, $query);

   //UPLOAD FACULTY DATA ON ADMIN MANAGE MODULE//

   //UPLOAD STUDENT DATA ON ADMIN STUDENT MODULE//

   if(isset($_POST["uploadstud"]))
   {
    if($_FILES['importstud']['name'])
    {
     $filename = explode(".", $_FILES['importstud']['name']);
     if(end($filename) == "csv")
     {
      $handle = fopen($_FILES['importstud']['tmp_name'], "r");
      while($data = fgetcsv($handle))
      {
       $stud_id = mysqli_real_escape_string($connect, $data[0]);
       $stud_tag = mysqli_real_escape_string($connect, $data[1]);
       $stud_name = mysqli_real_escape_string($connect, $data[2]);
       $stud_dept = mysqli_real_escape_string($connect, $data[3]);
       $stud_bdate = mysqli_real_escape_string($connect, $data[4]);
       $stud_sem = mysqli_real_escape_string($connect, $data[5]);
       $stud_year = mysqli_real_escape_string($connect, $data[6]);
       $stud_year_level = mysqli_real_escape_string($connect, $data[7]);
       $stud_type = "STUDENT";

       $query = "
       INSERT INTO student (id, name, department, birthdate, sem, year, year_level)
                 VALUES('$stud_id', '$stud_name', '$stud_dept', '$stud_bdate', '$stud_sem', '$stud_year','$stud_year_level')";
       mysqli_query($connect, $query);

       $query2 = "
       INSERT INTO stud_pool (id, card, name, department, birthdate, sem, year, year_level)
                 VALUES('$stud_id', '$stud_tag', '$stud_name', '$stud_dept', '$stud_bdate', '$stud_sem', '$stud_year', '$stud_year_level')";
       mysqli_query($connect, $query2);

       $query3 = "
       INSERT INTO accounts (id, pw, name, type, department)
                 VALUES('$stud_id', '$stud_bdate', '$stud_name', '$stud_type', '$stud_dept')";
       mysqli_query($connect, $query3);
      }
      fclose($handle);
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { Swal.fire("Student List has been Imported!","","success");';
      echo '},);</script>';
      //header("location: adminmanage.php?updation=1");
     }
     else
     {
       echo '<script type="text/javascript">';
       echo 'setTimeout(function () { Swal.fire("UPLOAD CSV FILE ONLY","","error");';
       echo '},);</script>';
     }
    }
    else
    {
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { Swal.fire("YOU DID NOT SELECT A FILE PLEASE CHOOSE ONE","","warning");';
      echo '},);</script>';    }
   }

   if(isset($_GET["updation"]))
   {
    $message = '<label class="text-success">Product Updation Done</label>';
   }

   $query = "SELECT * FROM student";
   $result = mysqli_query($connect, $query);

   //UPLOAD EVENT DATA ON ADMIN STUDENT MODULE//

   if(isset($_POST["uploadevent"]))
   {
    if($_FILES['eventlist']['name'])
    {
     $filename = explode(".", $_FILES['eventlist']['name']);
     if(end($filename) == "csv")
     {
      $handle = fopen($_FILES['eventlist']['tmp_name'], "r");
      while($data = fgetcsv($handle))
      {
       $name = mysqli_real_escape_string($connect, $data[0]);
       $sy = mysqli_real_escape_string($connect, $data[1]);
       $type = mysqli_real_escape_string($connect, $data[2]);
       $dept = mysqli_real_escape_string($connect, $data[3]);
       $query = "
       INSERT INTO events (name, sy, type, department)
                 VALUES('$name', '$sy', '$type', '$dept')";
       mysqli_query($connect, $query);
      }
      fclose($handle);
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { Swal.fire("Event List has been Imported!","","sucess");';
      echo '},);</script>';
      //header("location: adminmanage.php?updation=1");
     }
     else
     {
       echo '<script type="text/javascript">';
       echo 'setTimeout(function () { Swal.fire("UPLOAD CSV FILE ONLY","","error");';
       echo '},);</script>';
     }
    }
    else
    {
      echo '<script type="text/javascript">';
      echo 'setTimeout(function () { Swal.fire("YOU DID NOT SELECT A FILE PLEASE CHOOSE ONE","","warning");';
      echo '},);</script>';    }
   }

   if(isset($_GET["updation"]))
   {
    $message = '<label class="text-success">Product Updation Done</label>';
   }


   //UPLOAD EVENT DATA ON ADMIN STUDENT MODULE//

   //SET CURRENT SEMESTER AND YEAR//
   if(isset($_POST["setsy"]))
   {
     $setsem = $_POST['setsem'];
     $setyear = $_POST['setyear'];

     $query = "INSERT INTO setsy (sem, year) VALUES('$setsem', '$setyear')";
     mysqli_query($connect, $query);
     $query2 = "UPDATE tmp SET sem = '".$_POST['setsem']."' , year = '".$_POST['setyear']."' WHERE id = '1' ";
     mysqli_query($connect, $query2);
     echo '<script type="text/javascript">';
     echo 'setTimeout(function () { Swal.fire("Student List has been Imported!","","sucess");';
     echo '},);</script>';

   }


   if(isset($_POST["student_id_for_attendance"]))
   {
        $_SESSION['student_id_for_attendance']=$_POST["student_id_for_attendance"];
   }


   if(isset($_POST["ab_id"]))
   {

     $_SESSION['dep']=$_POST["ab_id"];

      if(($_POST["ab_id"])==1)
      {
      $dept='COMPUTER STUDIES';
      }
      else if (($_POST["ab_id"])==2) {
      $dept='AB';
      }
      else if (($_POST["ab_id"])==3) {
      $dept='ACCOUNTANCY';
      }
      else if (($_POST["ab_id"])==4) {
      $dept='BUSINESS';
      }
      else if (($_POST["ab_id"])==5) {
      $dept='EDUCATION';
      }
      else if (($_POST["ab_id"])==6) {
      $dept='ENGINEERING';
      }
 #'<h5 class="modal-title" id="exampleModalLabel">'echo $dept'</h5>;'
 //echo "<h6 class='modal-title' id='exampleModalLabel'>Department: ".$dept."</h6>";


     error_reporting(0);
     ini_set('display_errors', 0);
     $output = '';
     $connect = mysqli_connect("localhost", "root", "", "eas");
       $query = "SELECT `stud_id`, `stud_name`, `stud_department`, `year_level`, `Deficiency`, round(`Percentage`,0) as Percentage , `School Year`
     FROM `student_summary_attendance_per_year`
     WHERE stud_department='".$dept."' and `School Year`='2019-2020' ORDER BY `student_summary_attendance_per_year`.`stud_name` ASC";
     $result = mysqli_query($connect, $query);
     $output .= '
       <div class="table-responsive">
       <table id="example3" class="table table-striped table-bordered nowrap"  width="100%" cellspacing="0">
             <thead align="center">
               <tr>
                 <th>STUDENT NAME</th>
                 <th>YEAR</th>
                 <th>DEFICIENCY</th>
                 <th>PERCENTAGE</th>
               </tr>
             </thead>
             <tbody align="center">
             <form method="POST">
     ';
     while($row = mysqli_fetch_array($result))
     {
           $id = $row['stud_id'];
           $name = $row['stud_name'];
           $TOTAL_POINTS = $row['Deficiency'];
           $PERCENTAGE = $row['Percentage'];
           $year = $row['year_level'];

          $output .= '

              <tr>
                <td>'.$name.'</td>
                <td>'.$year.'</td>
                <td>'.$TOTAL_POINTS.'</td>
                <td>'.$PERCENTAGE.'%</td>
              </tr>
               ';
     }
       $output .= "
               </tbody>
             </table>
           </div>
        <input type='text' name='event_report' value='$event_name' hidden>
      </form>
      <script>
      $(document).ready(function() {
         $.fn.DataTable.ext.pager.numbers_length = 5;
           $('#example3').DataTable( {
              'pagingType':'full_numbers',
              'order': [[ 1, 'asc' ]]
           } );
        } );
      </script>
      ";
     echo $output;

   }
   //SET CURRENT SEMESTER AND YEAR//

   //$db = mysqli_connect("localhost" , "root" , "" , "eas");
   //$sql = "SHOW tables FROM EAS LIKE 'attendance%'";
   //$result = mysqli_query($db, $sql);
   //while($table = mysqli_fetch_array($result)) {
   //echo "<option value='". $table[0] ."'>" .$table[0] ."</option>" ;
   //}

?>
