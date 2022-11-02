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
if($_SESSION['login_type'] == 'admin'){
    $_SESSION['login_status']=0;
    header("Location: process_login.php");
    exit();
}
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
    <title>Dashboard | Credit Panel | Bulk Whatsapp Broadcast</title>
		<?php include 'libfiles.php'?> 
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
	<?php include 'sidebar.php'?>
    <?php include 'header.php'?>
	
	<?php if(isset($_SESSION['success'])) { 
		echo "<script>
				$(document).ready(function(){
					
					toastr.success('Welcome to Credit Panel Dashboard.', 'Sucessfully Logged In'); 

				});
			</script>"; 
		}
		$_SESSION['success'] = null; 
	?>
					
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

        $conn2 = new mysqli($servername, $username, $password, $dbname);
        if ($conn2->connect_error) {
            die("Connection failed: " . $conn2->connect_error);
        }
        $stmt2 = $conn2->prepare("SELECT count(send_wp_msgs.login_id) FROM `logins` 
                                    Left Join send_wp_msgs on send_wp_msgs.login_id = logins.id
                                    WHERE login_id = '$login_id'");
        $stmt2->execute();
        $stmt2->bind_result($total_campaign);
        $stmt2->fetch();
        $conn2->close();

        $current_date = date("Y-m-d");
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
                                        wp_mobile_listings.sort_date = '$current_date' AND logins.id = '$login_id'");
        $stmt3->execute();
        $stmt3->bind_result($today_total_mob_all_cam);
        $stmt3->fetch();
        $conn3->close();

        $conn4 = new mysqli($servername, $username, $password, $dbname);
        $sql4= "SELECT logins.rollback FROM logins WHERE logins.id = '$login_id' and status = 'Active'";
        $stmt4 = $conn4->prepare($sql4);
        $stmt4->execute();
        $stmt4->bind_result($rollback);
        $stmt4->fetch();
        $conn4->close();

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
				
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Container-->
						<div class="container-xxl" id="kt_content_container">
							<!--begin::Row-->
							<div class="row gy-5 g-xl-7">
								<!--begin::Col-->
								<div class="col-xxl-17">
									<!--begin::Mixed Widget 12-->
									<img src="assets/media/logos/banner.png" style="width:96% !important;border-radius:10px; margin:2%">
									<!--end::Mixed Widget 12-->
								</div>
								<!--end::Col-->

								<br>
							</div>
							<!--end::Row-->
							
								<!--begin::Col-->
								<div class="col-xxl-12">
									<!--begin::Tables Widget 9-->
									<div class="card card-xxl-stretch mb-5 mb-xl-8">
										<!--begin::Header-->
										<div class="card-header border-0 pt-5">
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bolder fs-3 mb-1">List of All Campaigns</span>
												<span class="text-muted mt-1 fw-bold fs-7">Realtime Update</span>
											</h3>
											
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card">
											<!--begin::Table container-->
											<div class="card-body table-responsive">
												<!--begin::Table-->
												                                    <table id="selection-datatable" class="table table-bordered nowrap">

													<!--begin::Table head-->
													<thead>
														<tr  class="fw-bolder text-muted bg-light">
															<th class="w-25px">
																<div class="form-check form-check-sm form-check-custom form-check-solid">
																	<input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-9-check" />
																</div>
															</th>
															<th class="text-center">Sr. No.</th>
                                                        <th class="text-center">Unique Id</th>
                                                        <!--<th>Campaign Name</th>-->
                                                        <!--<th>Message</th>-->
                                                        <th class="text-center">Total Mob No.</th>
                                                        <th class="text-center">Created At</th>
                                                        <th class="text-center">Created By</th>
                                                        <th class="text-center">Created User Type</th>
														</tr>
													</thead>
													<!--end::Table head-->
													<!--begin::Table body-->
													<tbody>
													<?php include_once 'db_config.php';
															$curr_date = date("Y-m-d");
															$parent_id1 = $_SESSION['login_id'];
															$conn = new mysqli($servername, $username, $password, $dbname);
															if ($conn->connect_error) {
																die("Connection failed: " . $conn->connect_error);
															}
															$sql = "SELECT
																				send_wp_msgs.id,
																				`campaign_unique_id`,
																				`campaign_name`,
																				`message`,
																				`number_count`,
																				send_wp_msgs.status,
																				send_wp_msgs.created_at,
																				logins.username,
																				logins.user_type
																			FROM
																				`send_wp_msgs`
																			LEFT JOIN logins ON logins.id = send_wp_msgs.login_id
																			where send_wp_msgs.login_id =  '$parent_id1' and `sort_date_wise` = '$curr_date'
																			ORDER BY
																			send_wp_msgs.id
																			DESC";
															$stmt = $conn->prepare($sql);
															if ($stmt->execute()) {
																$stmt->bind_result($campaign_id, $campaign_unique_id, $campaign_name, $message, $number_count, $status, $created_at, $login_created_by, $login_user_type);
																$inc = 1;
																while ($stmt->fetch()) { ?>
																						<tr>
												<td class="text-center">	<div class="form-check form-check-sm form-check-custom form-check-solid">
																	<input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-9-check" />
																</div></td>									    
																		<td class="text-center">
																			<?php echo $inc; ?></td>
																		<td class="text-center"><?php echo $campaign_unique_id; ?></td>

																		<td class="text-center"><?php echo stripcslashes($number_count); ?></td>
																		<td class="text-center"><?php echo date_format(date_create($created_at), "d-m-Y H:i"); ?></td>
																		<td class="text-center"><?php echo $login_created_by; ?></td>
																		<td class="text-center"><?php echo $login_user_type; ?></td>
																	</tr>
																						
																						<?php $inc++;
																}
															} else {

															}
															?>
													</tbody>
													<!--end::Table body-->
												</table>
												<!--end::Table-->
											</div>
											<!--end::Table container-->
										</div>
										<!--begin::Body-->
									</div>
									<!--end::Tables Widget 9-->
								</div>
								<!--end::Col-->
							</div>
							<!--end::Row-->
																	</div>
												<!--end::Tap pane-->
											</div>
										</div>
										<!--end::Body-->
									</div>
									<!--end::Tables Widget 5-->
								</div>
								<!--end::Col-->
							</div>
							<!--end::Row-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Content-->
		<?php include 'footer.php'?>			
	</body>
	<!--end::Body-->
</html>

	<!-- third party js -->
	<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <!-- third party js ends -->

    
    <!-- Datatables init -->
    <script src="assets/js/pages/datatables.init.js"></script>


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