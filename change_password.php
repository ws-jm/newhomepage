<?php
session_start();
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
if ($_SESSION['login_type'] == 'admin') {
    $_SESSION['login_status'] = 0;
    header("Location: process_login.php");
    exit();
}
include_once 'db_config.php';
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
    <title>Change Password | Credit Panel | Bulk Whatsapp Broadcast</title>
		<?php include 'libfiles.php'?> 
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
    <?php include 'sidebar.php'?>
    <?php include 'header.php'?>
    	
        <?php if(isset($_GET['success'])){
            echo "<script>
            $(document).ready(function(){
                toastr.success('Password changed Successfully! ', 'Success'); 
            });</script>";
                        
        }

        if(isset($_GET['error'])){ 
            echo "<script>
            $(document).ready(function(){
                toastr.success('".$_SESSION['error']."', 'Error. Please Try Again!'); 
            });</script>";
            $_SESSION['error'] = null;
         } ?>

        <!--begin::Contact-->
        <div class="card card-flush">
            <!--begin::Body-->
            <div class="card-body p-lg-17">
                <!--begin::Row-->
                <div class="row mb-3">
                    <!--begin::Col-->
                    <div class="col-md-10 pe-lg-10">
                        <!--begin::Form-->
                        <form class="form" method="post" action="process-change-password.php" enctype="multipart/form-data">
                            <h1 class="fw-bolder  mb-9 text-primary">Change Password</h1>
                            <!--begin::Input group-->
                            <div class="col-md-8 fv-row">
                                <label for="mobile" class="col-lg-4 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Current Password  <span
                                            class="mandatory">*</span></label>
                                <div class="col-lg-8">
                                    <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="password" placeholder="Old Password" name="old_password"
                                        id="current_pwd" value="" required>
                                </div>
                            </div>
                            <div class="col-md-8 fv-row">
                                <label for="email" class=" col-lg-4 col-form-label text-dark text-hover-primary fs-5 fw-bolder">New Password <span
                                            class="mandatory">*</span></label>
                                <div class="col-lg-8">
                                    <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="password" placeholder="New Password" name="new_password"
                                        id="new_pwd" value="" required>
                                </div>
                            </div>
                            <div class="col-md-8 fv-row">
                                <label for="mobile" class=" col-lg-4 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Confirm Password  <span
                                            class="mandatory">*</span></label>
                                <div class="col-lg-8">
                                    <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="password" placeholder="Confirm Password" name="confirm_new_password"
                                        id="conf_pwd" value="" required>
                                </div>
                            </div><br>

                            <div class="col-md-8 fv-row">
                                <div class="col-lg-9">
                                    <button type="submit" name="submit"
                                            class="btn btn-primary pulse pulse-white">Submit
                                    </button>
                                </div>
                            </div>
                            <!--end::Description-->
                        </form>
                        <!--end::Address-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                
            </div>
            <!--end::Body-->
        </div>
        <!--end::Contact-->


				
					


		<?php include 'footer.php'?>			
	</body>
	<!--end::Body-->
</html>