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
    <title>Update Profile | Credit Panel | Bulk Whatsapp Broadcast</title>
		<?php include 'libfiles.php'?> 
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
    <?php include 'sidebar.php'?>
	<?php include 'header.php'?>
    <!-- /row -->
    <?php if (isset($_GET['deleted'])) { 
            echo "<script>
            $(document).ready(function(){
                toastr.success(' deleted Successfully!', 'Success'); 
            });</script>";
    } ?>

        <?php if (isset($_GET['error1'])) { 
            echo "<script>
            $(document).ready(function(){
                toastr.error('Error deleting image.Please Try Again!', 'Error'); 
            });</script>";
                        
        } ?>

        <?php if (isset($_GET['update'])) {
            echo "<script>
            $(document).ready(function(){
                toastr.success('Updated Successfully!', 'Success'); 
            });</script>";               
        }

        if (isset($_GET['error'])) { 
            echo "<script>
            $(document).ready(function(){
                toastr.error('Error in update. Please Try Again!', 'Error'); 
            });</script>";
                        
        } ?>
        <?php if (isset($_GET['success2'])) {
            echo "<script>
            $(document).ready(function(){
                toastr.success('Edited Successfully!', 'Success'); 
            });</script>";   
                        
        }

        if (isset($_GET['error2'])) {
            echo "<script>
            $(document).ready(function(){
                toastr.error('Error in Editing. Please Try Again!', 'Error'); 
            });</script>";               
        } ?>

        
        <?php

        $user_unique_id = $_SESSION['user_unique_id'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("select full_name, username, email_id, profilepic, mobile, company from logins Where user_unique_id = ?");
        $stmt->bind_param("s", $user_unique_id);
        $stmt->execute();
        $stmt->bind_result($full_name, $u_name, $email_id, $profile, $mob_no, $company);
        $stmt->fetch();
        $conn->close();
        ?>

        
        <div class="row">
            <div class="card card-flush">
                <div class="white-box" style="padding:5%; margin-left:10%">
                    <h3 class="box-title m-b-0 text-primary">Update Profile</h3>
                    <br>
                    <form class="form" method="post" action="process-login-profile.php" enctype="multipart/form-data">
                        <input type="hidden" name="unique_id" id="unique_id" value="<?php echo $user_unique_id; ?>">
                        <div class="form-group row">
                            <label for="mobile" class=" col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Username <span
                                        class="mandatory text-danger">*</span></label>
                            <div class="col-6 col-lg-5 mb-5">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Username" name="username"
                                       id="username" value="<?php echo $u_name; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class=" col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Email Id <span
                                        class="mandatory text-danger">*</span></label>
                            <div class="col-6 col-lg-5 mb-5">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="email" placeholder="Email" name="email"
                                       id="email" value="<?php echo $email_id; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class=" col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Fullname <span
                                        class="mandatory text-danger">*</span></label>
                            <div class="col-6 col-lg-5 mb-5">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Fullname" name="fullname"
                                       id="full_name" value="<?php echo $full_name; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class=" col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Profilepic
                            </label>

                            <div class="col-6 col-lg-5 mb-5">
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="assets/media/avatars/150-26.jpg">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class=" col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Mobile No. <span class="mandatory text-danger">*</span></label>
                            <div class="col-6 col-lg-5 mb-5">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Mobile" name="mobile"
                                       id="mobile" value="<?php echo $mob_no; ?>" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="mobile" class=" col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Company <span
                                        class="mandatory text-danger">*</span></label>
                            <div class="col-6 col-lg-5 mb-5">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Company" name="company"
                                       id="company" value="<?php echo $company; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-8">
                                <button type="submit" name="submit"
                                        class="btn btn-primary pulse pulse-white">Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
				
					


		<?php include 'footer.php'?>			
	</body>
	<!--end::Body-->
</html>