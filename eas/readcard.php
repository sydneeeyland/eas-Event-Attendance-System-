<?php
error_reporting(0);
ini_set('display_errors', 0);
$db = mysqli_connect("localhost" , "root" , "" , "eas");
include("function.php");
date_default_timezone_set('Asia/Manila');
$cur = date("h:i:s");
$date = date("Y-m-d");
$mix = date("h:i:s M d ");
$time = date("h:i:s A (M j)");

$try = $_SESSION['username'];

if(isset($_POST['computer_studies'])){
  $query = mysqli_query($connect, "SELECT name FROM accounts WHERE id = '".$try."'");
  while($row = mysqli_fetch_array($query))
  {
      $card = $_POST['readcard'];
      $start = $_POST['start'];
      $end = $_POST['end'];
      //$finaleqv = $_POST['equivalent'];
      $event_name = $_POST['event_name'];
      $event_id = $_POST['event_id'];
      $first_p = $_POST['first_p'];
      $second_p = $_POST['second_p'];
      $third_p = $_POST['third_p'];
      $fourth_p = $_POST['fourth_p'];
      if($card == ""){
        echo "<script>alert('Card is not registered / incorrect ! ');window.location.href='catchcs.php';</script>";
      }
      else{
        $sql2 = "SELECT
        stud_pool.id,
        stud_pool.card,
        stud_pool.name,
        stud_pool.department,
        stud_pool.birthdate,
        stud_pool.sem,
        stud_pool.year,
        stud_pool.year_level,
        tmpparticipants.first_p,
        tmpparticipants.second_p,
        tmpparticipants.third_p,
        tmpparticipants.fourth_p
        FROM stud_pool,tmpparticipants WHERE stud_pool.department = 'COMPUTER STUDIES' AND stud_pool.card = '".$card."' and tmpparticipants.event_id='".$event_id."'";
        $result2 = mysqli_query($connect, $sql2);
          while($row = mysqli_fetch_array($result2))
            {
                $id = $row['id'];
                $name = $row['name'];
                $dept = $row['department'];
                $sem = $row['sem'];
                $year = $row['year'];
                $check = "";
                $year_level = $row['year_level'];

                if($year_level == $first_p ||
                   $year_level == $second_p ||
                   $year_level == $third_p ||
                   $year_level == $fourth_p) {
                      $status='true';
                     $try = "SELECT COUNT(*) AS sched FROM tmpsched WHERE  id ='".$event_id."' ";
                     $trysched = mysqli_query($connect,$try);
                     while($row = mysqli_fetch_array($trysched))
                     {
                       $start1 = $row['sched'];
                       if($start1 == 0)
                       {

                       }
                       else {


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
                           cast(substring(first_start,1,2) as int) as first_start,
                           cast(substring(first_end,1,2) as int) as first_end ,
                           cast(substring(second_start,1,2) as int) as second_start,
                           cast(substring(second_end,1,2) as int) as second_end,
                           cast(substring(third_start,1,2) as int) as third_start,
                           cast(substring(third_end,1,2) as int) as third_end,
                           cast(substring(fourth_start,1,2) as int) as fourth_start,
                           cast(substring(fourth_end,1,2) as int) as fourth_end FROM tmpsched
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

                             $time2= substr($time,0,2);
                             $time3=(int)$time2;
                               if($time3 >= $first_starta and $time3 <= $first_endb)
                               {
                                 $check=1;
                               }
                               else if($time3 >= $second_starta and $time3 <= $second_endb){

                                 $check=2;

                               }
                               else if($time3 >= $third_starta and $time3 <= $third_endb){
                                 $check=3;
                               }
                               else if($time3 >= $fourth_starta and $time3 <= $fourth_endb){

                                 $check=4;
                               }


                           }

                           $try1 = "SELECT COUNT(*) AS count1 FROM attendance WHERE  event_id = '".$event_id."' and stud_id= '".$id."' ";
                           $trycount1= mysqli_query($connect,$try1);
                           while($row = mysqli_fetch_array($trycount1))
                           {
                             $start2 = $row['count1'];
                             if($start2 != 0)
                             {


                               $sql5 = "SELECT substring(attend_time,1,2) as attend_time, attend_date   FROM attendance
                               WHERE event_id ='".$event_id."' and
                               stud_id= '".$id."' and history= '".$check."' and attend_date = date(now())";
                               $result5 = mysqli_query($connect, $sql5);
                                while($row = mysqli_fetch_array($result5))
                               {
                                 $attend_time = $row['attend_time'];
                                 $attend_date = $row['attend_date'];

                                 if ($attend_date==date("Y-m-d"))
                                 {

                                   if ( $attend_time >= $first_start1 &&  $attend_time <= $first_end2 )
                                   {
                                     $status="false";

                                   }

                                   else if ($attend_time >= $second_start1 &&  $attend_time <= $second_end2 )
                                   {
                                   $status="false";

                                   }

                                   else if ($attend_time >= $third_start1 &&  $attend_time <= $third_end2)
                                   {
                                   $status="false";

                                   }

                                   else if ($attend_time >= $fourth_start1 &&  $attend_time <= $fourth_end2 )
                                   {
                                     $status="false";

                                   }

                                 }

                                 else if($attend_date != date("Y-m-d")) {
                                  $status= "true";
                                 }


                                }
                             }

                             else if ($start2 == 0){
                                $status="true";

                             }
                           }
                         }
                       }
                     }

                            if ($status=="true"){
                              $sql6 = "SELECT `id`, `eqv_first`, `eqv_second`, `eqv_third`, `eqv_fourth` FROM `tmpeqv` where id='".$event_id."'  ";
                               $result6 = mysqli_query($connect, $sql6);
                              while($row = mysqli_fetch_array($result6))
                              {
                                $eqv_first=$row['eqv_first'];
                                $eqv_second=$row['eqv_second'];
                                $eqv_third=$row['eqv_third'];
                                $eqv_fourth=$row['eqv_fourth'];
                              }

                              if($check==1)
                              {
                                $equivalent=$eqv_first;
                              }
                              else if($check==2)
                              {
                                $equivalent=$eqv_second;
                              }
                              else if($check==3)
                              {
                                $equivalent=$eqv_third;
                              }
                              else if($check==4)
                              {
                                $equivalent=$eqv_fourth;
                              }


                              $sql = "INSERT INTO attendance
                              (stud_id,
                                stud_name,
                                stud_department,
                                stud_sem,
                                stud_year,
                                event_id,
                                event_name,
                                event_start,
                                event_end,
                                attend_time,
                                attend_date,
                                history,
                                equivalent
                              )
                                VALUES
                                ('$id', '$name', '$dept', '$sem', '$year', '$event_id', '$event_name', '$start', '$end', '$time','$date','$check','$equivalent')";
                                $result = mysqli_query($db, $sql);

                                $sql3 = "INSERT INTO tmpattendance
                                (event_id,
                                  stud_id,
                                  start_date,
                                  end_date,
                                  attend_time,
                                  history
                                )
                                  VALUES
                                  ('$event_id', '$id', '$start', '$end', '$cur', '$check')";
                                  $result3 = mysqli_query($db, $sql3);
                                  $t1 = 'Has check attendance to';
                                  $t2 = ' for event';
                                  $action = $t1 . ' ' . $id . $t2 . ' ' . $event_name;
                                  $user = $row['name'];

                                  $log = "INSERT INTO log (name,action,time,department) VALUES ('$try','$action','$time','$dept')";
                                  $logres = mysqli_query($db, $log);

                                echo "<div class='alert alert-success'>";
                                echo "<h2 align='center'>ID Number:".$id."</h2>";
                                echo "</div>";
                                echo "<audio controls autoplay hidden>";
                                echo "<source src='img/cardin.mp3' type='audio/mpeg'>";
                                echo "</audio>";

                            }

                            elseif($status=="false"){
                                  echo " <script>alert('Student already tap his/her card!');window.location.href='catchcs.php';</script>";
                            }

                }

                else {
                  echo "<script>alert('Student is not required to attend ! ');window.location.href='catchcs.php';</script>";
                }

          }
        }
      }
    }


