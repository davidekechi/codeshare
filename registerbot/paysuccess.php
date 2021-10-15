<?php
ob_start();
    date_default_timezone_set('Africa/Lagos');
    include 'dbh.php';
    session_start();
    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        $sql = "SELECT * FROM user WHERE userid='$userid'";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0){
    $row = $result->fetch_assoc();
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    }
    $to = $email;
    $subject = "Registration Code for Sisters' Conference 2021";
    $headers = "From: support@wcccfonline.org" . "\r\n" .
"CC: support@wcccfonline.org";
    $message = 'Congratulations '.$fname.', your Registration Code is '.$userid;
mail($to,$subject,$message,$headers);

    $sql = "UPDATE user SET payment='yes', amount='1000' WHERE userid='$userid'";
    $result = $conn->query($sql);
    $sql = "DELETE FROM qanda WHERE userid='$userid'";
    $result = $conn->query($sql);
    }else{
        header("Location: ../sisters");
        exit();   
    }

    if (!isset($_GET['paysuccess'])) {
        header("Location: ../sisters");
        exit();
    }
    ?>
<!doctype html>
<html lang="en">

    
<head>
        
        <meta charset="utf-8" />
        <title>Registration | Watchman  International Campus Sisters (workers/leaders) Congress/ Conference</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Sisters' Conference 2021" name="description" />
        <meta content="Watchman Campus Fellowship" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="logo.png">

        <!-- magnific-popup css -->
        <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />

        <!-- owl.carousel css -->
        <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.carousel.min.css">

        <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.theme.default.min.css">
        <link rel="stylesheet" type="text/css" href="assets/icon/feather/css/feather.css">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap-dark.min.css" id="bootstrap-dark-style" rel="stylesheet" type="text/css" />
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app-dark.min.css" id="app-dark-style" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/core.js"></script>
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <script src="https://checkout.flutterwave.com/v3.js"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Original+Surfer&display=swap" rel="stylesheet">


    </head>

    <body style="" onload="">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="padding-top:20px; text-align:center; font-family: 'Original Surfer', cursive;">
                <img src="check.png"><br/>
                <h3 style="font-family: 'Original Surfer', cursive;">Congratulations <?php echo $fname ?>, you have completed your registration for the <br/>Sisters' Conference 2021</h3><br/>
                <p style="font-size:17px;">Your registration code is <b><?php echo $userid ?></b></p>
                <a href="../sisters"><button class="btn btn-danger">Go Back</button></a>
            </div>
            <div class="col-md-2" style=""></div>
        </div>
    </body>
    </html>