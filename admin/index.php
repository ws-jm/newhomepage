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
					
					toastr.success('Welcome to our website.', 'Success'); 

				});
			</script>"; 
		}
		$_SESSION['success'] = null; 
	?>
			
			
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
	<?php include 'sidebar.php'?>
    <?php include 'header.php'?>
	
					
		<?php if(isset($_GET['deleted'])){ ?>
			<div class="alert alert-primary d-flex align-items-center p-5">
				<span class="svg-icon svg-icon-2hx svg-icon-primary me-3">...</span>
				<div class="d-flex flex-column">
					<h4 class="mb-1 text-dark">Image deleted Successfully!</h4>
					<span>The alert component can be used to highlight certain parts of your page for higher content visibility.</span>
				</div>
			</div>
		<?php } ?>
		
		<?php if(isset($_GET['error1'])){ ?>
			<div class="alert alert-danger d-flex align-items-center p-5">
				<span class="svg-icon svg-icon-2hx svg-icon-danger me-3">...</span>
				<div class="d-flex flex-column">
					<h4 class="mb-1 text-dark">Error Deleting Please Try Again!</h4>
					<span>The alert component can be used to highlight certain parts of your page for higher content visibility.</span>
				</div>
			</div>
		<?php } ?>
		
        <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-primary d-flex align-items-center p-5">
				<span class="svg-icon svg-icon-2hx svg-icon-primary me-3">...</span>
				<div class="d-flex flex-column">
					<h4 class="mb-1 text-dark">New Image Stored Successfully!</h4>
					<span>The alert component can be used to highlight certain parts of your page for higher content visibility.</span>
				</div>
			</div>
        <?php }

        if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger d-flex align-items-center p-5">
				<span class="svg-icon svg-icon-2hx svg-icon-primary me-3">...</span>
				<div class="d-flex flex-column">
					<h4 class="mb-1 text-dark">Error adding Image Please Try Again!</h4>
					<span>The alert component can be used to highlight certain parts of your page for higher content visibility.</span>
				</div>
			</div>
        <?php } ?>


		<?php
			require_once 'db_config.php';

			$login_id = $_SESSION['login_id'];
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$stmt = $conn->prepare("SELECT count(parent_id) FROM logins where user_type = 'reseller' and parent_id ='$login_id'");
			$stmt->execute();
			$stmt->bind_result($total_reseller_id);
			$stmt->fetch();
			$conn->close();

			$conn1 = new mysqli($servername, $username, $password, $dbname);
			if ($conn1->connect_error) {
				die("Connection failed: " . $conn1->connect_error);
			}
			$stmt1 = $conn1->prepare("SELECT count(parent_id) FROM logins where user_type = 'user' and parent_id ='$login_id'");
			$stmt1->execute();
			$stmt1->bind_result($total_user_id);
			$stmt1->fetch();
			$conn1->close();

			$current_date = date("Y-m-d");

			$conn2 = new mysqli($servername, $username, $password, $dbname);
			if ($conn2->connect_error) {
				die("Connection failed: " . $conn1->connect_error);
			}
			$stmt2 = $conn2->prepare("SELECT count(send_wp_msgs.login_id) FROM `logins` 
										Left Join send_wp_msgs on send_wp_msgs.login_id = logins.id
										WHERE send_wp_msgs.sort_date_wise = '$current_date'");
			$stmt2->execute();
			$stmt2->bind_result($total_campaign);
			$stmt2->fetch();
			$conn2->close();


			$conn3 = new mysqli($servername, $username, $password, $dbname);
			if ($conn3->connect_error) {
				die("Connection failed: " . $conn3->connect_error);
			}
			$stmt3 = $conn3->prepare("SELECT
											COUNT(wp_mobile_listings.mobile_no)
										FROM
											wp_mobile_listings
											Left Join send_wp_msgs on send_wp_msgs.id = wp_mobile_listings.send_wp_msgs_id
											Left join logins on logins.id = send_wp_msgs.login_id
										WHERE
											wp_mobile_listings.sort_date = '$current_date'");
			$stmt3->execute();
			$stmt3->bind_result($today_total_mob_all_cam);
			$stmt3->fetch();
			$conn3->close();

        ?>

		<?php
			include_once 'db_config.php';
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$user_unique_id = $_SESSION['user_unique_id'];
			$user_type = $_SESSION['login_type'];
			$stmt = $conn->prepare("SELECT `username`,  `profilepic`, credit  FROM `logins` WHERE user_unique_id = ?");
			$stmt->bind_param("s", $user_unique_id);
			$stmt->execute();
			$stmt->bind_result($u_username, $profile_pic, $credit);
			$stmt->fetch();
			$conn->close();
		?>
				
					<div class="card shadow-sm" style="margin:3%">
						<div class="card-header">
							<h3 class="card-title">Title</h3>
							<div class="card-toolbar">
								<button type="button" class="btn btn-sm btn-light">
									Action
								</button>
							</div>
						</div>
						<div class="card-body">
							Lorem Ipsum is simply dummy text...
						</div>
						<div class="card-footer">
							Footer
						</div>
					</div>
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