if(isset($_POST['accountancy'])){
      $query = mysqli_query($connect, "SELECT name FROM accounts WHERE id = '".$try."'");
      while($row = mysqli_fetch_array($query))
      {
          $card = $_POST['readcard'];
          $start = $_POST['start'];
          $end = $_POST['end'];
          //$finaleqv = $_POST['equivalent'];
          $event_name = $_POST['event_name'];
          $event_id = $_POST['event_id'];
          $first_p = $_POST['first_p'];
          $second_p = $_POST['second_p'];
          $third_p = $_POST['third_p'];
          $fourth_p = $_POST['fourth_p'];
          if($card == ""){
            echo "<script>alert('Card is not registered / incorrect ! ');window.location.href='catchac.php';</script>";
          }
          else{
            $sql2 = "SELECT
            stud_pool.id,
            stud_pool.card,
            stud_pool.name,
            stud_pool.department,
            stud_pool.birthdate,
            stud_pool.sem,
            stud_pool.year,
            stud_pool.year_level,
            tmpparticipants.first_p,
            tmpparticipants.second_p,
            tmpparticipants.third_p,
            tmpparticipants.fourth_p
            FROM stud_pool,tmpparticipants WHERE stud_pool.department = 'ACCOUNTANCY' AND stud_pool.card = '".$card."' and tmpparticipants.event_id='".$event_id."'";
            $result2 = mysqli_query($connect, $sql2);
              while($row = mysqli_fetch_array($result2))
                {
                    $id = $row['id'];
                    $name = $row['name'];
                    $dept = $row['department'];
                    $sem = $row['sem'];
                    $year = $row['year'];
                    $check = "";
                    $year_level = $row['year_level'];

                    if($year_level == $first_p ||
                       $year_level == $second_p ||
                       $year_level == $third_p ||
                       $year_level == $fourth_p) {
                          $status='true';
                         $try = "SELECT COUNT(*) AS sched FROM tmpsched WHERE  id ='".$event_id."' ";
                         $trysched = mysqli_query($connect,$try);
                         while($row = mysqli_fetch_array($trysched))
                         {
                           $start1 = $row['sched'];
                           if($start1 == 0)
                           {

                           }
                           else {


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
                               cast(substring(first_start,1,2) as int) as first_start,
                               cast(substring(first_end,1,2) as int) as first_end ,
                               cast(substring(second_start,1,2) as int) as second_start,
                               cast(substring(second_end,1,2) as int) as second_end,
                               cast(substring(third_start,1,2) as int) as third_start,
                               cast(substring(third_end,1,2) as int) as third_end,
                               cast(substring(fourth_start,1,2) as int) as fourth_start,
                               cast(substring(fourth_end,1,2) as int) as fourth_end FROM tmpsched
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

                                 $time2= substr($time,0,2);
                                 $time3=(int)$time2;
                                   if($time3 >= $first_starta and $time3 <= $first_endb)
                                   {
                                     $check=1;
                                   }
                                   else if($time3 >= $second_starta and $time3 <= $second_endb){

                                     $check=2;

                                   }
                                   else if($time3 >= $third_starta and $time3 <= $third_endb){
                                     $check=3;
                                   }
                                   else if($time3 >= $fourth_starta and $time3 <= $fourth_endb){

                                     $check=4;
                                   }


                               }

                               $try1 = "SELECT COUNT(*) AS count1 FROM attendance WHERE  event_id = '".$event_id."' and stud_id= '".$id."' ";
                               $trycount1= mysqli_query($connect,$try1);
                               while($row = mysqli_fetch_array($trycount1))
                               {
                                 $start2 = $row['count1'];
                                 if($start2 != 0)
                                 {


                                   $sql5 = "SELECT substring(attend_time,1,2) as attend_time, attend_date   FROM attendance
                                   WHERE event_id ='".$event_id."' and
                                   stud_id= '".$id."' and history= '".$check."' and attend_date = date(now())";
                                   $result5 = mysqli_query($connect, $sql5);
                                    while($row = mysqli_fetch_array($result5))
                                   {
                                     $attend_time = $row['attend_time'];
                                     $attend_date = $row['attend_date'];

                                     if ($attend_date==date("Y-m-d"))
                                     {

                                       if ( $attend_time >= $first_start1 &&  $attend_time <= $first_end2 )
                                       {
                                         $status="false";

                                       }

                                       else if ($attend_time >= $second_start1 &&  $attend_time <= $second_end2 )
                                       {
                                       $status="false";

                                       }

                                       else if ($attend_time >= $third_start1 &&  $attend_time <= $third_end2)
                                       {
                                       $status="false";

                                       }

                                       else if ($attend_time >= $fourth_start1 &&  $attend_time <= $fourth_end2 )
                                       {
                                         $status="false";

                                       }

                                     }

                                     else if($attend_date != date("Y-m-d")) {
                                      $status= "true";
                                     }


                                    }
                                 }

                                 else if ($start2 == 0){
                                    $status="true";

                                 }
                               }
                             }
                           }
                         }

                                if ($status=="true"){
                                  $sql6 = "SELECT `id`, `eqv_first`, `eqv_second`, `eqv_third`, `eqv_fourth` FROM `tmpeqv` where id='".$event_id."'  ";
                                   $result6 = mysqli_query($connect, $sql6);
                                  while($row = mysqli_fetch_array($result6))
                                  {
                                    $eqv_first=$row['eqv_first'];
                                    $eqv_second=$row['eqv_second'];
                                    $eqv_third=$row['eqv_third'];
                                    $eqv_fourth=$row['eqv_fourth'];
                                  }

                                  if($check==1)
                                  {
                                    $equivalent=$eqv_first;
                                  }
                                  else if($check==2)
                                  {
                                    $equivalent=$eqv_second;
                                  }
                                  else if($check==3)
                                  {
                                    $equivalent=$eqv_third;
                                  }
                                  else if($check==4)
                                  {
                                    $equivalent=$eqv_fourth;
                                  }


                                  $sql = "INSERT INTO attendance
                                  (stud_id,
                                    stud_name,
                                    stud_department,
                                    stud_sem,
                                    stud_year,
                                    event_id,
                                    event_name,
                                    event_start,
                                    event_end,
                                    attend_time,
                                    attend_date,
                                    history,
                                    equivalent
                                  )
                                    VALUES
                                    ('$id', '$name', '$dept', '$sem', '$year', '$event_id', '$event_name', '$start', '$end', '$time','$date','$check','$equivalent')";
                                    $result = mysqli_query($db, $sql);

                                    $sql3 = "INSERT INTO tmpattendance
                                    (event_id,
                                      stud_id,
                                      start_date,
                                      end_date,
                                      attend_time,
                                      history
                                    )
                                      VALUES
                                      ('$event_id', '$id', '$start', '$end', '$cur', '$check')";
                                      $result3 = mysqli_query($db, $sql3);
                                      $t1 = 'Has check attendance to';
                                      $t2 = ' for event';
                                      $action = $t1 . ' ' . $id . $t2 . ' ' . $event_name;
                                      $user = $row['name'];

                                      $log = "INSERT INTO log (name,action,time,department) VALUES ('$try','$action','$time','$dept')";
                                      $logres = mysqli_query($db, $log);

                                    echo "<div class='alert alert-success'>";
                                    echo "<h2 align='center'>ID Number:".$id."</h2>";
                                    echo "</div>";
                                    echo "<audio controls autoplay hidden>";
                                    echo "<source src='img/cardin.mp3' type='audio/mpeg'>";
                                    echo "</audio>";

                                }

                                elseif($status=="false"){
                                      echo " <script>alert('Student already tap his/her card!');window.location.href='catchac.php';</script>";
                                }

                    }

                    else {
                      echo "<script>alert('Student is not required to attend ! ');window.location.href='catchac.php';</script>";
                    }

              }
            }
          }
        }


