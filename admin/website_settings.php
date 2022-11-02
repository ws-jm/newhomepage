<?php
session_start();
if(isset($_SESSION['login_status'])){
    if(($_SESSION['login_status'] != 1)){
        header("Location: process_login.php");
        exit();
    }
}
if(!isset($_SESSION['login_status'])){
    $_SESSION['login_status']=0;
    header("Location: process_login.php");
    exit();
}
if($_SESSION['login_type'] != 'admin'){
    $_SESSION['login_status']=0;
    header("Location: process_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<title>Dashboard | Credit Panel | Bulk Broadcast Panel</title>
		<?php include 'libfiles.php'?> 
		
	</head>

	<?php if(isset($_SESSION['alread'])) { 
		echo "<script>
				$(document).ready(function(){
					
					toastr.error('".$_SESSION["alread"]."', 'Error'); 

				});
			</script>"; 
		}
		$_SESSION['alread'] = null; 
	?>

	<?php if(isset($_SESSION['d_success'])) { 
		echo "<script>
				$(document).ready(function(){
					
					toastr.success('".$_SESSION["d_success"]."', 'Success'); 

				});
			</script>"; 
		}
		$_SESSION['d_success'] = null; 
	?>

	<?php if(isset($_SESSION['c_error'])) { 
		echo "<script>
				$(document).ready(function(){
					
					toastr.error('".$_SESSION["c_error"]."', 'Error'); 

				});
			</script>"; 
		}
		$_SESSION['c_error'] = null; 
	?>
			
			
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
	<?php include 'sidebar.php'?>
    <?php include 'header.php'?>
	
				
				<form class="form" method="post" action="website_settings_server.php" enctype="multipart/form-data">
					<div class="card shadow-sm" style="margin:3%">
						<div class="card-header">
							<h3 class="card-title">Website Settings</h3>
							<div class="card-toolbar">
                            <a href="index.php"><button type="button" class="btn btn-sm btn-primary">
									Back to Dashboard
								</button></a>
							</div>
						</div>
						<div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Site Title</label>
                            <div class="col-lg-8 mb-5">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Enter Site Title"
                                                       name="sitetitle"
                                                       id="sitetitle" >
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Site Description</label>
                            <div class="col-lg-8 mb-5">
                            <textarea name="sitedescription"  id="sitedescription" class="form-control form-control-solid" placeholder="Enter your Site Description Here..."
                                                                    cols="10" rows="5"></textarea>
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Site Keywords</label>
                            <div class="col-lg-8 mb-5">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Credit Panel, Bulk Whatsapp, Whatsapp API, etc."
                                                       name="sitekeywors"
                                                       id="sitekeywors" >
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Site Logo</label>
                            <div class="col-lg-8 mb-5">
                            <input type="file" id="sitelogo" name="sitelogo" class="form-control form-control-solid"
                                                                accept="image/png,image/jpeg"><p class="help-block text-danger">
                            <small>Photo should be smaller than 2 MB. Only JPG and PNG are allowed.</small>
                            </p>
                                                       
                            </div>
                            <div class="col-lg-1"></div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Site Favicon</label>
                            <div class="col-lg-8 mb-5">
                            <input type="file" id="sitefavicon" name="sitefavicon" class="form-control form-control-solid" accept="image/png,image/jpeg">
                            <p class="help-block text-danger">
                            <small>Photo should be smaller than 2 MB. Only JPG and PNG are allowed.</small>
                            </p>
                                                       
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Site Colour</label>
                            <div class="col-lg-8 mb-5">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="#CDDC39"
                                                       name="sitecolour"
                                                       id="sitecolour" >
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Terms & Condition</label>
                            <div class="col-lg-8 mb-5">
                            <textarea name="condition"  id="condition" class="form-control form-control-solid" placeholder="Enter your Terms & Condition Page Content Here..."
                                                                    cols="10" rows="5"></textarea>
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Privacy Policy </label>
                            <div class="col-lg-8 mb-5">
                            <textarea name="privacypolicy"  id="privacypolicy" class="form-control form-control-solid" placeholder="Enter your Privacy Policy Page Content Here..."
                                                                    cols="10" rows="5"></textarea>
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Support Email</label>
                            <div class="col-lg-8 mb-5">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="example@gmail.com"
                                                       name="supportemail"
                                                       id="supportemail" >
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Support Phone</label>
                            <div class="col-lg-8 mb-5">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="+91-888-888-8888"
                                                       name="supportphone"
                                                       id="supportphone" >
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Footer Text</label>
                            <div class="col-lg-8 mb-5">
                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Enter Footer Text"
                                                       name="footertext"
                                                       id="footertext" >
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                        
                        <hr>

                        <div class="form-group row">
                            <label for="title" class="col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Tawk.to Code </label>
                            <div class="col-lg-8 mb-5">
                            <textarea name="tawktocode"  id="tawktocode" class="form-control form-control-solid" placeholder="Enter Tawk.to Javascript Embed Code for Live Chat..."
                                                                    cols="10" rows="5"></textarea>
                            </div>
                            <div class="col-lg-1"></div>
                        </div>

                        <button type="submit" name="submit" style="margin-left:17%" id="kt_docs_sweetalert_basic" class="btn btn-primary">
													<span class="indicator-label">Save Site Settings</span>
													<span class="indicator-progress">Please wait...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
												</button>
						</div>
						
					</div>
				</form>
		<?php include 'footer.php'?>			
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

</script>