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
	<!--begin::Projects-->
	<div class="m-0">

		<!--begin::Heading-->
		<h1 class="text-gray-800 fw-bold mb-6 mx-5">Get Started</h1>
		<!--end::Heading-->
		<!--begin::Items-->
		<div class="mb-10">
			<!--begin::Item-->
			<a href="#" class="custom-list d-flex align-items-center px-5 py-4">
				<!--begin::Symbol-->
				<div class="symbol symbol-40px me-5">
				<span class="svg-icon svg-icon-primary svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="currentColor"/>
					<path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="currentColor"/>
					<path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="currentColor"/>
					</svg>
					</span>
				</div>
				<!--end::Symbol-->
				<!--begin::Description-->
				<div class="d-flex flex-column flex-grow-1">
					<!--begin::Title-->
					<h5 class="custom-list-title fw-bold text-gray-800 mb-1"><?php echo (empty($credit)? 0 : $credit); ?></h5>
					<!--end::Title-->
					<!--begin::Link-->
					<span class="text-gray-400 fw-bold">Available Credits</span>
					<!--end::Link-->
				</div>
				<!--begin::Description-->
			</a>
			<!--end::Item-->
			<!--begin::Item-->
			<a href="#" class="custom-list d-flex align-items-center px-5 py-4">
				<!--begin::Symbol-->
				<div class="symbol symbol-40px me-5">
				<span class="svg-icon svg-icon-success svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path opacity="0.3" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="currentColor"/>
				<path d="M19 10.4C19 10.3 19 10.2 19 10C19 8.9 18.1 8 17 8H16.9C15.6 6.2 14.6 4.29995 13.9 2.19995C13.3 2.09995 12.6 2 12 2C11.9 2 11.8 2 11.7 2C12.4 4.6 13.5 7.10005 15.1 9.30005C15 9.50005 15 9.7 15 10C15 11.1 15.9 12 17 12C17.1 12 17.3 12 17.4 11.9C18.6 13 19.9 14 21.4 14.8C21.4 14.8 21.5 14.8 21.5 14.9C21.7 14.2 21.8 13.5 21.9 12.7C20.9 12.1 19.9 11.3 19 10.4Z" fill="currentColor"/>
				<path d="M12 15C11 13.1 10.2 11.2 9.60001 9.19995C9.90001 8.89995 10 8.4 10 8C10 7.1 9.40001 6.39998 8.70001 6.09998C8.40001 4.99998 8.20001 3.90005 8.00001 2.80005C7.30001 3.10005 6.70001 3.40002 6.20001 3.90002C6.40001 4.80002 6.50001 5.6 6.80001 6.5C6.40001 6.9 6.10001 7.4 6.10001 8C6.10001 9 6.80001 9.8 7.80001 10C8.30001 11.6 9.00001 13.2 9.70001 14.7C7.10001 13.2 4.70001 11.5 2.40001 9.5C2.20001 10.3 2.10001 11.1 2.10001 11.9C4.60001 13.9 7.30001 15.7 10.1 17.2C10.2 18.2 11 19 12 19C12.6 20 13.2 20.9 13.9 21.8C14.6 21.7 15.3 21.5 15.9 21.2C15.4 20.5 14.9 19.8 14.4 19.1C15.5 19.5 16.5 19.9 17.6 20.2C18.3 19.8 18.9 19.2 19.4 18.6C17.6 18.1 15.7 17.5 14 16.7C13.9 15.8 13.1 15 12 15Z" fill="currentColor"/>
				</svg>
				</span>
				</div>
				<!--end::Symbol-->
				<!--begin::Description-->
				<div class="d-flex flex-column flex-grow-1">
					<!--begin::Title-->
					<h5 class="custom-list-title fw-bold text-gray-800 mb-1">0</h5>
					<!--end::Title-->
					<!--begin::Link-->
					<span class="text-gray-400 fw-bold">International Credits</span>
					<!--end::Link-->
				</div>
				<!--begin::Description-->
			</a>
			<!--end::Item-->
			<!--begin::Item-->
			<a href="#" class="custom-list d-flex align-items-center px-5 py-4">
				<!--begin::Symbol-->
				<div class="symbol symbol-40px me-5">
				<span class="svg-icon svg-icon-danger svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path opacity="0.3" d="M2.10001 10C3.00001 5.6 6.69998 2.3 11.2 2L8.79999 4.39999L11.1 7C9.60001 7.3 8.30001 8.19999 7.60001 9.59999L4.5 12.4L2.10001 10ZM19.3 11.5L16.4 14C15.7 15.5 14.4 16.6 12.7 16.9L15 19.5L12.6 21.9C17.1 21.6 20.8 18.2 21.7 13.9L19.3 11.5Z" fill="currentColor"/>
					<path d="M13.8 2.09998C18.2 2.99998 21.5 6.69998 21.8 11.2L19.4 8.79997L16.8 11C16.5 9.39998 15.5 8.09998 14 7.39998L11.4 4.39998L13.8 2.09998ZM12.3 19.4L9.69998 16.4C8.29998 15.7 7.3 14.4 7 12.8L4.39999 15.1L2 12.7C2.3 17.2 5.7 20.9 10 21.8L12.3 19.4Z" fill="currentColor"/>
					</svg>
					</span>
				</div>
				<!--end::Symbol-->
				<!--begin::Description-->
				<div class="d-flex flex-column flex-grow-1">
					<!--begin::Title-->
					<h5 class="custom-list-title fw-bold text-gray-800 mb-1"><?php echo (empty($total_campaign)? 0 : $total_campaign); ?></h5>
					<!--end::Title-->
					<!--begin::Link-->
					<span class="text-gray-400 fw-bold">Total Campaigns</span>
					<!--end::Link-->
				</div>
				<!--begin::Description-->
			</a>
			<!--end::Item-->
			<!--begin::Item-->
			<?php if($user_type == 'admin') { ?>
			<a href="#" class="custom-list d-flex align-items-center px-5 py-4">
				<!--begin::Symbol-->
				<div class="symbol symbol-40px me-5">
				<span class="svg-icon svg-icon-primary svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"/>
				<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"/>
				</svg>
				</span>
				</div>
				<!--end::Symbol-->
				<!--begin::Description-->
				
				<div class="d-flex flex-column flex-grow-1">
					<!--begin::Title-->
					<h5 class="custom-list-title fw-bold text-gray-800 mb-1"><?php echo (empty($total_user_id)? 0 : $total_user_id); ?></h5>
					<!--end::Title-->
					<!--begin::Link-->
					<span class="text-gray-400 fw-bold">Total Users</span>
					<!--end::Link-->
				</div>
				<!--begin::Description-->
			</a>
			<!--end::Item-->
			<!--begin::Item-->
			<a href="#" class="custom-list d-flex align-items-center px-5 py-4">
				<!--begin::Symbol-->
				<div class="symbol symbol-40px me-5">
				<span class="svg-icon svg-icon-success svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z" fill="currentColor"/>
					<rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="currentColor"/>
					<path d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z" fill="currentColor"/>
					<rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="currentColor"/>
					</svg>
					</span>
				</div>
				<!--end::Symbol-->
				<!--begin::Description-->
				<div class="d-flex flex-column flex-grow-1">
					<!--begin::Title-->
					<h5 class="custom-list-title fw-bold text-gray-800 mb-1"><?php echo (empty($total_reseller_id)? 0 : $total_reseller_id); ?></h5>
					<!--end::Title-->
					<!--begin::Link-->
					<span class="text-gray-400 fw-bold">My Resellers</span>
					<!--end::Link-->
				</div>
				<!--begin::Description-->
			</a>
			<?php } ?>
			<!--end::Item-->
			
			<!--begin::Item-->
			<a href="#" class="custom-list d-flex align-items-center px-5 py-4">
				<!--begin::Symbol-->
				<div class="symbol symbol-40px me-5">
				<span class="svg-icon svg-icon-success svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path opacity="0.3" d="M21 11H18.9C18.5 7.9 16 5.49998 13 5.09998V3C13 2.4 12.6 2 12 2C11.4 2 11 2.4 11 3V5.09998C7.9 5.49998 5.50001 8 5.10001 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H5.10001C5.50001 16.1 8 18.4999 11 18.8999V21C11 21.6 11.4 22 12 22C12.6 22 13 21.6 13 21V18.8999C16.1 18.4999 18.5 16 18.9 13H21C21.6 13 22 12.6 22 12C22 11.4 21.6 11 21 11ZM12 17C9.2 17 7 14.8 7 12C7 9.2 9.2 7 12 7C14.8 7 17 9.2 17 12C17 14.8 14.8 17 12 17Z" fill="currentColor"/>
				<path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" fill="currentColor"/>
				</svg>
				</span>
				</div>
				<!--end::Symbol-->
				<!--begin::Description-->
				<div class="d-flex flex-column flex-grow-1">
					<!--begin::Title-->
					<h5 class="custom-list-title fw-bold text-gray-800 mb-1" id="gfg"></h5>
					<!--end::Title-->
					<!--begin::Link-->
					<span class="text-gray-400 fw-bold">Login IP</span>
					<!--end::Link-->
				</div>
				<!--begin::Description-->
			</a>
			<!--end::Item-->
			<!--begin::Item-->
			<a href="#" class="custom-list d-flex align-items-center px-5 py-4">
				<!--begin::Symbol-->
				<div class="symbol symbol-40px me-5">
				<span class="svg-icon svg-icon-warning svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor"/>
				<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor"/>
				<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor"/>
				</svg>
				</span>
				</div>
				<!--end::Symbol-->
				<!--begin::Description-->
				<div class="d-flex flex-column flex-grow-1">
					<!--begin::Title-->
					<h5 class="custom-list-title fw-bold text-gray-800 mb-1" id='show_date'></h5>
					<!--end::Title-->
					<!--begin::Link-->
					<span class="text-gray-400 fw-bold">Current Date & Time</span>
					<!--end::Link-->
				</div>
				<!--begin::Description-->
			</a>
			<!--end::Item-->
			<!--begin::Item-->
			<a href="#" class="custom-list d-flex align-items-center px-5 py-4">
				<!--begin::Symbol-->
				<div class="symbol symbol-40px me-5">
				<span class="svg-icon svg-icon-success svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M6 21C6 21.6 6.4 22 7 22H17C17.6 22 18 21.6 18 21V20H6V21Z" fill="currentColor"/>
				<path opacity="0.3" d="M17 2H7C6.4 2 6 2.4 6 3V20H18V3C18 2.4 17.6 2 17 2Z" fill="currentColor"/>
				<path d="M12 4C11.4 4 11 3.6 11 3V2H13V3C13 3.6 12.6 4 12 4Z" fill="currentColor"/>
				</svg>
				</span>
				</div>
				<!--end::Symbol-->
				<!--begin::Description-->
				<div class="d-flex flex-column flex-grow-1">
					<!--begin::Title-->
					<h5 class="custom-list-title fw-bold text-gray-800 mb-1">Virtual Numbers</h5>
					<!--end::Title-->
					<!--begin::Link-->
					<span class="text-gray-400 fw-bold">Coming Soon</span>
					<!--end::Link-->
				</div>
				<!--begin::Description-->
			</a>
			<!--end::Item-->
		</div>
		<!--end::Items-->

		
	</div>
	<!--end::Projects-->

	<script src="assets/plugins/custom/typedjs/typedjs.bundle.js"></script>


	<script>

		timer();
		function timer(){


			var currentTime = new Date()

			var hours = currentTime.getHours()
			var minutes = currentTime.getMinutes()
			var sec = currentTime.getSeconds()

			var year = currentTime.getFullYear();
	
			const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

			var name = month[currentTime.getMonth()];
			var day = currentTime.getDate();

			if (minutes < 10){
				minutes = "0" + minutes
			}
			if (sec < 10){
				sec = "0" + sec
			}

			var d_str = day + "/" + name + "/" + year + " ";
			var t_str = hours + ":" + minutes + ":" + sec + " ";

			if(hours > 11){
				t_str += "PM";
			} else {
			t_str += "AM";
			}
			
			document.getElementById('show_date').innerText = d_str + t_str;

			setTimeout(timer,1000);
		}

		function show(){
			var v = document.getElementById("mytextarea").value;
			
		}

		$(document).ready(function() {

			$('#show_message').show();
			$('#show_header').hide();
			$('#show_image').hide();
			$('#show_button').hide();
			$('#show_pdf').hide();
			$('#show_footer').hide();

			$("#countryOption").change(function() {
				if ($(this).val() == "1") {
					$('#show_message').show();
					$('#show_header').hide();
					$('#show_footer').hide();
					$('#show_image').hide();
					$('#show_button').hide();
					$('#show_pdf').hide();
				} else if ($(this).val() == "2") {
					$('#show_message').show();
					$('#show_header').hide();
					$('#show_footer').hide();
					$('#show_image').show();
					$('#show_button').hide();
					$('#show_pdf').hide(); 
				} else if ($(this).val() == "3") {
					$('#show_message').show();
					$('#show_header').show();
					$('#show_footer').show();
					$('#show_image').hide();
					$('#show_button').show();
					$('#show_pdf').hide(); 
				} else if ($(this).val() == "4") {
					$('#show_message').hide();
					$('#show_header').hide();
					$('#show_footer').hide();
					$('#show_image').hide();
					$('#show_button').hide();
					$('#show_pdf').show();
				}else{
					$('#show_footer').hide();
					$('#show_message').hide();
					$('#show_header').hide();
					$('#show_image').hide();
					$('#show_button').hide();
					$('#show_pdf').hide();
				}
			})
		})  

	</script>