if(isset($_POST['engineering'])){
              $query = mysqli_query($connect, "SELECT name FROM accounts WHERE id = '".$try."'");
              while($row = mysqli_fetch_array($query))
              {
                  $card = $_POST['readcard'];
                  $start = $_POST['start'];
                  $end = $_POST['end'];
                  //$finaleqv = $_POST['equivalent'];
                  $event_name = $_POST['event_name'];
                  $event_id = $_POST['event_id'];
                  $first_p = $_POST['first_p'];
                  $second_p = $_POST['second_p'];
                  $third_p = $_POST['third_p'];
                  $fourth_p = $_POST['fourth_p'];
                  if($card == ""){
                    echo "<script>alert('Card is not registered / incorrect ! ');window.location.href='catchea.php';</script>";
                  }
                  else{
                    $sql2 = "SELECT
                    stud_pool.id,
                    stud_pool.card,
                    stud_pool.name,
                    stud_pool.department,
                    stud_pool.birthdate,
                    stud_pool.sem,
                    stud_pool.year,
                    stud_pool.year_level,
                    tmpparticipants.first_p,
                    tmpparticipants.second_p,
                    tmpparticipants.third_p,
                    tmpparticipants.fourth_p
                    FROM stud_pool,tmpparticipants WHERE stud_pool.department = 'ENGINEERING' AND stud_pool.card = '".$card."' and tmpparticipants.event_id='".$event_id."'";
                    $result2 = mysqli_query($connect, $sql2);
                      while($row = mysqli_fetch_array($result2))
                        {
                            $id = $row['id'];
                            $name = $row['name'];
                            $dept = $row['department'];
                            $sem = $row['sem'];
                            $year = $row['year'];
                            $check = "";
                            $year_level = $row['year_level'];

                            if($year_level == $first_p ||
                               $year_level == $second_p ||
                               $year_level == $third_p ||
                               $year_level == $fourth_p) {
                                  $status='true';
                                 $try = "SELECT COUNT(*) AS sched FROM tmpsched WHERE  id ='".$event_id."' ";
                                 $trysched = mysqli_query($connect,$try);
                                 while($row = mysqli_fetch_array($trysched))
                                 {
                                   $start1 = $row['sched'];
                                   if($start1 == 0)
                                   {

                                   }
                                   else {


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
                                       cast(substring(first_start,1,2) as int) as first_start,
                                       cast(substring(first_end,1,2) as int) as first_end ,
                                       cast(substring(second_start,1,2) as int) as second_start,
                                       cast(substring(second_end,1,2) as int) as second_end,
                                       cast(substring(third_start,1,2) as int) as third_start,
                                       cast(substring(third_end,1,2) as int) as third_end,
                                       cast(substring(fourth_start,1,2) as int) as fourth_start,
                                       cast(substring(fourth_end,1,2) as int) as fourth_end FROM tmpsched
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

                                         $time2= substr($time,0,2);
                                         $time3=(int)$time2;
                                           if($time3 >= $first_starta and $time3 <= $first_endb)
                                           {
                                             $check=1;
                                           }
                                           else if($time3 >= $second_starta and $time3 <= $second_endb){

                                             $check=2;

                                           }
                                           else if($time3 >= $third_starta and $time3 <= $third_endb){
                                             $check=3;
                                           }
                                           else if($time3 >= $fourth_starta and $time3 <= $fourth_endb){

                                             $check=4;
                                           }


                                       }

                                       $try1 = "SELECT COUNT(*) AS count1 FROM attendance WHERE  event_id = '".$event_id."' and stud_id= '".$id."' ";
                                       $trycount1= mysqli_query($connect,$try1);
                                       while($row = mysqli_fetch_array($trycount1))
                                       {
                                         $start2 = $row['count1'];
                                         if($start2 != 0)
                                         {


                                           $sql5 = "SELECT substring(attend_time,1,2) as attend_time, attend_date   FROM attendance
                                           WHERE event_id ='".$event_id."' and
                                           stud_id= '".$id."' and history= '".$check."' and attend_date = date(now())";
                                           $result5 = mysqli_query($connect, $sql5);
                                            while($row = mysqli_fetch_array($result5))
                                           {
                                             $attend_time = $row['attend_time'];
                                             $attend_date = $row['attend_date'];

                                             if ($attend_date==date("Y-m-d"))
                                             {

                                               if ( $attend_time >= $first_start1 &&  $attend_time <= $first_end2 )
                                               {
                                                 $status="false";

                                               }

                                               else if ($attend_time >= $second_start1 &&  $attend_time <= $second_end2 )
                                               {
                                               $status="false";

                                               }

                                               else if ($attend_time >= $third_start1 &&  $attend_time <= $third_end2)
                                               {
                                               $status="false";

                                               }

                                               else if ($attend_time >= $fourth_start1 &&  $attend_time <= $fourth_end2 )
                                               {
                                                 $status="false";

                                               }

                                             }

                                             else if($attend_date != date("Y-m-d")) {
                                              $status= "true";
                                             }


                                            }
                                         }

                                         else if ($start2 == 0){
                                            $status="true";

                                         }
                                       }
                                     }
                                   }
                                 }

                                        if ($status=="true"){
                                          $sql6 = "SELECT `id`, `eqv_first`, `eqv_second`, `eqv_third`, `eqv_fourth` FROM `tmpeqv` where id='".$event_id."'  ";
                                           $result6 = mysqli_query($connect, $sql6);
                                          while($row = mysqli_fetch_array($result6))
                                          {
                                            $eqv_first=$row['eqv_first'];
                                            $eqv_second=$row['eqv_second'];
                                            $eqv_third=$row['eqv_third'];
                                            $eqv_fourth=$row['eqv_fourth'];
                                          }

                                          if($check==1)
                                          {
                                            $equivalent=$eqv_first;
                                          }
                                          else if($check==2)
                                          {
                                            $equivalent=$eqv_second;
                                          }
                                          else if($check==3)
                                          {
                                            $equivalent=$eqv_third;
                                          }
                                          else if($check==4)
                                          {
                                            $equivalent=$eqv_fourth;
                                          }


                                          $sql = "INSERT INTO attendance
                                          (stud_id,
                                            stud_name,
                                            stud_department,
                                            stud_sem,
                                            stud_year,
                                            event_id,
                                            event_name,
                                            event_start,
                                            event_end,
                                            attend_time,
                                            attend_date,
                                            history,
                                            equivalent
                                          )
                                            VALUES
                                            ('$id', '$name', '$dept', '$sem', '$year', '$event_id', '$event_name', '$start', '$end', '$time','$date','$check','$equivalent')";
                                            $result = mysqli_query($db, $sql);

                                            $sql3 = "INSERT INTO tmpattendance
                                            (event_id,
                                              stud_id,
                                              start_date,
                                              end_date,
                                              attend_time,
                                              history
                                            )
                                              VALUES
                                              ('$event_id', '$id', '$start', '$end', '$cur', '$check')";
                                              $result3 = mysqli_query($db, $sql3);
                                              $t1 = 'Has check attendance to';
                                              $t2 = ' for event';
                                              $action = $t1 . ' ' . $id . $t2 . ' ' . $event_name;
                                              $user = $row['name'];

                                              $log = "INSERT INTO log (name,action,time,department) VALUES ('$try','$action','$time','$dept')";
                                              $logres = mysqli_query($db, $log);

                                            echo "<div class='alert alert-success'>";
                                            echo "<h2 align='center'>ID Number:".$id."</h2>";
                                            echo "</div>";
                                            echo "<audio controls autoplay hidden>";
                                            echo "<source src='img/cardin.mp3' type='audio/mpeg'>";
                                            echo "</audio>";

                                        }

                                        elseif($status=="false"){
                                              echo " <script>alert('Student already tap his/her card!');window.location.href='catchea.php';</script>";
                                        }

                            }

                            else {
                              echo "<script>alert('Student is not required to attend ! ');window.location.href='catchea.php';</script>";
                            }

                      }
                    }
                  }
                }


