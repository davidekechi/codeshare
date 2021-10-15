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

                                           if ($task == "registration") {
                                                 $sql = "SELECT * FROM user WHERE userid='$text'";
                                                 $result = $conn->query($sql);
                                                 if (mysqli_num_rows($result) < 1){
                                                        $ntrackid = mt_rand(11111, 99999).'a';
                                          $ntext1 = 'Sorry, I could not verify this registration number.<br/> Please check it and try again.';
                                          $ntext = 'Please provide your registration number';
                                                        $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$ntext1', 'left', '$date', '$ntrackid')";
                                                               $result = $conn->query($sql);
                                                        $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$ntext', 'left', '$date', '$ntrackid')";
                                                               $result = $conn->query($sql);
                                          }else{
                                                 $sql = "UPDATE qanda SET userid='$text' WHERE userid='$userid'";
                                                 $result = $conn->query($sql);
                                                 $sql = "SELECT * FROM user WHERE userid='$userid' AND status='complete'";
                                                 $result = $conn->query($sql);
                                                 if (mysqli_num_rows($result) < 1){
                                                 $sql = "DELETE FROM user WHERE userid='$userid'";
                                                 $result = $conn->query($sql);
                                                 }
                                                 $_SESSION['userid'] = $text; 
                                                 $userid = $_SESSION['userid'];
                                                 $sql = "SELECT * FROM user WHERE userid='$userid'";
                                                   $result = $conn->query($sql);
                                                   $row = $result->fetch_assoc();
                                                   $question101 = '
                                                  Alright '.$row['fname'].', please confirm that all your information listed below are correct.';
                                                $question11 = '
                                                Firstname: <b style="text-decoration:underline;">'.$row['fname'].'</b><br/>
                                                  Lastname: <b style="text-decoration:underline;">'.$row['lname'].'</b><br/>
                                                  Email Address: <b style="text-decoration:underline;">'.$row['email'].'</b><br/>
                                                  Phone Number: <b style="text-decoration:underline;">'.$row['phone'].'</b><br/>
                                                  Age: <b style="text-decoration:underline;">'.$row['age'].'</b><br/>
                                                  Instiution: <b style="text-decoration:underline;">'.$row['campus'].'</b><br/>
                                                  Diocese: <b style="text-decoration:underline;">'.$row['diocese'].'</b><br/>
                                                  Position: <b style="text-decoration:underline;">'.$row['position'].'</b>';

                                                $question12 = 'Please respond with <b>CHANGE</b> to change any information<br/> or respond with <b>CONTINUE</b> to proceed';
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question101', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question11', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question12', 'left', '$date', '$ntrackid')";
                                                 $result3 = $conn->query($sql3);
                                                 $sql2 = "UPDATE user SET task='confirm' WHERE userid='$userid'";
                                                 $result2 = $conn->query($sql2);
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

                                         