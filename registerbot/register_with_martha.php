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
	$next = $row['next'];
	$task = $row['task'];
	$partitype = $row['partitype'];
    $end = $row['end'];
    $email = $row['email'];
    $phone = $row['phone'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $fullname = $fname.' '.$lname;
	if ($next !== "") {
		$processor = $row['next'];
	}else{
		$processor = "start";
	}

	if ($task !== "") {
		$task = $row['task'];
	}else{
		$task = "";
	}

	if ($partitype !== "") {
		$partitype = $row['partitype'];
	}else{
		$partitype = "";
	}
     if ($end == "now") {
        $sql = "UPDATE user SET end='' WHERE userid='$userid'";
        $result = $conn->query($sql);
        session_destroy();
        header("Location: index.php");
    }
	}else{
		$processor = "start";
		$task = "";
		$partitype = "";
	}
}else{
        $processor = "start";
        $task = "";
        $partitype = "";
    }


	function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'now';
}




                            ?>
<!doctype html>
<html lang="en">

    
<!-- Mirrored from themesbrand.com/chatvia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Mar 2021 04:09:05 GMT -->
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


    </head>

    <body style="max-height:500px; overflow:hidden;" onload="window.location.hash='scrollBottom'">

        <div class="layout-wrapper d-lg-flex">

  


            <!-- Start User chat -->
            <div class="w-100 overflow-hidden" style="background-color:white;">
                <div class="d-lg-flex">

                    <!-- start chat conversation section -->
                    <div class="w-100 overflow-hidden position-relative">
                        <!--<div class="p-3 p-lg-4 border-bottom">
                            <div class="row align-items-center">
                                <div class="col-sm-4 col-8">
                                    <div class="d-flex align-items-center">
                                        <div class="d-block d-lg-none me-2 ms-0">
                                            <a href="javascript: void(0);" class="user-chat-remove text-muted font-size-16 p-2"><i class="ri-arrow-left-s-line"></i></a>
                                        </div>
                                        <div class="me-3 ms-0">
                                            <img src="assets/images/users/martha.jpg" class="rounded-circle avatar-xs" alt="">
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="font-size-16 mb-0 text-truncate"><a href="#" class="text-reset user-profile-show">Martha &#128522;</a> <i class="ri-record-circle-fill font-size-10 text-success d-inline-block ms-1"></i></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-4">
                                    <ul class="list-inline user-chat-nav text-end mb-0">                                        
                                       
                                        <li class="list-inline-item">
                                            <div class="dropdown">
                                                <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ri-more-fill"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">New Registration</a>
                                                    <a class="dropdown-item" href="../sisters">Go Back</a>
                                                </div>
                                            </div>
                                        </li>  

                                    </ul>                                    
                                </div>
                            </div>
                        </div>
                        <!-- end chat user head -->
                        <button style="position:fixed; top:70%; left:1%; z-index: 1; background-color:#c4c4c4;" type="button" onclick="window.location.hash = 'scrollBottom3';" class="btn btn-sm font-size-16 btn-lg chat-send waves-effect waves-light">
                                                    <i data-feather="chevron-down"></i>
                                </button>
    
                        <!-- start chat conversation -->
                        <div class="chat_container chat-conversation p-3 p-lg-4" data-simplebar="init">
                            <ul class="list-unstyled mb-0" id="listerrs">
                            <div class="alert alert-info" role="alert">
							  This is a registration platform for the Sisters' Conference!
							</div>
							<li>
                                    <div class="conversation-list">
                                        <div class="chat-avatar">
                                        </div>
                                        
                                        <div class="user-chat-content">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                    My name is Martha and I will be your personal virtual registration assistant.<br/>
                                                        Please respond with <b>OK</b> to get started
                                                    </p>
                                                </div>
                                            </div>
        
                                            <div class="conversation-name">Martha &#128522;</div>
                                        </div>
                                        
                                    </div>
                                </li>
                            <div id="listerrsa">

                          	<?php
                            if (isset($_SESSION['userid'])) {
                          	$sql = "SELECT * FROM qanda WHERE userid='$userid'";
							$result = $conn->query($sql);
							if (mysqli_num_rows($result) > 0){
							while($row = $result->fetch_assoc()){
							$text = $row['text'];
							$qora = $row['qora'];
							$dater = strtotime($row['date']);
							$today = date("d-m-Y", time());
							$chattime = time_elapsed_string('@'.$dater);
							$idtrack = $row['trackid'].'id';
							echo '<li class="'.$qora.'" id="'.$idtrack.'">
                                    <div class="conversation-list">
                                        <div class="chat-avatar">
                                        </div>
    
                                        <div class="user-chat-content">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">';
                                                    echo $text;
                                                    echo '</p>
                                                    <p class="chat-time mb-0"><span class="align-middle">'.$chattime.'</span></p>';
                                                echo '</div>
                                            </div>
                                            <div class="conversation-name">'; 
                                            if ($qora == "right") {
                                            	echo "You &nbsp;<i style='font-weight:bold;' class='feather icon-check'></i>";
                                            }else{
                                            	echo "Martha &#128522;";
                                            }
                                            echo '</div>
                                        </div>
                                    </div>
                                </li>';
                            }
                        	}
                        }
                          	?>



                                <!--<li>
                                    <div class="conversation-list">
                                        <div class="chat-avatar">
                                            <img src="assets/images/users/martha.jpg" alt="">
                                        </div>
                                        
                                        <div class="user-chat-content">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <p class="mb-0">
                                                        typing
                                                        <span class="animate-typing">
                                                            <span class="dot"></span>
                                                            <span class="dot"></span>
                                                            <span class="dot"></span>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
        
                                            <div class="conversation-name">Martha</div>
                                        </div>
                                        
                                    </div>
                                </li>-->
                                

                                <form action="" method="post" id="chatForm">
                                    <input type="hidden" id="processor" name="processor" value="<?php echo $processor ?>">
                                    <input type="hidden" id="task" name="task" value="<?php echo $task ?>">
                                    <input type="hidden" id="partitype" name="partitype" value="<?php echo $partitype ?>">
                                </div>
                                <li id="scrollBottom" style="height:30px;"></li>
                                <li id="scrollBottom2" style="height:40px;"></li>
                                <li id="scrollBottom3" style="height:40px;"></li>
                                
                            </ul>
                        </div>
                        <!-- end chat conversation end -->
    
                        <!-- start chat input section -->
                      <div class="chat-input-section p-3 p-lg-4 border-top mb-0">
                        
                            
                            <div class="row g-0">
                                <div class="col">
                                    <input style="width:99%;" id="text" name="text" type="text" class="form-control form-control-lg bg-light border-light" placeholder="Enter Message..." required autocomplete="off">
                                    <input type="hidden" id="texters" name="texters" value="" required>
                                    <input type="hidden" name="trackid" value="">
                                    <span style="text-decoration:underline; cursor:pointer; margin-top:10px;" onclick="window.location='index'">Close Chat</span>
                                </div>
                                <div class="col-auto">
                                    <div class="chat-input-links ms-md-2 me-md-0">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <button type="button" onclick="chatSubmit()" class="btn btn-primary font-size-16 btn-lg chat-send waves-effect waves-light">
                                                    <i class="ri-send-plane-2-fill"></i>
                                                </button>
                                            </li>
                                            </form>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- end chat input section -->
                    </div>
                    <!-- end chat conversation section -->
    
                    <!-- start User profile detail sidebar -->
                    <div class="user-profile-sidebar">
                        <div class="px-3 px-lg-4 pt-3 pt-lg-4">
                            <div class="user-chat-nav text-end">
                                <button type="button" class="btn nav-btn" id="user-profile-hide">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                        </div>

                        <div class="text-center p-4 border-bottom">
                            <div class="mb-4">
                                <img src="assets/images/users/martha.jpg" class="rounded-circle avatar-lg img-thumbnail" alt="">
                            </div>

                            <h5 class="font-size-16 mb-1 text-truncate">Martha &#128522;</h5>
                            <p class="text-muted text-truncate mb-1"><i class="ri-record-circle-fill font-size-10 text-success me-1 ms-0"></i> Active</p>
                        </div>
                        <!-- End profile user -->

                        <!-- Start user-profile-desc -->
                        <div class="p-4 user-profile-desc" data-simplebar>
                            <div class="text-muted">
                                <p class="mb-4" style="text-align:center;">I'm always there to help out.<br/> Don't get me wrong, I love listening to the LORD but I think I've been called to serve &#128519;</p>
                            </div>

                            <div class="accordion" id="myprofile">
            
                                <div class="accordion-item card border mb-2">
                                    <div class="accordion-header" id="about3">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#aboutprofile" aria-expanded="true" aria-controls="aboutprofile">
                                            <h5 class="font-size-14 m-0">
                                                <i class="ri-user-2-line me-2 ms-0 align-middle d-inline-block"></i> About
                                            </h5>
                                        </button>
                                    </div>
                                    <div id="aboutprofile" class="accordion-collapse collapse show" aria-labelledby="about3" data-bs-parent="#myprofile">
                                        <div class="accordion-body">
                                            <div>
                                                <p class="text-muted mb-1">Name</p>
                                                <h5 class="font-size-14">Martha &#128522;</h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Family</p>
                                                <h5 class="font-size-14">Mary and Lazarus</h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Town</p>
                                                <h5 class="font-size-14">Bethany</h5>
                                            </div>

                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Favorite Qoute</p>
                                                <h5 class="font-size-14 mb-0">You are troubled about a lot of things but one thing is needful... &#128527;</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- end profile-user-accordion -->
                        </div>
                        <!-- end user-profile-desc -->
                    </div>
                    <!-- end User profile detail sidebar -->
                </div>
            </div>
            <!-- End User chat -->

            <!-- audiocall Modal -->
            <div class="modal fade" id="audiocallModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="text-center p-4">
                                <div class="avatar-lg mx-auto mb-4">
                                    <img src="assets/images/users/martha.jpg" alt="" class="img-thumbnail rounded-circle">
                                </div>

                                <h5 class="text-truncate">Martha &#128522;</h5>
                                <p class="text-muted">Start Audio Call</p>

                                <div class="mt-5">
                                    <ul class="list-inline mb-1">
                                        <li class="list-inline-item px-2 me-2 ms-0">
                                            <button type="button" class="btn btn-danger avatar-sm rounded-circle" data-bs-dismiss="modal">
                                                <span class="avatar-title bg-transparent font-size-20">
                                                    <i class="ri-close-fill"></i>
                                                </span>
                                            </button>
                                        </li>
                                        <li class="list-inline-item px-2">
                                            <button type="button" class="btn btn-success avatar-sm rounded-circle">
                                                <span class="avatar-title bg-transparent font-size-20">
                                                    <i class="ri-phone-fill"></i>
                                                </span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <!-- audiocall Modal -->

            <!-- videocall Modal -->
            <div class="modal fade" id="videocallModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="text-center p-4">
                                <div class="avatar-lg mx-auto mb-4">
                                    <img src="assets/images/users/martha.jpg" alt="" class="img-thumbnail rounded-circle">
                                </div>

                                <h5 class="text-truncate">Martha &#128522;</h5>
                                <p class="text-muted mb-0">Start Video Call</p>

                                <div class="mt-5">
                                    <ul class="list-inline mb-1">
                                        <li class="list-inline-item px-2 me-2 ms-0">
                                            <button type="button" class="btn btn-danger avatar-sm rounded-circle" data-bs-dismiss="modal">
                                                <span class="avatar-title bg-transparent font-size-20">
                                                    <i class="ri-close-fill"></i>
                                                </span>
                                            </button>
                                        </li>
                                        <li class="list-inline-item px-2">
                                            <button type="button" class="btn btn-success avatar-sm rounded-circle">
                                                <span class="avatar-title bg-transparent font-size-20">
                                                    <i class="ri-vidicon-fill"></i>
                                                </span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->
        </div>
        <!-- end  layout wrapper -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});


 		function chatSubmit(){
var listerrsa = document.getElementById("listerrsa");
var text = document.getElementById("text").value;
if (text == "") {
    document.getElementById("text").style.border = "2px solid red";
}else{
document.getElementById("texters").value = text;
var div = document.createElement('div');
div.setAttribute('class', 'someClass');
div.innerHTML = "<li class='right'><div class='conversation-list'><div class='chat-avatar'></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>" + text + "</p><p class='chat-time mb-0'><span class='align-middle'><?php echo date('h:i a', time()) ?></span></p></div></div><div class='conversation-name'>You &nbsp;<i id='seen' style='font-weight:bold; display:none;' class='feather icon-check'></i></div></div></div></li>";
document.getElementById('listerrsa').appendChild(div);
window.location.hash = "scrollBottom2";
setInterval(
  function(){ document.getElementById("seen").style.display="inline"; window.location.hash="scrollBottom";},
  2000
);

var typing = setInterval(
  function(){ var div = document.createElement('div');
div.setAttribute('class', 'someClasser');
div.innerHTML = "<li><div class='conversation-list'><div class='chat-avatar'></div><div class='user-chat-content'><div class='ctext-wrap'><div class='ctext-wrap-content'><p class='mb-0'>typing&nbsp;<span class='animate-typing'><span class='dot'></span>&nbsp;<span class='dot'></span>&nbsp;<span class='dot'></span></span></p></div></div><div class='conversation-name'>Martha &#128522;</div></div></div></li>";
document.getElementById('listerrsa').appendChild(div);
window.location.hash = "scrollBottom2";
reloadPage();
clearInterval(typing);},
  3000
);

setTimeout(function(){ 
    var texters=document.getElementById('texters').value;
    var processor=document.getElementById('processor').value;
    var task=document.getElementById('task').value;
    var partitype=document.getElementById('partitype').value;
    var trackid="";
    window.location.hash = "scrollBottom2";
    $.ajax({
            type:"post",
            url:"chatsource.php",
            data: 
            {  
               'texters' :texters,
               'processor' :processor,
               'task' :task,
               'partitype' :partitype,
               'trackid' :trackid
            },
            cache:false,
            success: function (html) 
            {
               $('#listerrsa').load(document.URL +  ' #listerrsa');
               window.location.hash = "scrollBottom3";
            },
            error: function (html)
            {
                alert('Please check your internet connection! Click ok to resend your message');
                errorRun();
            }
            });
            return false;
}, 4000);
document.getElementById("text").value = "";

//setInterval(
 // function(){$('#listerrsa').load(document.URL +  ' #listerrsa');
 //              window.location.hash = "scrollBottom3";},
  //60000
//);

//var reload = setInterval(
//  function(){ $("#listerrs").load("index.php")
//        return false;
//clearInterval(reload);},
//  5000
//);

}

 		}