if(isset($_POST['education'])){
                              $query = mysqli_query($connect, "SELECT name FROM accounts WHERE id = '".$try."'");
                              while($row = mysqli_fetch_array($query))
                              {
                                  $card = $_POST['readcard'];
                                  $start = $_POST['start'];
                                  $end = $_POST['end'];
                                  //$finaleqv = $_POST['equivalent'];
                                  $event_name = $_POST['event_name'];
                                  $event_id = $_POST['event_id'];
                                  $first_p = $_POST['first_p'];
                                  $second_p = $_POST['second_p'];
                                  $third_p = $_POST['third_p'];
                                  $fourth_p = $_POST['fourth_p'];
                                  if($card == ""){
                                    echo "<script>alert('Card is not registered / incorrect ! ');window.location.href='catcheduc.php';</script>";
                                  }
                                  else{
                                    $sql2 = "SELECT
                                    stud_pool.id,
                                    stud_pool.card,
                                    stud_pool.name,
                                    stud_pool.department,
                                    stud_pool.birthdate,
                                    stud_pool.sem,
                                    stud_pool.year,
                                    stud_pool.year_level,
                                    tmpparticipants.first_p,
                                    tmpparticipants.second_p,
                                    tmpparticipants.third_p,
                                    tmpparticipants.fourth_p
                                    FROM stud_pool,tmpparticipants WHERE stud_pool.department = 'EDUCATION' AND stud_pool.card = '".$card."' and tmpparticipants.event_id='".$event_id."'";
                                    $result2 = mysqli_query($connect, $sql2);
                                      while($row = mysqli_fetch_array($result2))
                                        {
                                            $id = $row['id'];
                                            $name = $row['name'];
                                            $dept = $row['department'];
                                            $sem = $row['sem'];
                                            $year = $row['year'];
                                            $check = "";
                                            $year_level = $row['year_level'];

                                            if($year_level == $first_p ||
                                               $year_level == $second_p ||
                                               $year_level == $third_p ||
                                               $year_level == $fourth_p) {
                                                  $status='true';
                                                 $try = "SELECT COUNT(*) AS sched FROM tmpsched WHERE  id ='".$event_id."' ";
                                                 $trysched = mysqli_query($connect,$try);
                                                 while($row = mysqli_fetch_array($trysched))
                                                 {
                                                   $start1 = $row['sched'];
                                                   if($start1 == 0)
                                                   {

                                                   }
                                                   else {


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
                                                       cast(substring(first_start,1,2) as int) as first_start,
                                                       cast(substring(first_end,1,2) as int) as first_end ,
                                                       cast(substring(second_start,1,2) as int) as second_start,
                                                       cast(substring(second_end,1,2) as int) as second_end,
                                                       cast(substring(third_start,1,2) as int) as third_start,
                                                       cast(substring(third_end,1,2) as int) as third_end,
                                                       cast(substring(fourth_start,1,2) as int) as fourth_start,
                                                       cast(substring(fourth_end,1,2) as int) as fourth_end FROM tmpsched
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

                                                         $time2= substr($time,0,2);
                                                         $time3=(int)$time2;
                                                           if($time3 >= $first_starta and $time3 <= $first_endb)
                                                           {
                                                             $check=1;
                                                           }
                                                           else if($time3 >= $second_starta and $time3 <= $second_endb){

                                                             $check=2;

                                                           }
                                                           else if($time3 >= $third_starta and $time3 <= $third_endb){
                                                             $check=3;
                                                           }
                                                           else if($time3 >= $fourth_starta and $time3 <= $fourth_endb){

                                                             $check=4;
                                                           }


                                                       }

                                                       $try1 = "SELECT COUNT(*) AS count1 FROM attendance WHERE  event_id = '".$event_id."' and stud_id= '".$id."' ";
                                                       $trycount1= mysqli_query($connect,$try1);
                                                       while($row = mysqli_fetch_array($trycount1))
                                                       {
                                                         $start2 = $row['count1'];
                                                         if($start2 != 0)
                                                         {


                                                           $sql5 = "SELECT substring(attend_time,1,2) as attend_time, attend_date   FROM attendance
                                                           WHERE event_id ='".$event_id."' and
                                                           stud_id= '".$id."' and history= '".$check."' and attend_date = date(now())";
                                                           $result5 = mysqli_query($connect, $sql5);
                                                            while($row = mysqli_fetch_array($result5))
                                                           {
                                                             $attend_time = $row['attend_time'];
                                                             $attend_date = $row['attend_date'];

                                                             if ($attend_date==date("Y-m-d"))
                                                             {

                                                               if ( $attend_time >= $first_start1 &&  $attend_time <= $first_end2 )
                                                               {
                                                                 $status="false";

                                                               }

                                                               else if ($attend_time >= $second_start1 &&  $attend_time <= $second_end2 )
                                                               {
                                                               $status="false";

                                                               }

                                                               else if ($attend_time >= $third_start1 &&  $attend_time <= $third_end2)
                                                               {
                                                               $status="false";

                                                               }

                                                               else if ($attend_time >= $fourth_start1 &&  $attend_time <= $fourth_end2 )
                                                               {
                                                                 $status="false";

                                                               }

                                                             }

                                                             else if($attend_date != date("Y-m-d")) {
                                                              $status= "true";
                                                             }


                                                            }
                                                         }

                                                         else if ($start2 == 0){
                                                            $status="true";

                                                         }
                                                       }
                                                     }
                                                   }
                                                 }

                                                        if ($status=="true"){
                                                          $sql6 = "SELECT `id`, `eqv_first`, `eqv_second`, `eqv_third`, `eqv_fourth` FROM `tmpeqv` where id='".$event_id."'  ";
                                                           $result6 = mysqli_query($connect, $sql6);
                                                          while($row = mysqli_fetch_array($result6))
                                                          {
                                                            $eqv_first=$row['eqv_first'];
                                                            $eqv_second=$row['eqv_second'];
                                                            $eqv_third=$row['eqv_third'];
                                                            $eqv_fourth=$row['eqv_fourth'];
                                                          }

                                                          if($check==1)
                                                          {
                                                            $equivalent=$eqv_first;
                                                          }
                                                          else if($check==2)
                                                          {
                                                            $equivalent=$eqv_second;
                                                          }
                                                          else if($check==3)
                                                          {
                                                            $equivalent=$eqv_third;
                                                          }
                                                          else if($check==4)
                                                          {
                                                            $equivalent=$eqv_fourth;
                                                          }


                                                          $sql = "INSERT INTO attendance
                                                          (stud_id,
                                                            stud_name,
                                                            stud_department,
                                                            stud_sem,
                                                            stud_year,
                                                            event_id,
                                                            event_name,
                                                            event_start,
                                                            event_end,
                                                            attend_time,
                                                            attend_date,
                                                            history,
                                                            equivalent
                                                          )
                                                            VALUES
                                                            ('$id', '$name', '$dept', '$sem', '$year', '$event_id', '$event_name', '$start', '$end', '$time','$date','$check','$equivalent')";
                                                            $result = mysqli_query($db, $sql);

                                                            $sql3 = "INSERT INTO tmpattendance
                                                            (event_id,
                                                              stud_id,
                                                              start_date,
                                                              end_date,
                                                              attend_time,
                                                              history
                                                            )
                                                              VALUES
                                                              ('$event_id', '$id', '$start', '$end', '$cur', '$check')";
                                                              $result3 = mysqli_query($db, $sql3);
                                                              $t1 = 'Has check attendance to';
                                                              $t2 = ' for event';
                                                              $action = $t1 . ' ' . $id . $t2 . ' ' . $event_name;
                                                              $user = $row['name'];

                                                              $log = "INSERT INTO log (name,action,time,department) VALUES ('$try','$action','$time','$dept')";
                                                              $logres = mysqli_query($db, $log);

                                                            echo "<div class='alert alert-success'>";
                                                            echo "<h2 align='center'>ID Number:".$id."</h2>";
                                                            echo "</div>";
                                                            echo "<audio controls autoplay hidden>";
                                                            echo "<source src='img/cardin.mp3' type='audio/mpeg'>";
                                                            echo "</audio>";

                                                        }

                                                        elseif($status=="false"){
                                                              echo " <script>alert('Student already tap his/her card!');window.location.href='catcheduc.php';</script>";
                                                        }

                                            }

                                            else {
                                              echo "<script>alert('Student is not required to attend ! ');window.location.href='catcheduc.php';</script>";
                                            }

                                      }
                                    }
                                  }
                                }


