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
                                          $ntext1 = 'Note that by ending this chat, all messages in this chat will be removed<br/><br/>
                                          Please respond with <b>CONTINUE</b> to end registration<br>or respond with <b>RETURN</b> to cancel action';

                                          $sql = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$ntext1', 'left', '$date', '$ntrackid')";
                                                               $result = $conn->query($sql);
                                                               $sql = "UPDATE user SET next='partitype', task='end' WHERE userid='$userid'";
                                                               $result = $conn->query($sql);