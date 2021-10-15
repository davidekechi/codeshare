<?php
 ob_start();
       date_default_timezone_set('Africa/Lagos');
       include 'dbh.php';
       session_start();
       if (isset($_SESSION['userid'])) {
              $userid = $_SESSION['userid'];
       }
$date = date("d-m-Y h:i:s a", time());
                                          $userid = $_SESSION['userid'];
                                          if (strpos($textlow, 'ok') !== false) {
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
                                                        <b>2</b>. Returning Participant';

                                          $ntext1 = 'Respond with <b>CHANGE</b> to edit your information at any time or<br/>respond with <b>END</b> to end this registration at any time';
                                          $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$ntext', 'left', '$date', '$ntrackid')";
                                                               $result = $conn->query($sql);
                                          $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$ntext1', 'left', '$date', '$ntrackid')";
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
                                          $ntexterr = 'Sorry, I could not understand your reply';
                                          $ntext = 'Please respond with <b>OK</b> to get started';
                                          $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$ntexterr', 'left', '$date', '$ntrackid')";
                                          $result = $conn->query($sql);
                                          $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$ntext', 'left', '$date', '$ntrackid')";
                                          $result = $conn->query($sql);
                                                               $sql = "SELECT * FROM user WHERE userid='$userid'";
                                                               $result = $conn->query($sql);
                                                               if (mysqli_num_rows($result) < 1){
                                                               $sql = "INSERT INTO user (userid, next) VALUES ('$userid', '')";
                                                               $result = $conn->query($sql);      
                                                               }
                                          }
                                   