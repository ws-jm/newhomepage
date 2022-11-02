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
include_once 'db_config.php'; ?>

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
    <title>Reseller Report | Credit Panel | Bulk Whatsapp Broadcast</title>
		<?php include 'libfiles.php'?> 	
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
		<?php include 'sidebar.php'?>
		<?php include 'header.php'?>
		

            <div class="card card-flush">
                <div class="white-box">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-2">Reseller Report</span>
                            <span class="text-dark fw-bold fw-bolder fs-4 mt-1 text-muted bg-light">List Of All Reseller Credit Report</span>

                        </h3>
                        <div class="card-toolbar">
                            
                            <!--begin::Menu-->
                            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                            <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                            <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                            <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                            <!--begin::Menu 2-->
                            
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator mb-3 opacity-75"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">New Ticket</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">New Customer</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                    <!--begin::Menu item-->
                                    <a href="#" class="menu-link px-3">
                                        <span class="menu-title">New Group</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <!--end::Menu item-->
                                    <!--begin::Menu sub-->
                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">Admin Group</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">Staff Group</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">Member Group</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu sub-->
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">New Contact</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator mt-3 opacity-75"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content px-3 py-3">
                                        <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                    </div>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            
                            <!--end::Menu 2-->
                            <!--end::Menu-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body table-responsive">
                                    <table id="selection-datatable" class="table table-bordered nowrap">
                                    
                                        <thead>
                                            <tr class="fw-bolder text-muted bg-light">
                                                <th>Sr. No.</th>
                                                <th>User Unique Id</th>
                                                <th>User Type</th>
                                                <th>Username</th>
                                                <th>No. of SMS</th>
                                                <th>Per SMS Price</th>
                                                <th>Old credit</th>
                                                <th>Total credit</th>
                                                <th>Description</th>
                                                <th>Tax Status</th>
                                                <th>Tax Percentage</th>
                                                <th>Tax Amount</th>
                                                <th>Txn Type</th>
                                                <th>Total Amount</th>
                                                <th>Created By</th>
                                                <th>Created Usertype</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php include_once 'db_config.php';

                                            $user_unique_id = $_SESSION['user_unique_id'];

                                            $conn = new mysqli($servername, $username, $password, $dbname);
                                            if ($conn->connect_error) {
                                                die("Connection failed: " . $conn->connect_error);
                                            }
                                            $sql = "SELECT
                                                            transaction_logs.id,
                                                            lg.username,
                                                            transaction_logs.user_unique_id,
                                                            transaction_logs.credit,
                                                            `per_sms_price`,
                                                            `old_credit`,
                                                            `tax_status`,
                                                            `tax_percentage`,
                                                            `total_amount`,
                                                            `tax_amount`,
                                                            `txn_type`,
                                                            description,
                                                            lg.user_type,
                                                            lgs.username,
                                                            lgs.user_type,
                                                            transaction_logs.created_at
                                                        FROM
                                                            `transaction_logs`
                                                        LEFT JOIN logins as lg ON  lg.user_unique_id = transaction_logs.user_unique_id
                                                        LEFT JOIN logins as lgs ON lgs.user_unique_id = transaction_logs.login_user_unique_id
                                                        WHERE lg.user_type = 'reseller' and transaction_logs.login_user_unique_id = ? or transaction_logs.user_unique_id = ? order by transaction_logs.id desc";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bind_param("ss",$user_unique_id, $user_unique_id);
                                            if ($stmt->execute()) {
                                                $stmt->bind_result($txn_id, $user_name, $reseller_unique_id, $no_of_sms, $per_sms_price,$old_credit, $tax_status, $tax_percentage, $total_amount, $tax_amount, $tax_type, $description, $user_type, $login_username, $login_user_type, $created_at);
                                                $inc = 1;
                                                while ($stmt->fetch()) { ?>
                                                        <tr>
                                                            <td class="text-center">
                                                                <?php echo $inc; ?></td>
                                                            <td class="text-center"><b><?php echo $reseller_unique_id; ?></b></td>
                                                            <td class="text-center"><span class="badge badge-light-primary fs-7 fw-bolder"
                                                                                style='font-size: 12px;text-transform:capitalize;'><?php echo stripcslashes($user_type); ?></span>

                                                            <td class="text-center"><b><?php echo $user_name; ?></b></td>
                                                            <td class="text-center"><b><?php echo stripcslashes($no_of_sms); ?></b></td>
                                                            <td class="text-center"><b><?php echo stripcslashes($per_sms_price); ?></b></td>
                                                            <td class="text-center"><b><?php echo stripcslashes($old_credit); ?></b></td>
                                                            <td class="text-center"><b><?php echo( $no_of_sms + $old_credit);?> </b></td>
                                                            <td class="text-center"><b><?php echo stripcslashes($description); ?></b></td>
                                                            <td class="text-center"><?php echo ($tax_status == "Yes") ? "<span class='badge badge-light-success fs-7 fw-bolder' >Yes</span>" : "<span class='badge badge-light-danger fs-7 fw-bolder'>No</span>" ?></td>
                                                            <td class="text-center"><b><?php echo stripcslashes($tax_percentage). " %"; ?></b></td>
                                                            <td class="text-center"><b><i class="fa fa-inr"></i> <?php echo ($tax_amount)/100; ?>$</b></td>
                                                            <td class="text-center"><?php echo ($tax_type == "credit") ? "<span class='badge badge-light-info fs-7 fw-bolder' >Credit</span>" : "<span class='badge badge-light-warning fs-7 fw-bolder'>Debit</span>"
                                                                ?></td>
                                                            <td class="text-center"><b><i class="fa fa-inr"></i> <?php echo ($total_amount)/100; ?>$</b></td>
                                                            <td class="text-center"><b><?php echo $login_username; ?></b></td>
                                                            <td class="text-center"><b><?php echo $login_user_type; ?></b></td>
                                                            <td class="text-center"><b><?php echo date_format(date_create($created_at), "d-m-Y h:i"); ?></b></td>
                                                        </tr>
                                                    <?php $inc++;
                                                }
                                            } else {

                                            }
                                            ?>
                                        </tbody>
                                
                                    </table>
                                </div>
                            </div>                              
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


	</body>
	<!--end::Body-->
</html>