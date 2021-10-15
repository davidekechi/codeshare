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
$sql = "SELECT * FROM user WHERE userid='$userid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$payment = $row['payment'];
if ($payment == "") {
$sql17 = "SELECT * FROM user WHERE userid='$userid'";
                                                   $result17 = $conn->query($sql17);
                                                   $row17 = $result17->fetch_assoc();
$question91 = 'Bravo '.$row17['fname'].', you have done an amazing job so far.<br/>Your registration code is <b>'.$userid.'</b><br/>Please copy this to somewhere safe';
$question101 = 'To complete your registration, please click or tap on the link below to make a secure registration payment of <b>&#8358;1,000</b><br/><br/>
<span onClick="makePayment()" style="cursor:pointer; color:white; font-style:italic; text-decoration:underline;">https://cutt.ly/uvRpFmz</span><br/><br/>
Or you can skip this part and make payment at your local branch.<br><br/>Please note that your registration is <b>NOT</b> complete until you have made your payment';
$question21 = 'Please respond with <b>CHANGE</b> to edit your information<br/>or respond with <b>END</b> to end this chat once you are done with your registration';
$sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question91', 'left', '$date', '$ntrackid')";
$result3 = $conn->query($sql3);
$sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question101', 'left', '$date', '$ntrackid')";
$result3 = $conn->query($sql3);
$sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question21', 'left', '$date', '$ntrackid')";
$result3 = $conn->query($sql3);
}else{
	$question91 = 'Congratulations '.$row17['fname'].', your registration for the Sisters Conference is complete!</b>';
	$question21 = 'Please respond with <b>CHANGE</b> to edit your information<br/>or respond with <b>END</b> to end this chat once you are done with your registration';
	$sql3 = "INSERT INTO qanda (userid, text, qora, date, trackid) VALUES ('$userid', '$question21', 'left', '$date', '$ntrackid')";
	$result3 = $conn->query($sql3);
}
$sql2 = "UPDATE user SET task='continue', status='complete' WHERE userid='$userid'";
$result2 = $conn->query($sql2);