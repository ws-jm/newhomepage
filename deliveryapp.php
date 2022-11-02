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
include_once 'db_config.php';?>

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
    <title>Report | Credit Panel | Bulk Whatsapp Broadcast</title>
		<?php include 'libfiles.php'?> 	
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
		<?php include 'sidebar.php'?>
		<?php include 'header.php'?>
		
			<div class="card mb-5 mb-xl-8">
				<!--begin::Header-->
				<div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bolder fs-3 mb-1">Campaign Reports</span>
						<span class="text-muted mt-1 fw-bold fs-7">Real Time Reports</span>
					</h3>
					
				</div>


				<div class="row">
					<div class="col-sm-12">
						<div class="white-box" id="imge-popups" style="padding:3%">
							<div class="card-body table-responsive" style="display: none;">
								<table id="d_table" class="table table-bordered nowrap">
									<thead>
									<tr class="fw-bolder text-muted bg-light">
										<th>Sr. No.</th>
										<th>Unique Id</th>
										<th>Campaign Name</th>
										<th>Message</th>
										<th>Total Mob No.</th>
										<th>Created At</th>
										<th>Created By</th>
										<th>Created User Type</th>
									</tr>
									</thead>
									<tbody>
									<?php include_once 'db_config.php';
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
                                            ORDER BY
                                               send_wp_msgs.id
                                            DESC";
                            $stmt = $conn->prepare($sql);
                            if ($stmt->execute()) {
                                $stmt->bind_result($campaign_id, $campaign_unique_id, $campaign_name, $message, $number_count, $status, $created_at, $login_created_by, $login_user_type);
                                $inc = 1;
                                while ($stmt->fetch()) { ?>
											<tr>
												<td>
													<?php echo $inc; ?></td>
												<td><?php echo $campaign_unique_id; ?></td>
												<td><b><?php echo stripcslashes($campaign_name); ?></b></td>
												<td><?php echo strip_tags($message); ?></td>
												<td><?php echo stripcslashes($number_count); ?></td>
												<td><?php echo date_format(date_create($created_at), "d-m-Y H:i"); ?></td>
												<td><?php echo $login_created_by; ?></td>
												<td><?php echo $login_user_type; ?></td>
											</tr>
											<?php $inc++;
										}
									} else {

									}
									?>
									</tbody>
								</table>
							</div>

							<br/>
							<form action="process-change-status.php" method="post">
								<div class="form-group row">

									<div class="col-lg-4 mb-5">
										<Select data-control="select2" <?php if($campaign_id == ""){ echo "disabled"; }else{ echo ""; } 
										?>  class="form-select form-select-solid fw-semibold" name="change-status" required>
											<option value="" selected disabled>---Change Status----</option>
											<option value="pending">Pending</option>
											<option value="process">Process</option>
											<option value="delivered">Delivered</option>
											<option value="discard">Discard</option>
										</Select>					
									</div>

									<div class="col-lg-4 mb-5">
										<button type="submit" name="submit-status" <?php 
										if($campaign_id == ""){
											echo "disabled";
										}else{
											echo "";
										} ?> class="btn btn-primary" value="">
											Submit
										</button>
									</div>

									<div class="col-lg-4 mb-5" >
										<button style="float:right" type="button" class="btn btn-primary pull-right download-excel" 
										<?php 
											if($campaign_id == ""){
												echo "disabled";
											}else{
												echo "";
											} 
										?> value="Download Excel">
											<i class="fa fa-download"></i> Download
										</button>
									</div>

								</div>
								<div id="loader_div" class="text-center">
									<img id="loader">
								</div>
								<div id="result_div">
								</div>
								<div id="all-empty" class="alert alert-danger" style="display: none;">Please Select Date for filter table
								</div>
								<div class="table-responsive" id="table-hide">
									<table id="d_table-1" class="table table-bordered nowrap">
										<thead>
										<tr class="fw-bolder text-muted bg-light">
											<th class="text-center">Sr. No.</th>
											<th class="text-center">Estimate Time</th>
											<th class="text-center">Unique Id</th>
											<th class="text-center">Message</th>
											<th class="text-center">Total Mob No.</th>
											<th class="text-center">Created At</th>
											<th class="text-center">Created By</th>
											<th class="text-center">Created User Type</th>
											<th class="text-center">Action</th>
										</tr>
										</thead>
										<tbody>
										<?php include_once 'db_config.php';
											$parent_id = $_SESSION['login_id'];
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
														where send_wp_msgs.login_id =  '$parent_id' or logins.parent_id = $parent_id
														ORDER BY
														send_wp_msgs.id
														DESC";
								             $stmt = $conn->prepare($sql);
											 if ($stmt->execute()) {
												 $stmt->bind_result($campaign_id, $campaign_unique_id, $campaign_name, $message, $number_count, $status, $created_at, $login_created_by, $login_user_type);
												 $inc = 1;
												 while ($stmt->fetch()) { ?>
												    <tr>
													<td class="text-center">
														<?php echo $inc; ?></td>
													<td class="text-center"><b><p id="t<?php echo $inc; ?>"> 0h 0m 0s </p></b></td>
	
													<td><?php echo $campaign_unique_id; ?></td>
													<td class="text-center" style="word-wrap: break-word;max-width: 250px;"><?php echo stripcslashes($message); ?></td>
													<td class="text-center"><?php echo stripcslashes($number_count); ?></td>
													<td class="text-center"><?php echo date_format(date_create($created_at), "d-m-Y H:i"); ?></td>
													<td class="text-center"><span class='badge badge-light-primary'><?php echo $login_created_by; ?></span></td>
													<td class="text-center"><span class='badge badge-light-primary'><?php echo $login_user_type; ?></span></td>     
													<td class="text-center">
														<a href='deliveryapp1.php?action=view&unique_id=<?php echo $campaign_unique_id; ?>'
														class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm'
														title='View Details'><i
																	class='fa fa-eye'></i></a>
														<a href='export-report.php?unique_id=<?php echo $campaign_unique_id; ?>&username=<?php echo $login_created_by; ?>'
														class='btn btn-icon btn-bg-light btn-active-color-primary btn-sm'
														title='Download Excel' id="dl" ><i
																	class='fa fa-download'></i></a>
														<a href="../admin/updated/<?= $campaign_unique_id;?>.xlsx" target="_blank" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"><i
																	class='fa fa-file'></i></a>
													</td>
												</tr>
												<?php $inc++;
											}
										} else {

										}
										?>
										</tbody>
									</table>
								</div>

							</form>
						</div>
					</div>
				</div>


			</div>

		<?php include 'footer.php'?>
		

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
		setInterval(function () {

			get_timer();

		}, 1000);

		function get_timer()
		{
			$.getJSON("countdown.php", function(data) {
				$.each(data, function(index) {
					$('#t'+data[index].id).text(data[index].time1);
				});
			});
		}
	</script>

	<script>
		function getResult() {

			$("#loader_div").show();

			var first_date = $("input[name='startdate']").val();
			var second_date = $("input[name='enddate']").val();
			if (first_date == "" && second_date == "") {
				$("#all-empty").show();
			} else {
			/* alert(first_date);*/
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function () {
					if (this.readyState == 4 && this.status == 200) {

						$("#result_div").show();
						$("#loader_div").hide();
						document.getElementById("result_div").innerHTML = xmlhttp.responseText;
						$('#example3').DataTable(
							{   "paging": true,
								"lengthChange": true,
								"searching": true,
								"ordering": true,
								"info": true,
								"autoWidth": false,
								"responsive": true,
								dom: 'Bfrtip',
								buttons: [{
									extend: 'csvHtml5',
									title: 'Campaign-record-excel',
									text: 'Download Excel',
								}
								]
							});
						$("#table-hide").css("display", "none");
					}
				};
				xmlhttp.open("POST", "datewise-sort.php", true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send("&first_date=" + first_date + "&second_date=" + second_date + "&search_result");
			}
		}
	</script>

	<script>

		$(".download-excel").on("click", function () {
			table.button('.buttons-csv').trigger();
		});
		var table = $('#d_table').DataTable();
		var buttons = new $.fn.dataTable.Buttons(table, {
			buttons: [
				{
					extend: 'csvHtml5',
					title: 'Campaign-record-excel',
					text: 'Download Excel',
				}
			]
		});

		$(document).ready(function () {
			$("#d_table-1").DataTable();

		$('.download-excel').on('click',function() {
			$('#myTable1').DataTable(
				{
					dom: 'Bfrtip',
					buttons: [
						{
							extend: 'csvHtml5',
							title: 'Excel'
						}
					]
				}
			);
		});


			$('#select_all').on('click', function () {
				if (this.checked) {
					$('.check').each(function () {
						this.checked = true;
					});
				} else {
					$('.check').each(function () {
						this.checked = false;
					});
				}
			});
			$('.check').on('click', function () {

				if ($('.check:checked').length == $('.check').length) {
					$('#select_all').prop('checked', true);
				} else {
					$('#select_all').prop('checked', false);
				}
			});
			$(".campaign_id").on('change', function () {
				//event.preventDefault();
				var settle = $(this).val();
				$('#camp_id').val(settle);
			});

			var $modal = $('.modal');

			/*GET Cities*/
			$('.select-state').on('change', function () {
				//alert($('#'+$(this).attr('data-iid')).val());
				$('.select-city').html("<option value=''>Loading .....</option>");
				var cn = $(this).val();
				$.ajax({
					type: "POST", url: "api/get-cities.php",
					data: {
						id: cn
					},
					cache: false,
					success: function (response) {
						console.warn(response);
						if (response.success == true) {
							$('.select-city').html(response.data);
							//alertify.success('Unit of ' + vname +' Updated!');
						}
						else {
							//alertify.error('Error updating unit of ' + vname + response);
						}
					}
					/*loading:*/
				});
			});

			$modal.on('show.bs.modal', function (e) {
				var orderid = $(e.relatedTarget).data('orderid');
				var dborder = $(e.relatedTarget).data('dborder');
				//alert(paragraphs);
				$(this)
					.addClass('modal-scrollfix')
					.find('.modal-body')
					.html('loading...')
					.load('api/order-detail.php?id=' + dborder, function () {
						// Use Bootstrap's built-in function to fix scrolling (to no avail)
						$modal
							.removeClass('modal-scrollfix')
							.modal('handleUpdate');
					});

				$(this)
					.find('.modal-title')
					.html("<strong>Order: " + orderid + "</strong>");
			});
			alertify.set('notifier', 'position', 'bottom-left');
			$('.save-price').on('click', function () {
				//alert($('#'+$(this).attr('data-iid')).val());
				var new_price = $('#' + $(this).attr('data-iid')).val();
				var vid = $(this).attr('data-pid');
				var new_unit = $('#punit-' + vid).val();
				//alert(new_unit);
				var vname = $('#' + $(this).parent().parent().attr('id') + " .vname").html();
				//alert(new_price);
				//alert(vname);
				$.ajax({
					type: "POST", url: "api/update-price.php",
					data: {
						id: vid,
						price: new_price,
						unit: new_unit
					},
					cache: false,
					success: function (response) {
						if (response == 'success') {
							alertify.success('Unit of ' + vname + ' Updated!');
						}
						else {
							alertify.error('Error updating unit of ' + vname + response);
						}
					}
				});
			});
			$('.price-input').on('keyup', function () {
				//alert($(this).parent().parent().attr('id'));
				$('#' + $(this).parent().parent().attr('id') + " .save-btn-td .btn").prop('disabled', false).removeClass('disabled');
			});
			$('.update-unit').on('change', function () {
				//alert($(this).parent().parent().attr('id'));
				$('#' + $(this).parent().parent().attr('id') + " .save-btn-td .btn").prop('disabled', false).removeClass('disabled');
			});
			//alertify.success('Success message');
			setTimeout(function () {
				$('.alert').fadeOut(1000)
			}, 5000);
			$('.zoom-mp-img').magnificPopup({
				type: 'image'
				// other options
			});


			$('.summernote').summernote({
				height: 350, // set editor height
				minHeight: null, // set minimum height of editor
				maxHeight: null, // set maximum height of editor
				focus: false // set focus to editable area after initializing summernote
			});
			$('#cat').on('change', function () {
				if ($(this).val() == 1) {
					$('.hide-laminates').hide();
					$('.hide-laminates #sfile').removeAttr('required');
				}
				else if ($(this).val() == 2) {
					$('.hide-laminates #sfile').removeAttr('required');
				}
				else {
					$('.hide-laminates').show();
					$('.hide-laminates #sfile').attr('required', 'required');
				}
			});
		});
		$(document).ready(function () {
			$('.select-multiple').select2();
			$('.select-multiple').select2({
				placeholder: 'Select an options'
			});
		});
		//    CKEDITOR.replace( 'description' );

		function countline() {
			var length = $('#mobileno').val().split("\n").length;
			document.getElementById("numbercount").value = length;
		}
	</script>

</body>
</html>

