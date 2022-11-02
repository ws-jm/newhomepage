<?php
session_start();
if(isset($_SESSION['login_status'])){
    if(($_SESSION['login_status'] == 1)){
        header("Location: index.php");
        exit();
    }
} ?>


<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
	<meta name="description" content="Sign Up to Credit Panel Now and Start Broadcasting Bulk Whatsapp Message with Credit Panel best Features Like Send Text Message, Send Emoji Message, Send Image Message, Send PDF Message, Send Audio Message, Send Video Message, Send Interactive Button Message, Send Interactive List Message, and Much more." />
	<meta name="keywords" content="Credit Panel, Send Text Message, Send Emoji Message, Send Image Message, Send PDF Message, Send Audio Message, Send Video Message, Send Interactive Button Message, Send Interactive List Message, Bulk Whatsapp API, Bulk Whatsapp, Whatsapp Official API, Bulk Broadcast, Whatsapp Credit Panel," />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Credit Panel Sign Up" />
	<meta property="og:url" content="https://creditpanel.in/signup.php" />
	<meta property="og:site_name" content="Credit Panel Bulk Whatsapp Broadcast" />
    <title>Sign Up | Credit Panel | Bulk Whatsapp Broadcast</title>

	<?php include 'libfiles.php' ?>
	</head>

	<?php 
		if (isset($_GET['success'])) {
			echo "<script>
			$(document).ready(function(){
				toastr.success('You will be redirect to Login Page', 'Sign Up Sucessfully'); 
			});
			setTimeout(() => {
				window.location.replace('./login.php');
			}, 5000);
			</script>"; 
		}
		if (isset($_GET['error'])) {
		    echo "<script>
    		    $(document).ready(function(){
    				toastr.error('Error message.', 'Error'); 
    			})
		    </script>"; 
		}	
		if (isset($_GET['emailerror'])) {
		    echo "<script>
    		    $(document).ready(function(){
    				toastr.error('Please Login with your Existing Email', 'Email Already Exist.'); 
    			})
		    </script>"; 
		}
	?>
	
	<!--end::Head-->
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Signup Free Trial-->
			<div class="d-flex flex-column flex-xl-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-lg-row-fluid">
					<!--begin::Wrapper-->
					<div class="d-flex flex-row-fluid flex-center p-10">
						<!--begin::Content-->
						<div class="d-flex flex-column">
							<!--begin::Logo-->
							<a href="index.php" class="mb-15">
								<img alt="Logo" src="assets/media/logos/cpfull.png" style="height:160px"/>
							</a>
							<!--end::Logo-->
							<!--begin::Title-->
							<h1 class="text-dark fs-2x mb-3">Get Started with 20 your Free Credits!</h1>
							
							<!--end::Title-->
							<!--begin::Description-->
							<div class="fw-bold fs-4 text-gray-400 mb-10">If you’d like to get started with Credit Panel <br>& use all of our product features, simply choose one of our plans.</div>
							
							<!--begin::Description-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Illustration-->
					<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-200px min-h-xl-450px mb-xl-10" style="background-image: url(assets/media/illustrations/sigma-1/8.png"></div>
					<!--end::Illustration-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				
				
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

					<div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form class="form w-100" onsubmit="return validateForm()" name="myForm" novalidate="novalidate" method="post" action="process-signup.php" >
							<!--begin::Heading-->
							<div class="mb-10 text-center">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Create an Free Account</h1>
								<!--end::Title-->
								<!--begin::Link-->
								<div class="text-gray-400 fw-bold fs-4">Already have an account?
								<a href="login.php" class="link-primary fw-bolder">Click Here to Login</a></div>
								<!--end::Link-->
							</div>

							<div class="row fv-row mb-7">
								<!--begin::Col-->
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6">Full Name</label>
									<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="usr_fullname" id="usr_fullname" required autocomplete="off" />
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6">Whatsapp Number</label>
									<input class="form-control form-control-lg form-control-solid" type="text" placeholder="Please Add 91 before No." name="usr_mobile" id="usr_mobile" autocomplete="off" />
								</div>
								<!--end::Col-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Email</label>
								<input class="form-control form-control-lg form-control-solid" type="email" placeholder="reseller@gmail.com" name="usr_email" id="usr_email" required autocomplete="off" />
							</div>

                            
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="mb-10 fv-row" data-kt-password-meter="true">
								<!--begin::Wrapper-->
								<div class="mb-1">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6">Password</label>
									<!--end::Label-->
									<!--begin::Input wrapper-->
									<div class="position-relative mb-3">
										<input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="pwd" autocomplete="off" />
										<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
									</div>

									
									<!--end::Label-->
				
									<!--begin::Meter-->
									<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
									</div>
									<!--end::Meter-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Hint-->
								<div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
								<!--end::Hint-->
							</div>
							
							
							<!--begin::Row-->
								<div class="fv-row mb-10">
									<label class="form-check form-check-custom form-check-solid form-check-inline mb-5">
										<input class="form-check-input" id="check-1" type="checkbox" name="toc" value="1" required/>
										<span class="form-check-label fw-bold text-gray-700">I Agree
										<a href="#" class="ms-1 link-primary">Terms and conditions</a> &
										<a href="#" class="ms-1 link-primary">Privacy Policy</a>.</span>
									</label>
								</div>
								<!--end::Row-->

			
							<!--begin::Actions-->
							<div class="text-center">
								<button type="submit" name="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary fw-bolder">
									<span class="indicator-label">Submit</span>
									<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>

				</div>





				<!--end::Right Content-->
			</div>
			<div class="d-flex flex-center flex-column-auto p-10">
				<!--begin::Links-->
				<div class="d-flex align-items-center fw-bold fs-6">
					<a href="#" class="text-muted text-hover-primary px-2">About</a>
					<a href="#" class="text-muted text-hover-primary px-2">Contact</a>
					<a href="#" class="text-muted text-hover-primary px-2">Contact Us</a>
				</div>
				<!--end::Links-->
			</div>
				<!--end::Footer-->
			<!--end::Authentication - Signup Free Trial-->
		</div>
		<!--end::Main-->
		<!--end::Main-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="assets/js/custom/authentication/sign-up/free-trial.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
        <script>
			jQuery('#frmSubmit').on('submit',function(e){
				e.preventDefault();
				jQuery('#msg').html('Please wait...');
				jQuery('#btnSubmit').attr('disabled',true);
				jQuery.ajax({
					url:'https://script.google.com/macros/s/AKfycbycCf5aNSFWNjG5dHFv0-KkXaR1nFgBgv4K_u8nkwGokQ0lfv_PwL0jBm3333C2F7Jxhg/exec',
					type:'post',
					data:jQuery('#frmSubmit').serialize(),
					success:function(result){
						jQuery('#frmSubmit')[0].reset();
						jQuery('#msg').html('Thank You Our Expert Team will Contect you Shortly');
						jQuery('#btnSubmit').attr('disabled',false);
						window.location.href='index.php';
					}
				});
			});
      	</script>
	</body>
	<!--end::Body-->
</html>


<script>
	// Set the options that I want
	toastr.options = {
	"closeButton": true,
	"newestOnTop": false,
	"progressBar": true,
	"positionClass": "toast-top-right",
	"preventDuplicates": false,
	"onclick": null,
	"showDuration": "300",
	"hideDuration": "1000",
	"timeOut": "5000",
	"extendedTimeOut": "1000",
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
	}

	function validateForm() {
		let name = document.forms["myForm"]["usr_fullname"].value;
		let number = document.forms["myForm"]["usr_mobile"].value;
		let email = document.forms["myForm"]["usr_email"].value;
		let password = document.forms["myForm"]["pwd"].value;
        let check = document.forms["myForm"]["toc"].checked;
        
		if(name == "" || number == "" || email == "" || password == "" || check == false) {
            toastr.error("Please fill all the fields", "Please fill all the fields");
            return false;
        }

	}
</script>