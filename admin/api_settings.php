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

	<?php if(isset($_SESSION['success'])) { 
		echo "<script>
				$(document).ready(function(){
					
					toastr.success('".$_SESSION['success']."', 'Success'); 

				});
			</script>"; 
		}
		$_SESSION['success'] = null; 
	?>

	<?php if(isset($_SESSION['error'])) { 
		echo "<script>
				$(document).ready(function(){
					
					toastr.error('".$_SESSION['success']."', 'error'); 

				});
			</script>"; 
		}
		$_SESSION['error'] = null; 
	?>

	<?php

		include_once 'db_config.php';
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$stmt1 = $conn->prepare("SELECT token FROM cp_api_settings WHERE name='".$_SESSION['name']."'");
		$stmt1->execute();
		$stmt1->bind_result($token);
		$stmt1->fetch();
			
	?>


			
			
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
	<?php include 'sidebar.php'?>
    <?php include 'header.php'?>


	
		<form class="form" name="myForm" id="loginform" action="process-api-settings.php" method="post">	
			<div class="card shadow-sm" style="margin:3%">
				<div class="card-header">
					<h3 class="card-title">API Settings</h3>
					<div class="card-toolbar">
					<a href="index.php"><button type="button" class="btn btn-sm btn-primary">
							Back to Dashboard
						</button></a>
					</div>
				</div>
				<div class="card-body" >
					<?php
						if(isset($_SESSION["token"])){
					?>
					<span class="badge badge-info fs-3" style="margin-left:5%;">Access Token : <?php echo $_SESSION["token"];?></span>
					<?php		
						}else if(isset($token)){ 
					?>
					<span class="badge badge-info fs-3" style="margin-left:17%;"><?php echo $token;?></span>
					<?php		
						}else{ 
					?>
					<span class="badge badge-danger" style="margin-left:17%">No Token Available</span>
					<?php		
						}
					?>
					<br><br><hr>
				<div class="form-group row">
					<label for="title" class="col-lg-2 col-form-label text-dark text-hover-primary fs-5 fw-bolder">Wali Token</label>
					<div class="col-lg-8 mb-5">
						<input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Access Token"
												name="token"
												id="token" >
						<input name="name" value=<?php echo $_SESSION['name'];?> type="hidden">
					</div>
					<div class="col-lg-1"></div>
				</div>
				
				<hr>

				<button type="submit" name="submit" style="margin-left:17%" id="kt_docs_sweetalert_basic" class="btn btn-primary">
											<span class="indicator-label">Save API Settings</span>
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