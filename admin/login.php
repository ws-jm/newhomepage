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
	<title>Admin Login | Credit Panel | Bulk Broadcasting Panel</title>
		<?php include 'libfiles.php' ?>
        
	</head>

	<?php if(isset($_SESSION['er'])) { 
		echo "<script>
				$(document).ready(function(){					
					toastr.error('Please check for valid Email and password and try again!.', 'Incorrect Email or Password.'); 
				});
			</script>"; 
		}
		$_SESSION['er'] = null; 
	?>
	
	<!--end::Head-->
	<!--begin::Main-->
    <div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-up -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sigma-1/14.png">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="#" class="mb-12">
						<img alt="Logo" src="assets/media/logos/cpfull.png" style="height:150px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->


					<div class="flex-row-fluid d-flex flex-center justfiy-content-xl-first">
						<!--begin::Wrapper-->
						<div class="d-flex flex-center p-15 shadow bg-body rounded w-100 w-md-550px mx-auto ms-xl-20">
							<!--begin::Form-->
							<form class="form" onsubmit="return validateForm()" name="myForm" id="loginform" action="process_login.php" method="post">
								<!--begin::Heading-->

								<div class="mb-10 text-center">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">Login to Credit Panel Admin</h1>
									<!--end::Title-->
									
									<div class="">
													<?php if(isset($_SESSION['er'])) { ?>
														<div class="alert alert-danger alert-dismissable" id="errorMsg">
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
															<p><?php if (isset($_SESSION['er'])){ ?>
															<ul class="error-ul">
																<?php echo $_SESSION['er']; ?>
															</ul>
															<?php
															unset($_SESSION['er']);
															} ?>
															</p>
														</div>
													<?php } ?>
													</div>
								</div>

								
								<!--begin::Heading-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<label class="form-label fw-bolder text-dark fs-6">Email</label>
									<input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="email" placeholder="" name="email" autocomplete="off" />
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="mb-7 fv-row" data-kt-password-meter="true">
									<!--begin::Wrapper-->
									<div class="mb-1">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6">Password</label>
										<!--end::Label-->
										<!--begin::Input wrapper-->
										<div class="position-relative mb-3">
											<input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="password" placeholder="" name="upass" autocomplete="off" />
											<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
												<i class="bi bi-eye-slash fs-2"></i>
												<i class="bi bi-eye fs-2 d-none"></i>
											</span>
										</div>
										<!--end::Input wrapper-->
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
								<!--end::Input group=-->
								
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
								<!--begin::Row-->
								<div class="text-center pb-lg-0 pb-8">
									<button type="submit" id="kt_free_trial_submit" class="btn btn-lg btn-primary fw-bolder">
										<span class="indicator-label">Log In</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
								<!--end::Row-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>



					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
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
			</div>
			<!--end::Authentication - Sign-up-->
		</div>
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
		let pass = document.forms["myForm"]["upass"].value;
		let email = document.forms["myForm"]["email"].value;
		
		
		if(pass == "" || email == "") {
            toastr.error("Please fill all the fields", "Please fill all the fields");
            return false;
        }
	}

</script>