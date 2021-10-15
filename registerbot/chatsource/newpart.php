<?php
 ob_start();
       date_default_timezone_set('Africa/Lagos');
       include 'dbh.php';
       session_start();
       if (isset($_SESSION['userid'])) {
              $userid = $_SESSION['userid'];
       }
$date = date("d-m-Y h:i:s a", time());
 if ($trackid == "") {
                                                 $trackid2 = mt_rand(11111, 99999).'b';
                                                 $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid2')";
                                                 $result = $conn->query($sql);
                                          }else{
                                                 $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid')";
                                                 $result = $conn->query($sql);
                                          }
                                          $ntrackid = mt_rand(11111, 99999).'a';


                                          if ($task !== "") {
                                              if ($task == "email") {
                                                 $sql1 = "SELECT * FROM user WHERE userid!='$userid' AND email='$text'";
                                                 $result1 = $conn->query($sql1);
                                                 if (mysqli_num_rows($result1) > 0){
                                                 $sql1 = "SELECT * FROM tasks WHERE task='email' AND userid='$userid'";
                                                 $result1 = $conn->query($sql1);
                                                 $row1 = $result1->fetch_assoc();
                                                 $task = $row1['task'];
                                                 $question1 = 'Sorry, it seems another participant has used this email address!<br/>Please choose another';
                                                 $question = $row1['question'];
                                                 $sql37 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question1', 'left', '$date', '$ntrackid')";
                                                 $result37 = $conn->query($sql37);
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql2 = "UPDATE user SET task='$task' WHERE userid='$userid'";
                                                 $result2 = $conn->query($sql2);
                                                 die();
                                              }else{
                                                  $sql = "UPDATE user SET email='$text', task='' WHERE userid='$userid'";
                                                  $result = $conn->query($sql);
                                                  $sql = "UPDATE tasks SET status='done' WHERE task='$task' AND userid='$userid'";
                                                  $result = $conn->query($sql);
                                              }
                                            }else if ($task == "phone") {
                                                 $sql1 = "SELECT * FROM user WHERE userid!='$userid' AND phone='$text'";
                                                 $result1 = $conn->query($sql1);
                                                 if (mysqli_num_rows($result1) > 0){
                                                 $sql1 = "SELECT * FROM tasks WHERE task='phone' AND userid='$userid'";
                                                 $result1 = $conn->query($sql1);
                                                 $row1 = $result1->fetch_assoc();
                                                 $task = $row1['task'];
                                                 $question1 = 'Sorry, it seems another participant has used this phone number!<br/>Please choose another';
                                                 $question = $row1['question'];
                                                 $sql37 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question1', 'left', '$date', '$ntrackid')";
                                                 $result37 = $conn->query($sql37);
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql2 = "UPDATE user SET task='$task' WHERE userid='$userid'";
                                                 $result2 = $conn->query($sql2);
                                                 die();
                                              }else{
                                                  $sql = "UPDATE user SET phone='$text', task='' WHERE userid='$userid'";
                                                  $result = $conn->query($sql);
                                                  $sql = "UPDATE tasks SET status='done' WHERE task='$task' AND userid='$userid'";
                                                  $result = $conn->query($sql);
                                              }
                                            }else if ($task == "age") {
                                                  if ($text < 15 || $text > 100) {
                                                    $sql1 = "SELECT * FROM tasks WHERE task='age' AND userid='$userid'";
                                                 $result1 = $conn->query($sql1);
                                                 $row1 = $result1->fetch_assoc();
                                                 $task = $row1['task'];
                                                 $question1 = 'Sorry, I could not understand your reply!';
                                                 $question = $row1['question'];
                                                 $sql37 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question1', 'left', '$date', '$ntrackid')";
                                                 $result37 = $conn->query($sql37);
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql2 = "UPDATE user SET task='$task' WHERE userid='$userid'";
                                                 $result2 = $conn->query($sql2);
                                                 die();
                                                  }else{
                                                    $sql = "UPDATE user SET age='$text', task='' WHERE userid='$userid'";
                                                  $result = $conn->query($sql);
                                                  $sql = "UPDATE tasks SET status='done' WHERE task='$task' AND userid='$userid'";
                                                  $result = $conn->query($sql);
                                                  }
                                                 }else if ($task == "campus") {
                                                  if ($text < 1 || $text > 176) {
                                                 $sql1 = "SELECT * FROM tasks WHERE task='campus' AND userid='$userid'";
                                                 $result1 = $conn->query($sql1);
                                                 $row1 = $result1->fetch_assoc();
                                                 $task = $row1['task'];
                                                 $question1 = 'Sorry, I could not understand your reply!';
                                                 $question = $row1['question'];
                                                 $sql37 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question1', 'left', '$date', '$ntrackid')";
                                                 $result37 = $conn->query($sql37);
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql2 = "UPDATE user SET task='$task' WHERE userid='$userid'";
                                                 $result2 = $conn->query($sql2);
                                                 die();
                                                 }else{
                                                  $sql = "SELECT * FROM campuses WHERE id='$text'";
                                                  $result = $conn->query($sql);
                                                  if (mysqli_num_rows($result) > 0){
                                                  $row = $result->fetch_assoc();
                                                  $uni = $row['uni'];
                                                  $sql = "UPDATE user SET campus='$uni', task='' WHERE userid='$userid'";
                                                  $result = $conn->query($sql);
                                                  $sql = "UPDATE tasks SET status='done' WHERE task='$task' AND userid='$userid'";
                                                  $result = $conn->query($sql);
                                                  }else{
                                                 $sql1 = "SELECT * FROM tasks WHERE task='campus' AND userid='$userid'";
                                                 $result1 = $conn->query($sql1);
                                                 $row1 = $result1->fetch_assoc();
                                                 $task = $row1['task'];
                                                 $question1 = 'Sorry, I could not understand your reply!';
                                                 $question = $row1['question'];
                                                 $sql37 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question1', 'left', '$date', '$ntrackid')";
                                                 $result37 = $conn->query($sql37);
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql2 = "UPDATE user SET task='$task' WHERE userid='$userid'";
                                                 $result2 = $conn->query($sql2);
                                                 die();
                                                  }
                                                 }
                                                }else if ($task == "diocese") {
                                                  if ($text < 1 || $text > 37) {
                                                 $sql1 = "SELECT * FROM tasks WHERE task='diocese' AND userid='$userid'";
                                                 $result1 = $conn->query($sql1);
                                                 $row1 = $result1->fetch_assoc();
                                                 $task = $row1['task'];
                                                 $question1 = 'Sorry, I could not understand your reply!';
                                                 $question = $row1['question'];
                                                 $sql37 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question1', 'left', '$date', '$ntrackid')";
                                                 $result37 = $conn->query($sql37);
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql2 = "UPDATE user SET task='$task' WHERE userid='$userid'";
                                                 $result2 = $conn->query($sql2);
                                                 die();
                                                 }else{
                                                  $sql = "SELECT * FROM dioceses WHERE id='$text'";
                                                  $result = $conn->query($sql);
                                                  if (mysqli_num_rows($result) > 0){
                                                  $row = $result->fetch_assoc();
                                                  $diocese = $row['diocese'];
                                                  $sql = "UPDATE user SET diocese='$diocese', task='' WHERE userid='$userid'";
                                                  $result = $conn->query($sql);
                                                  $sql = "UPDATE tasks SET status='done' WHERE task='$task' AND userid='$userid'";
                                                  $result = $conn->query($sql);
                                                  }else{
                                                 $sql1 = "SELECT * FROM tasks WHERE task='diocese' AND userid='$userid'";
                                                 $result1 = $conn->query($sql1);
                                                 $row1 = $result1->fetch_assoc();
                                                 $task = $row1['task'];
                                                 $question1 = 'Sorry, I could not understand your reply!';
                                                 $question = $row1['question'];
                                                 $sql37 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question1', 'left', '$date', '$ntrackid')";
                                                 $result37 = $conn->query($sql37);
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql2 = "UPDATE user SET task='$task' WHERE userid='$userid'";
                                                 $result2 = $conn->query($sql2);
                                                 die();
                                                  }
                                                 }
                                                }else if ($task == "position") {
                                                  if ($text < 1 || $text > 21) {
                                                 $sql1 = "SELECT * FROM tasks WHERE task='position' AND userid='$userid'";
                                                 $result1 = $conn->query($sql1);
                                                 $row1 = $result1->fetch_assoc();
                                                 $task = $row1['task'];
                                                 $question1 = 'Sorry, I could not understand your reply!';
                                                 $question = $row1['question'];
                                                 $sql37 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question1', 'left', '$date', '$ntrackid')";
                                                 $result37 = $conn->query($sql37);
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql2 = "UPDATE user SET task='$task' WHERE userid='$userid'";
                                                 $result2 = $conn->query($sql2);
                                                 die();
                                                 }else{
                                                  $sql = "SELECT * FROM position WHERE id='$text'";
                                                  $result = $conn->query($sql);
                                                  if (mysqli_num_rows($result) > 0){
                                                  $row = $result->fetch_assoc();
                                                  $position = $row['position'];
                                                  $sql = "UPDATE user SET position='$position', task='' WHERE userid='$userid'";
                                                  $result = $conn->query($sql);
                                                  $sql = "UPDATE tasks SET status='done' WHERE task='$task' AND userid='$userid'";
                                                  $result = $conn->query($sql);
                                                  }else{
                                                 $sql1 = "SELECT * FROM tasks WHERE task='position' AND userid='$userid'";
                                                 $result1 = $conn->query($sql1);
                                                 $row1 = $result1->fetch_assoc();
                                                 $task = $row1['task'];
                                                 $question1 = 'Sorry, I could not understand your reply!';
                                                 $question = $row1['question'];
                                                 $sql37 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question1', 'left', '$date', '$ntrackid')";
                                                 $result37 = $conn->query($sql37);
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql2 = "UPDATE user SET task='$task' WHERE userid='$userid'";
                                                 $result2 = $conn->query($sql2);
                                                 die();
                                                  }
                                                 }
                                                }else{
                                                $sql = "UPDATE user SET `$task`='$text', task='' WHERE userid='$userid'";
                                                $result = $conn->query($sql);
                                                $sql = "UPDATE tasks SET status='done' WHERE task='$task' AND userid='$userid'";
                                                $result = $conn->query($sql); 
                                                }
                                          }
                                          $sql = "SELECT COUNT(*) AS tasktotal FROM tasks WHERE userid='$userid'";
                                          $result = $conn->query($sql);
                                          $row = $result->fetch_assoc();
                                          $tasktotal = $row['tasktotal'];
                                          for ($i=1; $i < $tasktotal; $i++) {
                                               $sql1 = "SELECT * FROM tasks WHERE id='$i' AND status='' AND userid='$userid'";
                                               $result1 = $conn->query($sql1);
                                               if (mysqli_num_rows($result1) > 0){
                                                 $row1 = $result1->fetch_assoc();
                                                 $task = $row1['task'];
                                                 if ($task == "lname") {
                                                   $sql7 = "SELECT * FROM user WHERE userid='$userid'";
                                                   $result7 = $conn->query($sql7);
                                                   if (mysqli_num_rows($result7) > 0){
                                                   $row7 = $result7->fetch_assoc();
                                                   $question10 = 'Hi '.$row7['fname'].', nice to meet you!';
                                                   $question = $row1['question'];
                                                   $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question10', 'left', '$date', '$ntrackid')";
                                                   $result3 = $conn->query($sql3);
                                                   }else{
                                                    $question = $row1['question'];
                                                   }
                                                 }else{
                                                  $question = $row1['question'];
                                                 }
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql2 = "UPDATE user SET task='$task' WHERE userid='$userid'";
                                                 $result2 = $conn->query($sql2);
                                                 break;
                                               }else{
                                                $subtasktotal = $tasktotal - 1;
                                                if ($i == $subtasktotal) {
                                                $sql17 = "SELECT * FROM user WHERE userid='$userid'";
                                                   $result17 = $conn->query($sql17);
                                                   $row17 = $result17->fetch_assoc();
                                                   $question101 = '
                                                  Alright '.$row17['fname'].', please confirm that all your information listed below are correct.';
                                                $question11 = '
                                                Firstname: <b style="text-decoration:underline;">'.$row17['fname'].'</b><br/>
                                                  Lastname: <b style="text-decoration:underline;">'.$row17['lname'].'</b><br/>
                                                  Email Address: <b style="text-decoration:underline;">'.$row17['email'].'</b><br/>
                                                  Phone Number: <b style="text-decoration:underline;">'.$row17['phone'].'</b><br/>
                                                  Age: <b style="text-decoration:underline;">'.$row17['age'].'</b><br/>
                                                  Instiution: <b style="text-decoration:underline;">'.$row17['campus'].'</b><br/>
                                                  Diocese: <b style="text-decoration:underline;">'.$row17['diocese'].'</b><br/>
                                                  Position: <b style="text-decoration:underline;">'.$row17['position'].'</b>';

                                                $question12 = 'Please respond with <b>CHANGE</b> to change any information<br/> or respond with <b>CONTINUE</b> to proceed';
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question101', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question11', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question12', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql2 = "UPDATE user SET task='confirm' WHERE userid='$userid'";
                                                 $result2 = $conn->query($sql2);
                                                 break;
                                               }
                                             }
                                          }



                                          //$ntext = 'You have filled the form';
                                          //$sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$ntext', 'left', '$date', '$ntrackid')";
                                           //                    $result = $conn->query($sql);
                                   