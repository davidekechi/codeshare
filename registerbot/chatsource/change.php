<?php
 ob_start();
       date_default_timezone_set('Africa/Lagos');
       include 'dbh.php';
       session_start();
       if (isset($_SESSION['userid'])) {
              $userid = $_SESSION['userid'];
       }
$date = date("d-m-Y h:i:s a", time());

if ($task == "change") {
       $sql = "SELECT COUNT(*) AS tasktotal FROM tasks WHERE status='done' AND userid='$userid'";
                                          $result = $conn->query($sql);
                                          $row = $result->fetch_assoc();
                                          $tasktotal = $row['tasktotal'];
       if ($text < 1 || $text > $tasktotal) {
         if ($trackid == "") {
                                                 $trackid2 = mt_rand(11111, 99999).'b';
                                                 $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid2')";
                                                                      $result = $conn->query($sql);
                                          }else{
                                                 $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid')";
                                                                      $result = $conn->query($sql);
                                          }
$ntrackid = mt_rand(11111, 99999).'a'; 
              $sql = "SELECT * FROM tasks WHERE task='fname' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $fnames = '<b>1.</b> Firstname<br/>';
       }else{
       $fnames="";
       }
       $sql = "SELECT * FROM tasks WHERE task='lname' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $lnames = '<b>2.</b> Lastname<br/>';
       }else{
       $lnames="";
       }
       $sql = "SELECT * FROM tasks WHERE task='email' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $emails = '<b>3.</b> Email Address<br/>';
       }else{
       $emails="";
       }
       $sql = "SELECT * FROM tasks WHERE task='phone' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $phones = '<b>4.</b> Phone Number<br/>';
       }else{
       $phones="";
       }
       $sql = "SELECT * FROM tasks WHERE task='age' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $ages = '<b>5.</b> Age<br/>';
       }else{
       $ages="";
       }
       $sql = "SELECT * FROM tasks WHERE task='campus' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $campuss = '<b>6.</b> Institution<br/>';
       }else{
       $campuss="";
       }
       $sql = "SELECT * FROM tasks WHERE task='diocese' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $dioceses = '<b>7.</b> Diocese<br/>';
       }else{
       $dioceses="";
       }
       $sql = "SELECT * FROM tasks WHERE task='position' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $positions = '<b>8.</b> Position<br/>';
       }else{
       $positions="";
       }

       $changetext2 = 'Sorry, I could not understand your reply!';
       $changetext = 'What do you want to change?<br/><br/>Please respond with a number most applicable to you:<br/>
       '.$fnames.$lnames.$emails.$phones.$ages.$campuss.$dioceses.$positions.'<br/><br/>Respond with <b>RETURN</b> if you have nothing to change';
       $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$changetext2', 'left', '$date', '$ntrackid')";
       $result = $conn->query($sql);
       $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$changetext', 'left', '$date', '$ntrackid')";
       $result = $conn->query($sql);
       $sql = "UPDATE user SET next='partitype', task='change' WHERE userid='$userid'";
       $result = $conn->query($sql);
       }else{
              if ($trackid == "") {
                                                 $trackid2 = mt_rand(11111, 99999).'b';
                                                 $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid2')";
                                                                      $result = $conn->query($sql);
                                          }else{
                                                 $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid')";
                                                                      $result = $conn->query($sql);
                                          }
$ntrackid = mt_rand(11111, 99999).'a';
$sql = "SELECT * FROM tasks WHERE id='$text' AND userid='$userid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$taskch = $row['task'];
$sql = "UPDATE user SET task='$taskch' WHERE userid='$userid'";
$result = $conn->query($sql);
$sql = "UPDATE tasks SET status='' WHERE id='$text' AND userid='$userid'";
$result = $conn->query($sql);
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
       }
}else{



     if ($trackid == "") {
                                                 $trackid2 = mt_rand(11111, 99999).'b';
                                                 $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid2')";
                                                                      $result = $conn->query($sql);
                                          }else{
                                                 $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid')";
                                                                      $result = $conn->query($sql);
                                          }
$ntrackid = mt_rand(11111, 99999).'a';       
       $sql = "SELECT * FROM tasks WHERE status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){

       $sql = "SELECT * FROM tasks WHERE task='fname' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $fnames = '<b>1.</b> Firstname<br/>';
       }else{
       $fnames="";
       }
       $sql = "SELECT * FROM tasks WHERE task='lname' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $lnames = '<b>2.</b> Lastname<br/>';
       }else{
       $lnames="";
       }
       $sql = "SELECT * FROM tasks WHERE task='email' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $emails = '<b>3.</b> Email Address<br/>';
       }else{
       $emails="";
       }
       $sql = "SELECT * FROM tasks WHERE task='phone' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $phones = '<b>4.</b> Phone Number<br/>';
       }else{
       $phones="";
       }
       $sql = "SELECT * FROM tasks WHERE task='age' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $ages = '<b>5.</b> Age<br/>';
       }else{
       $ages="";
       }
       $sql = "SELECT * FROM tasks WHERE task='campus' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $campuss = '<b>6.</b> Institution<br/>';
       }else{
       $campuss="";
       }
       $sql = "SELECT * FROM tasks WHERE task='diocese' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $dioceses = '<b>7.</b> Diocese<br/>';
       }else{
       $dioceses="";
       }
       $sql = "SELECT * FROM tasks WHERE task='position' AND status='done' AND userid='$userid'";
       $result = $conn->query($sql);
       if (mysqli_num_rows($result) > 0){
       $positions = '<b>8.</b> Position<br/>';
       }else{
       $positions="";
       }

       $changetext = 'What do you want to change?<br/><br/>Please respond with a number most applicable to you:<br/>
       '.$fnames.$lnames.$emails.$phones.$ages.$campuss.$dioceses.$positions;
       $changetext1 = 'Respond with <b>RETURN</b> if you have nothing to change';
       $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$changetext', 'left', '$date', '$ntrackid')";
       $result = $conn->query($sql);
       $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$changetext1', 'left', '$date', '$ntrackid')";
       $result = $conn->query($sql);
       $sql = "UPDATE user SET next='partitype', task='change' WHERE userid='$userid'";
       $result = $conn->query($sql);
       }else{
       $changetext = 'You have not given any information yet';
       $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$changetext', 'left', '$date', '$ntrackid')";
       $result = $conn->query($sql);

       if ($partitype == 1) {
       $sql = "SELECT COUNT(*) AS tasktotal FROM tasks WHERE userid='$userid'";
                                          $result = $conn->query($sql);
                                          $row = $result->fetch_assoc();
                                          $tasktotal = $row['tasktotal'];
                                          for ($i=1; $i < $tasktotal; $i++) {
                                               $sql1 = "SELECT * FROM tasks WHERE id='$i' AND status='' AND userid='$userid'";
                                               $result1 = $conn->query($sql1);
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
                                                 break;
       }
}else{
       $ntrackid = mt_rand(11111, 99999).'a';
                                          $ntext = 'Please provide your registration number';
                                                        $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$ntext', 'left', '$date', '$ntrackid')";
                                                               $result = $conn->query($sql);
                                                               $sql = "SELECT * FROM user WHERE userid='$userid'";
                                                               $result = $conn->query($sql);
                                                               if (mysqli_num_rows($result) > 0){
                                                               $sql = "UPDATE user SET task='registration' WHERE userid='$userid'";
                                                               $result = $conn->query($sql);
                                                               }
}
}

}