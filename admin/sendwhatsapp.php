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
include_once 'db_config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("select headline from headlines");
$stmt->execute();
$stmt->bind_result($head_line);
$stmt->fetch();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
	<title>Admin | Credit Panel | Bulk Broadcasting Panel</title>
		<?php include 'libfiles.php'?> 
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
    <?php include 'sidebar.php'?>
    
<!--begin::Wrapper-->
<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
						<!--begin::Container-->
						<div class="container-xxl d-flex align-items-center justify-content-between" id="kt_header_container">
							<!--begin::Page title-->
							<div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
								<!--begin::Heading-->
								<h1 class="text-dark fw-bolder my-0 fs-2">New Campaign</h1>
								<!--end::Heading-->
								<!--begin::Breadcrumb-->
								<ul class="breadcrumb fw-bold fs-base my-1">
									<li class="breadcrumb-item text-muted">
										<a href="../../demo7/dist/index.html" class="text-muted">Dashboard</a>
									</li>
									<li class="breadcrumb-item text-dark">New Campaign</li>
								</ul>
								<!--end::Breadcrumb-->
							</div>
							<!--end::Page title=-->
							<!--begin::Wrapper-->
							<div class="d-flex d-lg-none align-items-center ms-n2 me-2">
								<!--begin::Aside mobile toggle-->
								<div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
									<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
									<span class="svg-icon svg-icon-2x">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
									<!--end::Svg Icon-->
								</div>
								<!--end::Aside mobile toggle-->
								<!--begin::Logo-->
								<a href="index.php" class="d-flex align-items-center">
									<img alt="Logo" src="assets/media/logos/logo-demo7.svg" class="h-30px" />
								</a>
								<!--end::Logo-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
		

					<?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) { 

					echo "<script>
					$(document).ready(function(){
						toastr.success('You can See you Campaign in Campaign Report Section!', 'Success'); 
					});</script>";

					$_SESSION['success'] = null;

					}

					if (isset($_SESSION['error']) && !empty($_SESSION['error'])) { 

					echo "<script>
					$(document).ready(function(){
						toastr.success(" . $_SESSION['error'] . ", 'Success'); 
					});</script>";

					$_SESSION['error'] = null;

					} ?>
      
				
				<!--begin::Content-->
                    <div class="row g-5 g-xl-8" style="margin:3%">
								<!--Text Message-->
								<div class="col-xl-4">
									<!--begin::Mixed Widget 2-->
									<div class="card card-xl-stretch mb-xl-8">
										<!--begin::Header-->
										<div class="card-header border-0 bg-primary py-5">
										<h1 class="fw-bolder text-white" style="padding-top:20px;">Send Text Messages</h1>
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body p-0">
											<!--begin::Chart-->
											<div class="card-rounded-bottom bg-primary" data-kt-color="primary" style="height: 200px"></div>
											<!--end::Chart-->
											<!--begin::Stats-->
											<div class="card-p mt-n20 position-relative">
												<!--begin::Row-->
												<div class="row g-0">
													<!--begin::Col-->
													<div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7">
														<!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
														<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="currentColor"/>
																<path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="currentColor"/>
																<path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="currentColor"/>
															</svg>
														</span>
														<!--end::Svg Icon-->
														<a href="z_text_campaign.php" class="text-primary fw-bold fs-6">Text Message</a>
														
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
														<!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
														<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M4.335 8.61499C3.98049 8.61579 3.64078 8.75725 3.39048 9.0083C3.14018 9.25935 2.99973 9.59947 3 9.95398V15.307C3 15.6611 3.14065 16.0006 3.39101 16.251C3.64138 16.5013 3.98094 16.642 4.335 16.642C4.68907 16.642 5.02863 16.5013 5.27899 16.251C5.52935 16.0006 5.67 15.6611 5.67 15.307V9.95398C5.67027 9.59947 5.52983 9.25935 5.27953 9.0083C5.02922 8.75725 4.68952 8.61579 4.335 8.61499ZM20.353 8.61499C19.9986 8.61579 19.659 8.75734 19.4088 9.00842C19.1587 9.25951 19.0185 9.59956 19.019 9.95398V15.307C19.0141 15.4853 19.045 15.6628 19.1099 15.829C19.1748 15.9952 19.2723 16.1467 19.3967 16.2745C19.5211 16.4024 19.6699 16.504 19.8342 16.5734C19.9985 16.6428 20.1751 16.6786 20.3535 16.6786C20.5319 16.6786 20.7085 16.6428 20.8728 16.5734C21.0371 16.504 21.1859 16.4024 21.3103 16.2745C21.4347 16.1467 21.5322 15.9952 21.5971 15.829C21.662 15.6628 21.6929 15.4853 21.688 15.307V9.95398C21.6883 9.59947 21.5478 9.25935 21.2975 9.0083C21.0472 8.75725 20.7075 8.61579 20.353 8.61499Z" fill="currentColor"/>
														<path d="M8.33899 18.062V20.662C8.33899 21.0161 8.47964 21.3556 8.73 21.606C8.98036 21.8563 9.31993 21.9969 9.67399 21.9969C10.0281 21.9969 10.3676 21.8563 10.618 21.606C10.8683 21.3556 11.009 21.0161 11.009 20.662V18.062H8.33899Z" fill="currentColor"/>
														<path opacity="0.3" d="M16.344 18.062C16.6984 18.0615 17.0381 17.9202 17.2885 17.6693C17.5388 17.4184 17.6793 17.0784 17.679 16.724V8.69299H7.004V16.724C7.00373 17.0784 7.1442 17.4184 7.39454 17.6693C7.64487 17.9202 7.98458 18.0615 8.339 18.062H16.344Z" fill="currentColor"/>
														<path d="M13.679 18.062V20.662C13.679 21.0161 13.8196 21.3556 14.07 21.606C14.3204 21.8563 14.6599 21.9969 15.014 21.9969C15.368 21.9969 15.7076 21.8563 15.958 21.606C16.2083 21.3556 16.349 21.0161 16.349 20.662V18.062H13.679Z" fill="currentColor"/>
														<path d="M15.676 4.53889L16.864 3.09492C16.9209 3.02747 16.9639 2.94945 16.9904 2.8653C17.017 2.78115 17.0266 2.69257 17.0187 2.60468C17.0109 2.51679 16.9857 2.43131 16.9446 2.35322C16.9035 2.27512 16.8474 2.206 16.7794 2.14973C16.7115 2.09345 16.633 2.05112 16.5486 2.02534C16.4642 1.99955 16.3756 1.99079 16.2878 1.99946C16.2 2.00813 16.1147 2.03408 16.037 2.07587C15.9593 2.11767 15.8906 2.17451 15.835 2.24299L14.535 3.82099C13.8435 3.50074 13.0902 3.33617 12.3282 3.33893C11.5662 3.3417 10.8141 3.51173 10.125 3.83698L8.85999 2.2519C8.80503 2.18348 8.73714 2.1266 8.66018 2.08442C8.58322 2.04224 8.49871 2.01569 8.41147 2.00617C8.32423 1.99665 8.23597 2.00441 8.15173 2.029C8.06748 2.05359 7.98891 2.09452 7.92049 2.14948C7.85207 2.20444 7.79515 2.27235 7.75297 2.34931C7.71079 2.42627 7.68418 2.51073 7.67466 2.59797C7.66515 2.68521 7.6729 2.77349 7.69749 2.85773C7.72209 2.94198 7.76303 3.02052 7.81799 3.08893L8.98999 4.55793C8.37138 5.05535 7.87187 5.68486 7.52806 6.40034C7.18426 7.11581 7.00485 7.89915 7.00299 8.69294H17.684C17.6821 7.8943 17.5006 7.10632 17.1531 6.38727C16.8055 5.66823 16.3007 5.03648 15.676 4.53889ZM10.676 7.34699C10.4782 7.34699 10.2849 7.28829 10.1204 7.17841C9.95597 7.06853 9.8278 6.91241 9.75211 6.72968C9.67642 6.54696 9.65662 6.34578 9.69521 6.1518C9.73379 5.95782 9.82903 5.77969 9.96888 5.63984C10.1087 5.49998 10.2869 5.40474 10.4809 5.36616C10.6749 5.32757 10.8759 5.34735 11.0587 5.42304C11.2414 5.49873 11.3976 5.62688 11.5075 5.79133C11.6173 5.95578 11.676 6.14921 11.676 6.34699C11.676 6.61221 11.5706 6.86649 11.3831 7.05402C11.1956 7.24156 10.9412 7.34699 10.676 7.34699ZM14.005 7.34699C13.8072 7.34699 13.6139 7.28829 13.4494 7.17841C13.285 7.06853 13.1568 6.91241 13.0811 6.72968C13.0054 6.54696 12.9856 6.34578 13.0242 6.1518C13.0628 5.95782 13.158 5.77969 13.2979 5.63984C13.4377 5.49998 13.6159 5.40474 13.8099 5.36616C14.0039 5.32757 14.2049 5.34735 14.3877 5.42304C14.5704 5.49873 14.7266 5.62688 14.8365 5.79133C14.9463 5.95578 15.005 6.14921 15.005 6.34699C15.005 6.61221 14.8996 6.86649 14.7121 7.05402C14.5246 7.24156 14.2702 7.34699 14.005 7.34699Z" fill="currentColor"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<a href="z_emoji.php" class="text-primary fw-bold fs-6">Emoji Message</a>
													</div>
													<!--end::Col-->
												</div>
												<!--end::Row-->
												
											</div>
											<!--end::Stats-->
										</div>
										<!--end::Body-->
									</div>
									<!--end::Mixed Widget 2-->
								</div>
								<!--end::Col-->
								<!--Multimedia Message-->
								<div class="col-xl-4">
									<!--begin::Mixed Widget 2-->
									<div class="card card-xl-stretch mb-xl-8">
										<!--begin::Header-->
										<div class="card-header border-0 bg-primary py-5">
										<h1 class="fw-bolder text-white" style="padding-top:20px;">Send Multimedia Messages</h1>
											
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body p-0">
											<!--begin::Chart-->
											<div class="card-rounded-bottom bg-primary" data-kt-color="primary" style="height: 200px"></div>
											<!--end::Chart-->
											<!--begin::Stats-->
											<div class="card-p mt-n20 position-relative">
												<!--begin::Row-->
												<div class="row g-0">
													<!--begin::Col-->
													<div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7">
														<!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
														<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.3" d="M22 5V19C22 19.6 21.6 20 21 20H19.5L11.9 12.4C11.5 12 10.9 12 10.5 12.4L3 20C2.5 20 2 19.5 2 19V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5ZM7.5 7C6.7 7 6 7.7 6 8.5C6 9.3 6.7 10 7.5 10C8.3 10 9 9.3 9 8.5C9 7.7 8.3 7 7.5 7Z" fill="currentColor"/>
														<path d="M19.1 10C18.7 9.60001 18.1 9.60001 17.7 10L10.7 17H2V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V12.9L19.1 10Z" fill="currentColor"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<a href="z_image.php" class="text-primary fw-bold fs-6">Image Message</a>
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
														<!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
														<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M21 6.30005C20.5 5.30005 19.9 5.19998 18.7 5.09998C17.5 4.99998 14.5 5 11.9 5C9.29999 5 6.29998 4.99998 5.09998 5.09998C3.89998 5.19998 3.29999 5.30005 2.79999 6.30005C2.19999 7.30005 2 8.90002 2 11.9C2 14.8 2.29999 16.5 2.79999 17.5C3.29999 18.5 3.89998 18.6001 5.09998 18.7001C6.29998 18.8001 9.29999 18.8 11.9 18.8C14.5 18.8 17.5 18.8001 18.7 18.7001C19.9 18.6001 20.5 18.4 21 17.5C21.6 16.5 21.8 14.9 21.8 11.9C21.8 9.00002 21.5 7.30005 21 6.30005ZM9.89999 15.7001V8.20007L14.5 11C15.3 11.5 15.3 12.5 14.5 13L9.89999 15.7001Z" fill="currentColor"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<a href="#" class="text-primary fw-bold fs-6">Video Message</a>
													</div>
													<!--end::Col-->
												</div>
												<!--end::Row-->
												<!--begin::Row-->
												<div class="row g-0">
													<!--begin::Col-->
													<div class="col bg-light-primary px-6 py-8 rounded-2 me-7">
														<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
														<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.3" d="M11.5 22.004C11.4 22.004 11.2 22.004 11.1 21.904C10.7 21.704 10.5 21.404 10.5 21.004V12.404L6.3 8.20393C5.9 7.80393 5.9 7.20403 6.3 6.80403C6.7 6.40403 7.30002 6.40403 7.70002 6.80403L16.7 15.804C17.1 16.204 17.1 16.8039 16.7 17.2039L12.2 21.7039C12 21.9039 11.8 22.004 11.5 22.004ZM12.5 14.404V18.604L14.6 16.504L12.5 14.404Z" fill="currentColor"/>
														<path d="M7.00001 17.5041C6.70001 17.5041 6.5 17.404 6.3 17.204C5.9 16.804 5.9 16.2041 6.3 15.8041L10.5 11.604V3.00406C10.5 2.60406 10.7 2.20403 11.1 2.10403C11.5 1.90403 11.9 2.0041 12.2 2.3041L16.7 6.8041C17.1 7.2041 17.1 7.80401 16.7 8.20401L7.70002 17.204C7.50002 17.404 7.30001 17.5041 7.00001 17.5041ZM12.5 5.40408V9.60403L14.6 7.50406L12.5 5.40408Z" fill="currentColor"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<a href="#" class="text-primary fw-bold fs-6 mt-2">Audio Message</a>
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col bg-light-primary px-6 py-8 rounded-2">
														<!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
														<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="currentColor"/>
														<path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="currentColor"/>
														<path d="M10.3629 14.0084L8.92108 12.6429C8.57518 12.3153 8.03352 12.3153 7.68761 12.6429C7.31405 12.9967 7.31405 13.5915 7.68761 13.9453L10.2254 16.3488C10.6111 16.714 11.215 16.714 11.6007 16.3488L16.3124 11.8865C16.6859 11.5327 16.6859 10.9379 16.3124 10.5841C15.9665 10.2565 15.4248 10.2565 15.0789 10.5841L11.4631 14.0084C11.1546 14.3006 10.6715 14.3006 10.3629 14.0084Z" fill="currentColor"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<a href="#" class="text-primary fw-bold fs-6 mt-2">PDF Message</a>
													</div>
													<!--end::Col-->
												</div>
												<!--end::Row-->
											</div>
											<!--end::Stats-->
										</div>
										<!--end::Body-->
									</div>
									<!--end::Mixed Widget 2-->
								</div>
								<!--end::Col-->
								<!--Interact Button-->
								<div class="col-xl-4">
									<!--begin::Mixed Widget 2-->
									<div class="card card-xl-stretch mb-5 mb-xl-8">
										<!--begin::Header-->
										<div class="card-header border-0 bg-primary py-5">
											<h1 class="fw-bolder text-white" style="padding-top:20px;">Send Interactive Buttons
											<br><span id="kt_typedjs_example_1" class="fw-bolder text-white" style="padding-top:20px;"></span>
										</h1>
											
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body p-0">
											<!--begin::Chart-->
											<div class="card-rounded-bottom bg-primary" data-kt-color="primary" style="height: 200px"></div>
											<!--end::Chart-->
											<!--begin::Stats-->
											<div class="card-p mt-n20 position-relative">
												<!--begin::Row-->
												<div class="row g-0">
													<!--begin::Col-->
													<div class="col bg-light-primary px-6 py-8 rounded-2 me-7 mb-7">
														<!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
														<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.3" d="M2 21V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H3C2.4 22 2 21.6 2 21Z" fill="currentColor"/>
														<path d="M2 10V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H3C2.4 11 2 10.6 2 10Z" fill="currentColor"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<a href="z_button_message.php" class="text-primary fw-bold fs-6">Button Message</a>
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
														<!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
														<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
														<svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect y="6" width="16" height="3" rx="1.5" fill="currentColor"/>
														<rect opacity="0.3" y="12" width="8" height="3" rx="1.5" fill="currentColor"/>
														<rect opacity="0.3" width="12" height="3" rx="1.5" fill="currentColor"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<a href="#" class="text-primary fw-bold fs-6">List Message</a>
													</div>
													<!--end::Col-->
												</div>
												<!--end::Row-->
												<!--begin::Row-->
												<div class="row g-0">
													<!--begin::Col-->
													<div class="col bg-light-primary px-6 py-8 rounded-2 me-7">
														<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
														<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.3" d="M11.425 7.325C12.925 5.825 15.225 5.825 16.725 7.325C18.225 8.825 18.225 11.125 16.725 12.625C15.225 14.125 12.925 14.125 11.425 12.625C9.92501 11.225 9.92501 8.825 11.425 7.325ZM8.42501 4.325C5.32501 7.425 5.32501 12.525 8.42501 15.625C11.525 18.725 16.625 18.725 19.725 15.625C22.825 12.525 22.825 7.425 19.725 4.325C16.525 1.225 11.525 1.225 8.42501 4.325Z" fill="currentColor"/>
														<path d="M11.325 17.525C10.025 18.025 8.425 17.725 7.325 16.725C5.825 15.225 5.825 12.925 7.325 11.425C8.825 9.92498 11.125 9.92498 12.625 11.425C13.225 12.025 13.625 12.925 13.725 13.725C14.825 13.825 15.925 13.525 16.725 12.625C17.125 12.225 17.425 11.825 17.525 11.325C17.125 10.225 16.525 9.22498 15.625 8.42498C12.525 5.32498 7.425 5.32498 4.325 8.42498C1.225 11.525 1.225 16.625 4.325 19.725C7.425 22.825 12.525 22.825 15.625 19.725C16.325 19.025 16.925 18.225 17.225 17.325C15.425 18.125 13.225 18.225 11.325 17.525Z" fill="currentColor"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<a href="#" class="text-primary fw-bold fs-6 mt-2">Link Message</a>
													</div>
													<!--end::Col-->
													<!--begin::Col-->
													<div class="col bg-light-primary px-6 py-8 rounded-2">
														<!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
														<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M8.39961 20.5073C7.29961 20.5073 6.39961 19.6073 6.39961 18.5073C6.39961 17.4073 7.29961 16.5073 8.39961 16.5073H9.89961C11.7996 16.5073 13.3996 14.9073 13.3996 13.0073C13.3996 11.1073 11.7996 9.50732 9.89961 9.50732H8.09961L6.59961 11.2073C6.49961 11.3073 6.29961 11.4073 6.09961 11.5073C6.19961 11.5073 6.19961 11.5073 6.29961 11.5073H9.79961C10.5996 11.5073 11.2996 12.2073 11.2996 13.0073C11.2996 13.8073 10.5996 14.5073 9.79961 14.5073H8.39961C6.19961 14.5073 4.39961 16.3073 4.39961 18.5073C4.39961 20.7073 6.19961 22.5073 8.39961 22.5073H15.3996V20.5073H8.39961Z" fill="currentColor"/>
														<path opacity="0.3" d="M8.89961 8.7073L6.69961 11.2073C6.29961 11.6073 5.59961 11.6073 5.19961 11.2073L2.99961 8.7073C2.19961 7.8073 1.7996 6.50732 2.0996 5.10732C2.3996 3.60732 3.5996 2.40732 5.0996 2.10732C7.6996 1.50732 9.99961 3.50734 9.99961 6.00734C9.89961 7.00734 9.49961 8.0073 8.89961 8.7073Z" fill="currentColor"/>
														<path d="M5.89961 7.50732C6.72804 7.50732 7.39961 6.83575 7.39961 6.00732C7.39961 5.1789 6.72804 4.50732 5.89961 4.50732C5.07119 4.50732 4.39961 5.1789 4.39961 6.00732C4.39961 6.83575 5.07119 7.50732 5.89961 7.50732Z" fill="currentColor"/>
														<path opacity="0.3" d="M17.3996 22.5073H15.3996V13.5073C15.3996 12.9073 15.7996 12.5073 16.3996 12.5073C16.9996 12.5073 17.3996 12.9073 17.3996 13.5073V22.5073Z" fill="currentColor"/>
														<path d="M21.3996 18.5073H15.3996V13.5073H21.3996C22.1996 13.5073 22.5996 14.4073 22.0996 15.0073L21.2996 16.0073L22.0996 17.0073C22.6996 17.6073 22.1996 18.5073 21.3996 18.5073Z" fill="currentColor"/>
														</svg>
														</span>
														<!--end::Svg Icon-->
														<a href="#" class="text-primary fw-bold fs-6 mt-2">Location</a>
													</div>
													<!--end::Col-->
												</div>
												<!--end::Row-->
											</div>
											<!--end::Stats-->
										</div>
										<!--end::Body-->
									</div>
									<!--end::Mixed Widget 2-->
								</div>
								<!--end::Col-->
							</div>
			

                             <?php include 'footer.php'?>  
                                                            
                    
	</body>
	<!--end::Body-->

</html>

<script src="assets/plugins/global/plugins.bundle.js"></script>


<script>
	var typed = new Typed("#kt_typedjs_example_1", {
		strings: ["Send Button Message.", "Send List Message.", "Send Link Message.", "Send Location Message."],
		typeSpeed: 30
	});
</script>


<script>

	function success_message(){
		Swal.fire({
			text: "Here's a basic example of SweetAlert!",
			icon: "success",
			buttonsStyling: false,
			confirmButtonText: "Ok, got it!",
			customClass: {
				confirmButton: "btn btn-primary"
			}
		});
	}

</script>

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