if(isset($_POST['ab'])){
                                                              $query = mysqli_query($connect, "SELECT name FROM accounts WHERE id = '".$try."'");
                                                              while($row = mysqli_fetch_array($query))
                                                              {
                                                                  $card = $_POST['readcard'];
                                                                  $start = $_POST['start'];
                                                                  $end = $_POST['end'];
                                                                  //$finaleqv = $_POST['equivalent'];
                                                                  $event_name = $_POST['event_name'];
                                                                  $event_id = $_POST['event_id'];
                                                                  $first_p = $_POST['first_p'];
                                                                  $second_p = $_POST['second_p'];
                                                                  $third_p = $_POST['third_p'];
                                                                  $fourth_p = $_POST['fourth_p'];
                                                                  if($card == ""){
                                                                    echo "<script>alert('Card is not registered / incorrect ! ');window.location.href='catchab.php';</script>";
                                                                  }
                                                                  else{
                                                                    $sql2 = "SELECT
                                                                    stud_pool.id,
                                                                    stud_pool.card,
                                                                    stud_pool.name,
                                                                    stud_pool.department,
                                                                    stud_pool.birthdate,
                                                                    stud_pool.sem,
                                                                    stud_pool.year,
                                                                    stud_pool.year_level,
                                                                    tmpparticipants.first_p,
                                                                    tmpparticipants.second_p,
                                                                    tmpparticipants.third_p,
                                                                    tmpparticipants.fourth_p
                                                                    FROM stud_pool,tmpparticipants WHERE stud_pool.department = 'AB' AND stud_pool.card = '".$card."' and tmpparticipants.event_id='".$event_id."'";
                                                                    $result2 = mysqli_query($connect, $sql2);
                                                                      while($row = mysqli_fetch_array($result2))
                                                                        {
                                                                            $id = $row['id'];
                                                                            $name = $row['name'];
                                                                            $dept = $row['department'];
                                                                            $sem = $row['sem'];
                                                                            $year = $row['year'];
                                                                            $check = "";
                                                                            $year_level = $row['year_level'];

                                                                            if($year_level == $first_p ||
                                                                               $year_level == $second_p ||
                                                                               $year_level == $third_p ||
                                                                               $year_level == $fourth_p) {
                                                                                  $status='true';
                                                                                 $try = "SELECT COUNT(*) AS sched FROM tmpsched WHERE  id ='".$event_id."' ";
                                                                                 $trysched = mysqli_query($connect,$try);
                                                                                 while($row = mysqli_fetch_array($trysched))
                                                                                 {
                                                                                   $start1 = $row['sched'];
                                                                                   if($start1 == 0)
                                                                                   {

                                                                                   }
                                                                                   else {


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
                                                                                       cast(substring(first_start,1,2) as int) as first_start,
                                                                                       cast(substring(first_end,1,2) as int) as first_end ,
                                                                                       cast(substring(second_start,1,2) as int) as second_start,
                                                                                       cast(substring(second_end,1,2) as int) as second_end,
                                                                                       cast(substring(third_start,1,2) as int) as third_start,
                                                                                       cast(substring(third_end,1,2) as int) as third_end,
                                                                                       cast(substring(fourth_start,1,2) as int) as fourth_start,
                                                                                       cast(substring(fourth_end,1,2) as int) as fourth_end FROM tmpsched
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

                                                                                         $time2= substr($time,0,2);
                                                                                         $time3=(int)$time2;
                                                                                           if($time3 >= $first_starta and $time3 <= $first_endb)
                                                                                           {
                                                                                             $check=1;
                                                                                           }
                                                                                           else if($time3 >= $second_starta and $time3 <= $second_endb){

                                                                                             $check=2;

                                                                                           }
                                                                                           else if($time3 >= $third_starta and $time3 <= $third_endb){
                                                                                             $check=3;
                                                                                           }
                                                                                           else if($time3 >= $fourth_starta and $time3 <= $fourth_endb){

                                                                                             $check=4;
                                                                                           }


                                                                                       }

                                                                                       $try1 = "SELECT COUNT(*) AS count1 FROM attendance WHERE  event_id = '".$event_id."' and stud_id= '".$id."' ";
                                                                                       $trycount1= mysqli_query($connect,$try1);
                                                                                       while($row = mysqli_fetch_array($trycount1))
                                                                                       {
                                                                                         $start2 = $row['count1'];
                                                                                         if($start2 != 0)
                                                                                         {


                                                                                           $sql5 = "SELECT substring(attend_time,1,2) as attend_time, attend_date   FROM attendance
                                                                                           WHERE event_id ='".$event_id."' and
                                                                                           stud_id= '".$id."' and history= '".$check."' and attend_date = date(now())";
                                                                                           $result5 = mysqli_query($connect, $sql5);
                                                                                            while($row = mysqli_fetch_array($result5))
                                                                                           {
                                                                                             $attend_time = $row['attend_time'];
                                                                                             $attend_date = $row['attend_date'];

                                                                                             if ($attend_date==date("Y-m-d"))
                                                                                             {

                                                                                               if ( $attend_time >= $first_start1 &&  $attend_time <= $first_end2 )
                                                                                               {
                                                                                                 $status="false";

                                                                                               }

                                                                                               else if ($attend_time >= $second_start1 &&  $attend_time <= $second_end2 )
                                                                                               {
                                                                                               $status="false";

                                                                                               }

                                                                                               else if ($attend_time >= $third_start1 &&  $attend_time <= $third_end2)
                                                                                               {
                                                                                               $status="false";

                                                                                               }

                                                                                               else if ($attend_time >= $fourth_start1 &&  $attend_time <= $fourth_end2 )
                                                                                               {
                                                                                                 $status="false";

                                                                                               }

                                                                                             }

                                                                                             else if($attend_date != date("Y-m-d")) {
                                                                                              $status= "true";
                                                                                             }


                                                                                            }
                                                                                         }

                                                                                         else if ($start2 == 0){
                                                                                            $status="true";

                                                                                         }
                                                                                       }
                                                                                     }
                                                                                   }
                                                                                 }

                                                                                        if ($status=="true"){
                                                                                          $sql6 = "SELECT `id`, `eqv_first`, `eqv_second`, `eqv_third`, `eqv_fourth` FROM `tmpeqv` where id='".$event_id."'  ";
                                                                                           $result6 = mysqli_query($connect, $sql6);
                                                                                          while($row = mysqli_fetch_array($result6))
                                                                                          {
                                                                                            $eqv_first=$row['eqv_first'];
                                                                                            $eqv_second=$row['eqv_second'];
                                                                                            $eqv_third=$row['eqv_third'];
                                                                                            $eqv_fourth=$row['eqv_fourth'];
                                                                                          }

                                                                                          if($check==1)
                                                                                          {
                                                                                            $equivalent=$eqv_first;
                                                                                          }
                                                                                          else if($check==2)
                                                                                          {
                                                                                            $equivalent=$eqv_second;
                                                                                          }
                                                                                          else if($check==3)
                                                                                          {
                                                                                            $equivalent=$eqv_third;
                                                                                          }
                                                                                          else if($check==4)
                                                                                          {
                                                                                            $equivalent=$eqv_fourth;
                                                                                          }


                                                                                          $sql = "INSERT INTO attendance
                                                                                          (stud_id,
                                                                                            stud_name,
                                                                                            stud_department,
                                                                                            stud_sem,
                                                                                            stud_year,
                                                                                            event_id,
                                                                                            event_name,
                                                                                            event_start,
                                                                                            event_end,
                                                                                            attend_time,
                                                                                            attend_date,
                                                                                            history,
                                                                                            equivalent
                                                                                          )
                                                                                            VALUES
                                                                                            ('$id', '$name', '$dept', '$sem', '$year', '$event_id', '$event_name', '$start', '$end', '$time','$date','$check','$equivalent')";
                                                                                            $result = mysqli_query($db, $sql);

                                                                                            $sql3 = "INSERT INTO tmpattendance
                                                                                            (event_id,
                                                                                              stud_id,
                                                                                              start_date,
                                                                                              end_date,
                                                                                              attend_time,
                                                                                              history
                                                                                            )
                                                                                              VALUES
                                                                                              ('$event_id', '$id', '$start', '$end', '$cur', '$check')";
                                                                                              $result3 = mysqli_query($db, $sql3);
                                                                                              $t1 = 'Has check attendance to';
                                                                                              $t2 = ' for event';
                                                                                              $action = $t1 . ' ' . $id . $t2 . ' ' . $event_name;
                                                                                              $user = $row['name'];

                                                                                              $log = "INSERT INTO log (name,action,time,department) VALUES ('$try','$action','$time','$dept')";
                                                                                              $logres = mysqli_query($db, $log);

                                                                                            echo "<div class='alert alert-success'>";
                                                                                            echo "<h2 align='center'>ID Number:".$id."</h2>";
                                                                                            echo "</div>";
                                                                                            echo "<audio controls autoplay hidden>";
                                                                                            echo "<source src='img/cardin.mp3' type='audio/mpeg'>";
                                                                                            echo "</audio>";

                                                                                        }

                                                                                        elseif($status=="false"){
                                                                                              echo " <script>alert('Student already tap his/her card!');window.location.href='catchab.php';</script>";
                                                                                        }

                                                                            }

                                                                            else {
                                                                              echo "<script>alert('Student is not required to attend ! ');window.location.href='catchab.php';</script>";
                                                                            }

                                                                      }
                                                                    }
                                                                  }
                                                                }