function reloadPage(){
    setTimeout(function(){
    $('#listerrsa').load(document.URL +  ' #listerrsa');
    window.location.hash = "scrollBottom3";
    }, 8000);
}

function errorRun(){
var texters=document.getElementById('texters').value;
    var processor=document.getElementById('processor').value;
    var task=document.getElementById('task').value;
    var partitype=document.getElementById('partitype').value;
    var trackid="";
    window.location.hash = "scrollBottom2";
    $.ajax({
            type:"post",
            url:"chatsource.php",
            data: 
            {  
               'texters' :texters,
               'processor' :processor,
               'task' :task,
               'partitype' :partitype,
               'trackid' :trackid
            },
            cache:false,
            success: function (html) 
            {
               $('#listerrsa').load(document.URL +  ' #listerrsa');
               window.location.hash = "scrollBottom3";
            },
            error: function (html)
            {
                alert('Please check your internet connection! Click ok to resend your message');
                errorRun();
            }
            });
}

function makePayment() {
    FlutterwaveCheckout({
      public_key: "FLWPUBK-303a170f1422832a527c4b7245054c7b-X",
      tx_ref: "<?php echo mt_rand(111111, 999999)?>",
      amount: 1000,
      currency: "NGN",
      country: "NG",
      payment_options: "card, mobilemoneyghana, ussd",
      redirect_url:"http://wcccfonline.org/sisters/paysuccess?paysuccess",
      meta: {
        consumer_id: "<?php echo mt_rand(111, 999) ?>",
      },
      customer: {
        email: "pay@wcccfonline.org",
      },
      callback: function (data) {
        console.log(data);
      },
      onclose: function() {
        // close modal
      },
      customizations: {
        title: "Sisters' Conference 2021",
        description: "Registration Fee",
        logo: "http://wcccfonline.org/img/logo.png",
      },
    });
  }
        </script>
        <script>
      feather.replace()
    </script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- Magnific Popup-->
        <script src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

        <!-- owl.carousel js -->
        <script src="assets/libs/owl.carousel/owl.carousel.min.js"></script>

        <!-- page init -->
        <script src="assets/js/pages/index.init.js"></script>

        <script src="assets/js/app.js"></script>

    </body>

<!-- Mirrored from themesbrand.com/chatvia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Mar 2021 04:09:21 GMT -->
</html>
