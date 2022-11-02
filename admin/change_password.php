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
if($_SESSION['login_type'] != 'admin'){
    $_SESSION['login_status']=0;
    header("Location: process_login.php");
    exit();
}
include_once 'db_config.php';?>
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<title>Admin | Credit Panel | Bulk Broadcasting Panel</title>
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
           
                            <label for="email" class="col-form-label text-dark text-hover-primary fs-5">Old Password <span
                                            class="mandatory text-danger">*</span></label>
                            <div class="position-relative mb-3 col-md-6">                           
                                <input class="form-control form-control-lg form-control-solid" type="password" placeholder="Old Password" name="old_password"
                                        id="current_pwd" value="" required>
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                    <i id="eye-0" class="fa fa-eye fs-3"></i>
                                </span>
                            </div>

                            <label for="email" class="col-form-label text-dark text-hover-primary fs-5 fw-bolder">New Password <span
                                            class="mandatory text-danger">*</span></label>
                            <div class="position-relative mb-3 col-md-6">
                                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="New Password" name="new_password"
                                        id="new_pwd" value="" required>
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i id="eye-1" class="fa fa-eye fs-3"></i>
                                    </span>
                            </div>
                            
                            <label for="mobile" class=" col-lg-4 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Confirm Password  <span
                                            class="mandatory text-danger">*</span></label>
                            <div class="position-relative mb-3 col-md-6">
                                    <input class="form-control form-control-solid" type="password" placeholder="Confirm Password" name="confirm_new_password"
                                        id="conf_pwd" value="" required>
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i id="eye-2" class="fa fa-eye fs-3"></i>
                                    </span>
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
        <script>
        $(document).ready(function(){
            const  password = $('#current_pwd');
            const  newpassword = $('#new_pwd');
            const  confpassword = $('#conf_pwd');

            $('#eye-0').click(function(){
                if(password.prop('type') == 'password'){
                    $(this).addClass('fa-eye-slash');
                    password.attr('type','text');

                }else{
                    $(this).removeClass('fa-eye-slash');
                    password.attr('type','password');
                }
            });
            $('#eye-1').click(function(){
                if(newpassword.prop('type') == 'password'){
                    $(this).addClass('fa-eye-slash');
                    newpassword.attr('type','text');

                }else{
                    $(this).removeClass('fa-eye-slash');
                    newpassword.attr('type','password');
                }
            });
            $('#eye-2').click(function(){
                if(confpassword.prop('type') == 'password'){
                    $(this).addClass('fa-eye-slash');
                    confpassword.attr('type','text');

                }else{
                    $(this).removeClass('fa-eye-slash');
                    confpassword.attr('type','password');
                }
            });
        });
    </script>		
	</body>
	<!--end::Body-->
</html>