if(isset($_POST['business'])){
                                                                                                                              $query = mysqli_query($connect, "SELECT name FROM accounts WHERE id = '".$try."'");
                                                                                                                              while($row = mysqli_fetch_array($query))
                                                                                                                              {
                                                                                                                                  $card = $_POST['readcard'];
                                                                                                                                  $start = $_POST['start'];
                                                                                                                                  $end = $_POST['end'];
                                                                                                                                  //$finaleqv = $_POST['equivalent'];
                                                                                                                                  $event_name = $_POST['event_name'];
                                                                                                                                  $event_id = $_POST['event_id'];
                                                                                                                                  $first_p = $_POST['first_p'];
                                                                                                                                  $second_p = $_POST['second_p'];
                                                                                                                                  $third_p = $_POST['third_p'];
                                                                                                                                  $fourth_p = $_POST['fourth_p'];
                                                                                                                                  if($card == ""){
                                                                                                                                    echo "<script>alert('Card is not registered / incorrect ! ');window.location.href='catchbhm.php';</script>";
                                                                                                                                  }
                                                                                                                                  else{
                                                                                                                                    $sql2 = "SELECT
                                                                                                                                    stud_pool.id,
                                                                                                                                    stud_pool.card,
                                                                                                                                    stud_pool.name,
                                                                                                                                    stud_pool.department,
                                                                                                                                    stud_pool.birthdate,
                                                                                                                                    stud_pool.sem,
                                                                                                                                    stud_pool.year,
                                                                                                                                    stud_pool.year_level,
                                                                                                                                    tmpparticipants.first_p,
                                                                                                                                    tmpparticipants.second_p,
                                                                                                                                    tmpparticipants.third_p,
                                                                                                                                    tmpparticipants.fourth_p
                                                                                                                                    FROM stud_pool,tmpparticipants WHERE stud_pool.department = 'BUSINESS' AND stud_pool.card = '".$card."' and tmpparticipants.event_id='".$event_id."'";
                                                                                                                                    $result2 = mysqli_query($connect, $sql2);
                                                                                                                                      while($row = mysqli_fetch_array($result2))
                                                                                                                                        {
                                                                                                                                            $id = $row['id'];
                                                                                                                                            $name = $row['name'];
                                                                                                                                            $dept = $row['department'];
                                                                                                                                            $sem = $row['sem'];
                                                                                                                                            $year = $row['year'];
                                                                                                                                            $check = "";
                                                                                                                                            $year_level = $row['year_level'];

                                                                                                                                            if($year_level == $first_p ||
                                                                                                                                               $year_level == $second_p ||
                                                                                                                                               $year_level == $third_p ||
                                                                                                                                               $year_level == $fourth_p) {
                                                                                                                                                  $status='true';
                                                                                                                                                 $try = "SELECT COUNT(*) AS sched FROM tmpsched WHERE  id ='".$event_id."' ";
                                                                                                                                                 $trysched = mysqli_query($connect,$try);
                                                                                                                                                 while($row = mysqli_fetch_array($trysched))
                                                                                                                                                 {
                                                                                                                                                   $start1 = $row['sched'];
                                                                                                                                                   if($start1 == 0)
                                                                                                                                                   {

                                                                                                                                                   }
                                                                                                                                                   else {


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
                                                                                                                                                       cast(substring(first_start,1,2) as int) as first_start,
                                                                                                                                                       cast(substring(first_end,1,2) as int) as first_end ,
                                                                                                                                                       cast(substring(second_start,1,2) as int) as second_start,
                                                                                                                                                       cast(substring(second_end,1,2) as int) as second_end,
                                                                                                                                                       cast(substring(third_start,1,2) as int) as third_start,
                                                                                                                                                       cast(substring(third_end,1,2) as int) as third_end,
                                                                                                                                                       cast(substring(fourth_start,1,2) as int) as fourth_start,
                                                                                                                                                       cast(substring(fourth_end,1,2) as int) as fourth_end FROM tmpsched
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

                                                                                                                                                         $time2= substr($time,0,2);
                                                                                                                                                         $time3=(int)$time2;
                                                                                                                                                           if($time3 >= $first_starta and $time3 <= $first_endb)
                                                                                                                                                           {
                                                                                                                                                             $check=1;
                                                                                                                                                           }
                                                                                                                                                           else if($time3 >= $second_starta and $time3 <= $second_endb){

                                                                                                                                                             $check=2;

                                                                                                                                                           }
                                                                                                                                                           else if($time3 >= $third_starta and $time3 <= $third_endb){
                                                                                                                                                             $check=3;
                                                                                                                                                           }
                                                                                                                                                           else if($time3 >= $fourth_starta and $time3 <= $fourth_endb){

                                                                                                                                                             $check=4;
                                                                                                                                                           }


                                                                                                                                                       }

                                                                                                                                                       $try1 = "SELECT COUNT(*) AS count1 FROM attendance WHERE  event_id = '".$event_id."' and stud_id= '".$id."' ";
                                                                                                                                                       $trycount1= mysqli_query($connect,$try1);
                                                                                                                                                       while($row = mysqli_fetch_array($trycount1))
                                                                                                                                                       {
                                                                                                                                                         $start2 = $row['count1'];
                                                                                                                                                         if($start2 != 0)
                                                                                                                                                         {


                                                                                                                                                           $sql5 = "SELECT substring(attend_time,1,2) as attend_time, attend_date   FROM attendance
                                                                                                                                                           WHERE event_id ='".$event_id."' and
                                                                                                                                                           stud_id= '".$id."' and history= '".$check."' and attend_date = date(now())";
                                                                                                                                                           $result5 = mysqli_query($connect, $sql5);
                                                                                                                                                            while($row = mysqli_fetch_array($result5))
                                                                                                                                                           {
                                                                                                                                                             $attend_time = $row['attend_time'];
                                                                                                                                                             $attend_date = $row['attend_date'];

                                                                                                                                                             if ($attend_date==date("Y-m-d"))
                                                                                                                                                             {

                                                                                                                                                               if ( $attend_time >= $first_start1 &&  $attend_time <= $first_end2 )
                                                                                                                                                               {
                                                                                                                                                                 $status="false";

                                                                                                                                                               }

                                                                                                                                                               else if ($attend_time >= $second_start1 &&  $attend_time <= $second_end2 )
                                                                                                                                                               {
                                                                                                                                                               $status="false";

                                                                                                                                                               }

                                                                                                                                                               else if ($attend_time >= $third_start1 &&  $attend_time <= $third_end2)
                                                                                                                                                               {
                                                                                                                                                               $status="false";

                                                                                                                                                               }

                                                                                                                                                               else if ($attend_time >= $fourth_start1 &&  $attend_time <= $fourth_end2 )
                                                                                                                                                               {
                                                                                                                                                                 $status="false";

                                                                                                                                                               }

                                                                                                                                                             }

                                                                                                                                                             else if($attend_date != date("Y-m-d")) {
                                                                                                                                                              $status= "true";
                                                                                                                                                             }


                                                                                                                                                            }
                                                                                                                                                         }

                                                                                                                                                         else if ($start2 == 0){
                                                                                                                                                            $status="true";

                                                                                                                                                         }
                                                                                                                                                       }
                                                                                                                                                     }
                                                                                                                                                   }
                                                                                                                                                 }

                                                                                                                                                        if ($status=="true"){
                                                                                                                                                          $sql6 = "SELECT `id`, `eqv_first`, `eqv_second`, `eqv_third`, `eqv_fourth` FROM `tmpeqv` where id='".$event_id."'  ";
                                                                                                                                                           $result6 = mysqli_query($connect, $sql6);
                                                                                                                                                          while($row = mysqli_fetch_array($result6))
                                                                                                                                                          {
                                                                                                                                                            $eqv_first=$row['eqv_first'];
                                                                                                                                                            $eqv_second=$row['eqv_second'];
                                                                                                                                                            $eqv_third=$row['eqv_third'];
                                                                                                                                                            $eqv_fourth=$row['eqv_fourth'];
                                                                                                                                                          }

                                                                                                                                                          if($check==1)
                                                                                                                                                          {
                                                                                                                                                            $equivalent=$eqv_first;
                                                                                                                                                          }
                                                                                                                                                          else if($check==2)
                                                                                                                                                          {
                                                                                                                                                            $equivalent=$eqv_second;
                                                                                                                                                          }
                                                                                                                                                          else if($check==3)
                                                                                                                                                          {
                                                                                                                                                            $equivalent=$eqv_third;
                                                                                                                                                          }
                                                                                                                                                          else if($check==4)
                                                                                                                                                          {
                                                                                                                                                            $equivalent=$eqv_fourth;
                                                                                                                                                          }


                                                                                                                                                          $sql = "INSERT INTO attendance
                                                                                                                                                          (stud_id,
                                                                                                                                                            stud_name,
                                                                                                                                                            stud_department,
                                                                                                                                                            stud_sem,
                                                                                                                                                            stud_year,
                                                                                                                                                            event_id,
                                                                                                                                                            event_name,
                                                                                                                                                            event_start,
                                                                                                                                                            event_end,
                                                                                                                                                            attend_time,
                                                                                                                                                            attend_date,
                                                                                                                                                            history,
                                                                                                                                                            equivalent
                                                                                                                                                          )
                                                                                                                                                            VALUES
                                                                                                                                                            ('$id', '$name', '$dept', '$sem', '$year', '$event_id', '$event_name', '$start', '$end', '$time','$date','$check','$equivalent')";
                                                                                                                                                            $result = mysqli_query($db, $sql);

                                                                                                                                                            $sql3 = "INSERT INTO tmpattendance
                                                                                                                                                            (event_id,
                                                                                                                                                              stud_id,
                                                                                                                                                              start_date,
                                                                                                                                                              end_date,
                                                                                                                                                              attend_time,
                                                                                                                                                              history
                                                                                                                                                            )
                                                                                                                                                              VALUES
                                                                                                                                                              ('$event_id', '$id', '$start', '$end', '$cur', '$check')";
                                                                                                                                                              $result3 = mysqli_query($db, $sql3);
                                                                                                                                                              $t1 = 'Has check attendance to';
                                                                                                                                                              $t2 = ' for event';
                                                                                                                                                              $action = $t1 . ' ' . $id . $t2 . ' ' . $event_name;
                                                                                                                                                              $user = $row['name'];

                                                                                                                                                              $log = "INSERT INTO log (name,action,time,department) VALUES ('$try','$action','$time','$dept')";
                                                                                                                                                              $logres = mysqli_query($db, $log);

                                                                                                                                                            echo "<div class='alert alert-success'>";
                                                                                                                                                            echo "<h2 align='center'>ID Number:".$id."</h2>";
                                                                                                                                                            echo "</div>";
                                                                                                                                                            echo "<audio controls autoplay hidden>";
                                                                                                                                                            echo "<source src='img/cardin.mp3' type='audio/mpeg'>";
                                                                                                                                                            echo "</audio>";

                                                                                                                                                        }

                                                                                                                                                        elseif($status=="false"){
                                                                                                                                                              echo " <script>alert('Student already tap his/her card!');window.location.href='catchbhm.php';</script>";
                                                                                                                                                        }

                                                                                                                                            }

                                                                                                                                            else {
                                                                                                                                              echo "<script>alert('Student is not required to attend ! ');window.location.href='catchbhm.php';</script>";
                                                                                                                                            }

                                                                                                                                      }
                                                                                                                                    }
                                                                                                                                  }
                                                                                                                                }
