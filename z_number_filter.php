<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
if (isset($_SESSION['login_status'])) {
    if (($_SESSION['login_status'] != 1)) {
        header("Location: process_login.php");
        exit();
    }
}
if (!isset($_SESSION['login_status'])) {
    $_SESSION['login_status'] = 0;
    header("Location: process_login.php");
    exit();
}
if($_SESSION['login_type'] == 'admin'){
    $_SESSION['login_status']=0;
    header("Location: process_login.php");
    exit();
}
include_once 'db_config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("select headline from headlines");
$stmt->execute();
$stmt->bind_result($head_line);
$stmt->fetch();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
    <meta name="description" content="Start Using Credit Panel Now and Start Broadcasting Bulk Whatsapp Message with Credit Panel best Features Like Send Text Message, Send Emoji Message, Send Image Message, Send PDF Message, Send Audio Message, Send Video Message, Send Interactive Button Message, Send Interactive List Message, and Much more." />
	<meta name="keywords" content="Credit Panel, Send Text Message, Send Emoji Message, Send Image Message, Send PDF Message, Send Audio Message, Send Video Message, Send Interactive Button Message, Send Interactive List Message, Bulk Whatsapp API, Bulk Whatsapp, Whatsapp Official API, Bulk Broadcast, Whatsapp Credit Panel," />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Credit Panel Dashboard" />
	<meta property="og:url" content="https://creditpanel.in/index.php" />
	<meta property="og:site_name" content="Credit Panel Bulk Whatsapp Broadcast" />
    <title>Number Filter | Credit Panel | Bulk Whatsapp Broadcast</title>
		<?php include 'libfiles.php'?> 
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
    <?php include 'sidebar.php'?>
	<?php include 'header.php'?>
    
    
    
        <div class="row" style="margin:3%">
            <div class="card card-flush">
                <div class="white-box" style="padding:3%">
                    
                    <h2 class="text-primary">Check if a Phone Number Exists in WhatsApp
                        <br><br>
                                       
                    <form class="form" method="post" action="w_numberfilter.php" enctype="multipart/form-data">
                    <input type="hidden" name="login_id" value="<?php echo $_SESSION['login_id']; ?>">
                        <!-- Phone Number -->
                                    <div class="d-flex flex-column mb-10 fv-row">
                                        <label for="exampleFormControlTextarea1" class="required fs-5 fw-bold mb-2">Mobile No.<span class="mandatory">
                                            </span> </label>
                                        <textarea onKeyUp="countline()" type="text" class="form-control form-control-solid" cols="10" rows="5" id="mobileno5" name="mobileno" placeholder="Please Add 91 before Mobile No."></textarea>
                                    </div>
                                    <!-- Number Count -->
                                    <div class="d-flex flex-column mb-10 fv-row">
                                        <label for="userName" class="required fs-5 fw-bold mb-2">Number Count</label>
                                        <input type="text" class="form-control form-control-solid" readonly id="numbercount5" required
                                                name="numbercount" value="">
                                    </div>
                                    
                                <button type="reset" id="kt_modal_create_api_key_cancel" class="btn btn-light me-3">Discard</button>
                                <button type="submit" name="submit" id="kt_modal_create_api_key_submit" class="btn btn-primary">
                                    <span class="indicator-label">Check</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                    </form>
                
            </div>
        </div>
             
        <script>
        function countline() {
        var length = $('#mobileno5').val().split("\n").length;
            document.getElementById("numbercount5").value = length;
        }    
        </script>

		<?php include 'footer.php'?>			
	</body>
	<!--end::Body-->
</html>