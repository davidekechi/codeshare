        <?php
       include 'dbh.php';
       session_start();
       if (isset($_POST['processor'])) {
       $date = date("d-m-Y h:i:s a", time());
       $userid = $_SESSION['userid'];
       $processor = mysqli_real_escape_string($conn, $_POST['processor']);
       $trackid = mysqli_real_escape_string($conn, $_POST['trackid']);
       $text = mysqli_real_escape_string($conn, $_POST['texters']);
       $textlow = strtolower($text);
       $task = mysqli_real_escape_string($conn, $_POST['task']);
       $partitype = mysqli_real_escape_string($conn, $_POST['partitype']);
       if ($processor == "start") {
              if (!isset($_SESSION['userid'])) {
       $_SESSION['userid'] = 'SC/'.mt_rand(111111, 999999);
       }
       require 'chatsource/start.php';
       }elseif ($processor == "partitype") {
       if (strpos($textlow, 'end') !== false){
              require 'chatsource/mainmenu.php';
       }elseif (strpos($textlow, 'change') !== false){
              require 'chatsource/change.php';
              }elseif ($task == "") {
              if ($text == 1) {
                     $userid = $_SESSION['userid'];
       $x = 1;
        while($x < 10){
       $sql = "SELECT * FROM taskees WHERE id='$x'";
       $result = $conn->query($sql);
       $row = $result->fetch_assoc();
        $idees = $row['id'];
        $taskees = $row['task'];
        $questionees = $row['question'];
        $sql = "INSERT INTO tasks (id, task, question, userid) VALUES ('$idees', '$taskees', '$questionees', '$userid')";
       $result = $conn->query($sql);
       $x++;
       }
              $sql = "UPDATE user SET partitype='1' WHERE userid='$userid'";
              $result = $conn->query($sql);
              require 'chatsource/newpart.php';
       }elseif ($text == 2) {
              $sql = "UPDATE user SET partitype='2' WHERE userid='$userid'";
              $result = $conn->query($sql);
              require 'chatsource/returnpart.php';
       }elseif ($text == 3) {
              $sql = "UPDATE user SET partitype='3' WHERE userid='$userid'";
              $result = $conn->query($sql);
              require 'chatsource/regverify.php';
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
                                                 $ntext = '
                                                               Please respond with a number most applicable to you:<br/>
                                                               <b>1</b>. New Participant<br/>
                                                               <b>2</b>. Returning Participant<br/>
                                                               <b>3</b>. Verify Registration Number';

                                                 $ntext1 = 'Sorry, I could not understand your reply!';
                                                 $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$ntext1', 'left', '$date', '$ntrackid')";
                                                                      $result = $conn->query($sql);
                                                 $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$ntext', 'left', '$date', '$ntrackid')";
                                                                      $result = $conn->query($sql);
                                                                      $sql = "SELECT * FROM user WHERE userid='$userid'";
                                                                      $result = $conn->query($sql);
                                                                      if (mysqli_num_rows($result) > 0){
                                                                      $sql = "UPDATE user SET next='partitype' WHERE userid='$userid'";
                                                                      $result = $conn->query($sql);
                                                                      }else{
                                                                      $sql = "INSERT INTO user (userid, next) VALUES ('$userid', 'partitype')";
                                                                      $result = $conn->query($sql);      
                                                                      } 
       }
              }elseif ($task !== "" && $task !== "change" && $task !== "confirm" && $task !== "continue" && $task !== "end") {
                     if ($partitype == 1) {
              require 'chatsource/newpart.php';
       }elseif ($partitype == 2) {
              require 'chatsource/returnpart.php';
       }elseif ($partitype == 3) {
              require 'chatsource/regverify.php';
       }
              }elseif ($task == "change") {
       if (strpos($textlow, 'return') !== false) {
                if ($trackid == "") {
                                                        $trackid2 = mt_rand(11111, 99999).'b';
                                                        $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid2')";
                                                                             $result = $conn->query($sql);
                                                 }else{
                                                        $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid')";
                                                                             $result = $conn->query($sql);
                                                 }
              $ntrackid = mt_rand(11111, 99999).'a';
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
       }else{
             require 'chatsource/change.php'; 
       }
       }elseif ($task == "confirm") {
       if (strpos($textlow, 'continue') !== false) {
              require 'chatsource/final.php';
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
              $sql17 = "SELECT * FROM user WHERE userid='$userid'";
                                                          $result17 = $conn->query($sql17);
                                                          $row17 = $result17->fetch_assoc();
                                                          $question91 = 'Sorry, I could not understand your reply!';
                                                       $question11 = 'Please confirm that all your information listed below are correct.<br/><br/>
                                                       Firstname: <b style="text-decoration:underline;">'.$row17['fname'].'</b><br/>
                                                         Lastname: <b style="text-decoration:underline;">'.$row17['lname'].'</b><br/>
                                                         Email Address: <b style="text-decoration:underline;">'.$row17['email'].'</b><br/>
                                                         Phone Number: <b style="text-decoration:underline;">'.$row17['phone'].'</b><br/>
                                                         Age: <b style="text-decoration:underline;">'.$row17['age'].'</b><br/>
                                                         Instiution: <b style="text-decoration:underline;">'.$row17['campus'].'</b><br/>
                                                         Diocese: <b style="text-decoration:underline;">'.$row17['diocese'].'</b><br/>
                                                         Position: <b style="text-decoration:underline;">'.$row17['position'].'</b><br/><br/>
                                                         Please respond with <b>CHANGE</b> to change any information<br/> or respond with <b>CONTINUE</b> to proceed';
                                                        $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question91', 'left', '$date', '$ntrackid')";
                                                        $result3 = $conn->query($sql3);
                                                        $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question11', 'left', '$date', '$ntrackid')";
                                                        $result3 = $conn->query($sql3);
                                                        $sql2 = "UPDATE user SET task='confirm' WHERE userid='$userid'";
                                                        $result2 = $conn->query($sql2);
       }
       }elseif ($task == "continue") {
              if ($trackid == "") {
              $trackid2 = mt_rand(11111, 99999).'b';
              $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid2')";
                                   $result = $conn->query($sql);
       }else{
              $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid')";
                                   $result = $conn->query($sql);
       }
       $ntrackid = mt_rand(11111, 99999).'a';
       $question10 = 'Sorry, I could not understand your reply!';
       $question21 = 'Please respond with <b>CHANGE</b> to edit your information<br/>or respond with <b>END</b> to end this chat once you are done with your registration';
       $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question10', 'left', '$date', '$ntrackid')";
       $result3 = $conn->query($sql3);
       $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question21', 'left', '$date', '$ntrackid')";
       $result3 = $conn->query($sql3);
       }elseif ($task == "end") {
              if (strpos($textlow, 'continue') !== false) {
              $sql = "DELETE FROM qanda WHERE userid='$userid'";
              $result = $conn->query($sql);
              $sql = "UPDATE user SET end='now' WHERE userid='$userid'";
               $result = $conn->query($sql);
       }elseif (strpos($textlow, 'return') !== false) {
              if ($trackid == "") {
                                                        $trackid2 = mt_rand(11111, 99999).'b';
                                                        $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid2')";
                                                                             $result = $conn->query($sql);
                                                 }else{
                                                        $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$text', 'right', '$date', '$trackid')";
                                                                             $result = $conn->query($sql);
                                                 }
              $ntrackid = mt_rand(11111, 99999).'a';
              $sql = "SELECT COUNT(*) AS tasktotal FROM tasks";
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
                                                 $ntext2 = 'Sorry, I could not understand your reply!';
                                                 $ntext1 = 'Note that by ending this chat, all messages in this chat will be removed<br/><br/>
                                                 Please respond with <b>CONTINUE</b> to end registration<br>or respond with <b>RETURN</b> to cancel action';

                                                 $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$ntext2', 'left', '$date', '$ntrackid')";
                                                                      $result = $conn->query($sql);
                                                 $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$ntext1', 'left', '$date', '$ntrackid')";
                                                                      $result = $conn->query($sql);
                                                                      $sql = "UPDATE user SET next='partitype', task='end' WHERE userid='$userid'";
                                                                      $result = $conn->query($sql);
       }
       }
       }
       }
