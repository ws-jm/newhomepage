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
    <title>Send Emoji Message | Credit Panel | Bulk Whatsapp Broadcast</title>
		<?php include 'libfiles.php'?> 
        <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="assets/css/emojis.css">
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
    <?php include 'sidebar.php'?>
	<?php include 'header.php'?>
    
    
    
                        <div class="row" style="margin:3%">
                            <div class="card card-flush">
                                <div class="white-box" style="padding:3%">
                                        <div class="col-md-12">
                                        <a style="float:right" href="sendwhatsapp.php"
                                                              class="btn btn-primary pull-right">Back</a></div>
                                    <h2 class="text-primary">Text Message
                                        <span class="badge badge-light-danger">Total Campaign's Today : <?php

                                            $sort_date = date("Y-m-d");

                                            $conn1 = new mysqli($servername, $username, $password, $dbname);
                                            if ($conn1->connect_error) {
                                                die("Connection failed: " . $conn1->connect_error);
                                            }
                                            $stmt1 = $conn1->prepare("SELECT count(login_id) FROM `send_wp_msgs` WHERE `login_id` = ? and `sort_date_wise` = ?");
                                            $stmt1->bind_param("is", $_SESSION['login_id'],$sort_date);
                                            $stmt1->execute();
                                            $stmt1->bind_result($today_total_cam_count);
                                            $stmt1->fetch();
                                            $conn1->close();
                                            if(empty($today_total_cam_count)){
                                                echo "0";
                                            }else{
                                                echo $today_total_cam_count;
                                            }?>
                                        </span>
                                    </h2><br><br>
                                    
                                    
                                    <form class="form" method="post" action="w_textmessage.php" enctype="multipart/form-data">
                                        <input type="hidden" name="login_id" value="<?php echo $_SESSION['login_id']; ?>">
                                        <!-- Phone Number -->
                                        <div class="d-flex flex-column mb-10 fv-row">
                                            <label for="exampleFormControlTextarea1" class="required fs-5 fw-bold mb-2">Mobile No.<span class="mandatory">
                                                </span> </label>
                                            <textarea onKeyUp="countline()" type="text" class="form-control form-control-solid" cols="10" rows="5" id="mobileno3" name="mobileno" placeholder="Please Add 91 before Mobile No."></textarea>
                                        </div>
                                        <!-- Number Count -->
                                        <div class="d-flex flex-column mb-10 fv-row">
                                            <label for="userName" class="required fs-5 fw-bold mb-2">Number Count</label>
                                            <input type="text" class="form-control form-control-solid" readonly id="numbercount3" required
                                                    name="numbercount" value="">
                                        </div>
                                        <!-- Message -->
                                        <div id = "show_message" class="flex-column mb-10 fv-row">
                                            <label for="exampleFormControlTextarea1" class="required fs-5 fw-bold mb-2">Message</label>
                                            
                                            <textarea name="description"  id="mytextarea" class="form-control form-control-solid" placeholder="Type your Message here..."
                                                        cols="10" rows="5"></textarea>

                                            <div class="symbol symbol-40px me-5">
                                                <span class="picker-emoji-sel emoji-gestures" id="open_ico" title="click me" style="cursor: pointer;" onclick="ico_show()" data-emoji="smileys">😀</span>
                                            </div>      
                                            
                                            <div id="emojis" style="display:none;">

                                            </div>
                                        </div>

                                        <div class="modal-footer flex-center">
                                            <button type="reset" id="kt_modal_create_api_key_cancel" class="btn btn-light me-3">Discard</button>
                                            <button type="submit" name="submit" id="kt_modal_create_api_key_submit" class="btn btn-primary">
                                                <span class="indicator-label">Send Now</span>
                                                <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                    </form>
                              
                            </div>
                        </div>
                        
		<?php include 'footer.php'?>			
	</body>
	<!--end::Body-->
</html>

    <script>
        function countline() {
        var length = $('#mobileno3').val().split("\n").length;
        document.getElementById("numbercount3").value = length;
        }    
    </script>

    <script type="text/javascript"  
	    src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://twemoji.maxcdn.com/v/latest/twemoji.min.js" crossorigin="anonymous"></script>
	<script src="assets/js/DisMojiPicker.js"></script>

	<script>

        $('.picker-emoji-sel emoji-smiley').click(function() {
            $(`.picker-emoji-sel.emoji-smiley`).addClass('active');
        });

        function ico_show(){
            document.getElementById("emojis").style.display == "none" 
            ? document.getElementById("emojis").style.display = "block"
            : document.getElementById("emojis").style.display = "none";
        }

        // document.getElementById("emojis").style.display == "none"
        //document.getElementById("open_ico").innerHtml = 😀
        //document.getElementById("open_ico").innerHtml = 🙂;

		$("#emojis").disMojiPicker()
		$("#emojis").picker(emoji => {

            if(document.getElementById("mytextarea").value != null){
                document.getElementById("mytextarea").value += emoji;
            }
		});
		twemoji.parse(document.body);

	</script>

	<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-36251023-1']);
		_gaq.push(['_setDomainName', 'jqueryscript.net']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>

	<script>
		try {
			fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
				return true;
			}).catch(function(e) {
				var carbonScript = document.createElement("script");
				carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
				carbonScript.id = "_carbonads_js";
				document.getElementById("carbon-block").appendChild(carbonScript);
			});
		} catch (error) {
		console.log(error);
		}
	</script>