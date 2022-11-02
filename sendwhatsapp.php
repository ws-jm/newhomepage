<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
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
if($_SESSION['login_type'] == 'admin'){
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
	<meta name="description" content="Start Using Credit Panel Now and Start Broadcasting Bulk Whatsapp Message with Credit Panel best Features Like Send Text Message, Send Emoji Message, Send Image Message, Send PDF Message, Send Audio Message, Send Video Message, Send Interactive Button Message, Send Interactive List Message, and Much more." />
	<meta name="keywords" content="Credit Panel, Send Text Message, Send Emoji Message, Send Image Message, Send PDF Message, Send Audio Message, Send Video Message, Send Interactive Button Message, Send Interactive List Message, Bulk Whatsapp API, Bulk Whatsapp, Whatsapp Official API, Bulk Broadcast, Whatsapp Credit Panel," />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Credit Panel Dashboard" />
	<meta property="og:url" content="https://creditpanel.in/index.php" />
	<meta property="og:site_name" content="Credit Panel Bulk Whatsapp Broadcast" />
    <title>Send New Campaign | Credit Panel | Bulk Whatsapp Broadcast</title>
		<?php include 'libfiles.php'?> 
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
    <?php include 'sidebar.php'?>


	<?php 
		if(isset($_SESSION['error']) && !empty($_SESSION['error'])) { 

            echo "<script>
            $(document).ready(function(){
                toastr.error('".$_SESSION['error']."', 'Error!'); 
            });</script>";

			$_SESSION['error'] = null;
                        
        }

		if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
            
            echo "<script>
			$(document).ready(function(){
				toastr.success('".$_SESSION['success']."', 'Success!'); 
			});</script>";
			$_SESSION['success'] = null;
        }
 	?>
    
<!--begin::Wrapper-->
<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					
	

                    <!--begin::Connected Accounts-->
                    <div class="row g-5 g-xl-8" style="margin:2%">
							<div class="card mb-5 mb-xl-10">
								<!--begin::Card header-->
								<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_connected_accounts" aria-expanded="true" aria-controls="kt_account_connected_accounts">
									<div class="card-title m-0">
										<h3 class="fw-bolder m-0">New Campaign</h3>
									</div>
								</div>
								<!--end::Card header-->
								<!--begin::Content-->
								<div id="kt_account_connected_accounts" class="collapse show">
									<!--begin::Card body-->
									<div class="card-body border-top p-9">
									
										<!--begin::Items-->
										<div class="py-2">
											<!--begin::Item-->
											<div class="d-flex flex-stack">
												<div class="d-flex col-md-6">
													<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAABiklEQVRoge3Yu0oDQRQG4P8kIbK5WBnQ2Ght7wV8Am3Uwka8dELSBi+NilYSsNQHSCEI8Rm0TGeT1g2CKTSCKEtMEI99HN3smtnJkvOVZ2aW/2eHhAQQQoQaqYZTVxxvvjgnzLwOYCzgTJ3qBCpZI8mD6iq1OxdjqhPNhnPM4B392bqSZfBus+EAwF7nYkR1gsEbulN5xeBN1VxZAOavjcqoavhbgdCQAqZJAdOkgGlSwDRfBebGoyivWCgvW5jNqh/Rqz1ufJ0qTMeRSRAySUJhZkjrHjeDeYWKlRaeHcaTwyhWWlr3uFH+oJk8f2dfT9PMzqV/5B3MK9RPpIBpUsA0KWCaFAgKAY+qeWgKfDGVVHPlf6N9pk6gUiKTPFQt+inADN6v5YZP/xmsJ7wWaBPTlp1PX2pJ44OXAq8MLNn51K22ND50W6DOTIu1fOpOaxofXAswUI1EYwv2tvUQRCCv3D5Gb9D6nL/v0/DAH2+AgWtYqbVajj6CDNQTExdvZzji0HzJCSFC7BsiVni1fb8gcgAAAABJRU5ErkJggg==">
													<div class="d-flex flex-column" style="margin-left:25px">
														<a href="z_text_campaign.php" class="fs-5 text-dark text-hover-primary fw-bolder">Send Text Message</a>
														<div class="fs-6 fw-bold text-gray-400">Bulk Whatsapp Category</div>
													</div>
												</div>
											    <div class="d-flex col-md-6">
													<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAAEw0lEQVRoge2ZTWxUZRSGn3NnpnPpD4VaLEWolf44jUBCGacsMMGqC4kxQYkmRIkLYxCJJhLiyqhxqSFAVPxZNtFIFIw7F5aFK0pBk0ZnphDSUgJtKDDQwc4wnXtctGo7c2fuvZ2hkNB3eb5zzve+936/54NFLOL+hpQjiSoG/e1h1OgGwkA7wmqUqplebqFcRIkjnEasXsKD/SJYpfZdkgDt72hEeQu1doGs8Rh+AZEehM8lHL08Xw7zEqC/rV9OMPMh8AZgzrfzGaSArwmYH8jGPxJegz0L0L7QC8AR4EGvsQ4YA/ZIJHbMS5BrAXoUH82hA8DbXpl5gxxiKLpPXiLrytuNk55oNqkyvwW2l8TNPY5zK7VTnhxKOTkaTg56FB+VZg8LRx5gO1Xm93piq9/J0VEAzaEDCDvKQssbnqfq8idOTkWH0MyE/bFslLxDUXlRuqLHCzkUFKD9a2uxKqJA4x2h5h5jpAMd8sTAdbvGwkNIKz7m7pMHaJjZc2xh+we077GVkD0PLLljtLwhhV9bpDN+KbfB/g+ItZd7hzyASdbYY9eQJ0AVA9VX7zwnj7D0FdV8vnlDSE+1R1DjZLFcqnDpfJKRwSQT1zMA1CwPsKa9mlVrq5ECS8N842YleFy64v2zTfkbhRpPFctxO5XlTO8VEuPpOfbElTSJK2lG4kk6u1dQYfrKEjcXRjfgIAA2FRMwMjhBYjyNWeWnbWMt9Y3TU2X80iRnf0+QGE8zMjhBy4ZlZYmby59wril/CPWFBoB1xURcHrpFXYNJcMncr5WezHJtNEXjI1VljZuFAYnENjgJuArUOWW6SxiXSGzFbIPdMlq9QGTmg5pcg/Nh7h6HnYDkgrNwj4lcg52AvO36HkLe5d9uGY3jsAr9i9feW4qlpVVmKpfAlx/dcOcsEss12f2B0247rynDdK+r9VAasuZuYmAnQKxf3eZbWV9yXYr6ZV5yWL25lnwB4cF+4IKbdC1NUx46t8datzmUYSLxM7nm/NOdYCHS4yZnqKV0AR1uc4j02JUi7W/9anwG2XdxuBOsa5uiptpiImkQtJSmdIaH01PUZS2qsxYBSwHIGELSZ3DNbzBcEeCC6SctQl2tRVuzqyGUwm8dsWuwFSCRP0e1L/QNDkUsvw+2rM9w4xeL9ZMZDFVbv6ClBK0sD2SytE1myN4UBiorWLkVDLGPyWH0lXTGbJf3wjuxNfU+NutuLnZ0p+jkdkHydvCpEtY0z21JOzvDGIFgwTtxQQGy+dxNYC9QlFmgFtbMo+TV9DIEljq6KSq7ixV9i56Fpgutctipl8ZnoH6zI5n/sGILNGx14agclK7oT8VcnA9zQ9F9KD8U9TGgdTeserZ4RjFg1TZofR03VdmfGY7td3JyV9w92xrkuv87XNRH/x6B0V64+Rekr07bgvVQ2wENT0PlQ2565BjLp3ZK2znHSeKxvP7opyDveInzCEU5yHBsf1nL63N6ONmxHdEjQINnesUxhsqbxeqgdvB8oZGu6HECZgg4zPTzUKlIgRwiYIa8kodyPPJZ7AHdBTR5C2YYkR4MvljwR748LorBqfZNqK8bNIxBO8pq/r9fJxEuYjEIcgqsXiLxM+V4Zl3EIu53/ANN1q7j+m+91wAAAABJRU5ErkJggg==">
													<div class="d-flex flex-column" style="margin-left:25px">
														<a href="z_emoji.php" class="fs-5 text-dark text-hover-primary fw-bolder">Send Emoji Message</a>
														<div class="fs-6 fw-bold text-gray-400">Bulk Whatsapp Category</div>
													</div>
												</div>
											</div>
											<!--end::Item-->
											<div class="separator separator-dashed my-5"></div>
										
											
											<!--begin::Item-->
											<div class="d-flex flex-stack">
												<div class="d-flex col-md-6">
													<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAACmElEQVRoge2Zv08TYRjHP+9RcJCoA8XFRMSJyEBCHBwM6qIzCTg4mYghxM2hmzG68A+gC4mbiWVjc+FHGDQmRmIguADiRC9NrLRIaO/ucQAjtHel78v1x5v4Gd/r8973k7vn7dNUcUjPVGHAUZIS4TaKizSGbVHMK1GTmxOdX002UAC9rwsPROQN0B5rvNopKtTDjYnOt7qFqmeqMKCUfKJ54f9SBHVd90k4jpIUzQ8P0CFISrfIEbhTjzQmKIMsCSBZvjjal6C/qy2WUFGsZH3Sa175svbhkeCwkY/S39XGrcv1FQBIUyFQkeUknHiiNI9E2OKzpX1YanQUM6x/Av8Fmk1oD7y4eabup9DCln/Qa6ckVKCZJMcW0tFXVUYhc27OnWVm1IcIgZWsX590td1jJLpKEHiSvNC97DxaHM5MD22qK6/yUo+AphS+fK71o+ueKg3a3MRX24P2pzYLIIqR0B641tVG91m9zdxdWG1A7xxFQW+owP2+hPYxenAsNlZAoMPqVwgijtF3ax7zPypG3aq4u6cPI4H+gRgqsJr1Wc2eOo82UtT/Zm6pV8jL/dSuaRmBYH+fUmZbu64lZqFg7zd7G+tIEGjXniSwA7wvX/Tz+Rvie5e071aGlEp4+Tz+r5zxHtUEdoTg7veJ8x/LLxxOjFWGrsYR1QOR4VuNMAFrwkOlgFXh4biAdeHhn4CV4eFAwNrwAInAkXtb49rhW+ZnqLM1fu6Dfply449ihtEspJC5uIOYYiTg5txZYDnmLEaYTaMzo74jahhYjzeOPsbjdGZ6aNNTpUElvAS+KSjGmKtmtP8RaTTJscUUyGTU9ZYXgOoSVghAtIQ1AhAuYZUAVEpYJwDHJawUgJNPJyvofjz//A9Vfe+vPUpyeQAAAABJRU5ErkJggg==">
													<div class="d-flex flex-column" style="margin-left:25px">
														<a href="z_button_message.php" class="fs-5 text-dark text-hover-primary fw-bolder">Send Interactive Button Message</a>
														<div class="fs-6 fw-bold text-gray-400">Bulk Whatsapp Category</div>
													</div>
												</div>
												<div class="d-flex col-md-6">
													<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAAEQklEQVRoge2YS2wbVRSGvztj52k7TYjUpmqLShIhFlCxAolFV9BVsuiGDaxYswAkoKsWVGilSokaFCS2DRWEAKIEWKRIICEEK6SqQaXk4ZrEwXnaseOMPa/LYhIn8YzbsVvngfwtLN9zzp17/jn3zB0batSoUaPGQyC8jGdff/uYIgL9wBkgvLspucgguCml8u5XAxcnip0uARvJ3wLadiU9/6wIVTwz0v9BfLsxUBy1cefbnu5+gld6XqQ1srcFSKYzDI2OMT4RbZOW7ANe3u5XPOacAfZF8gCtkTCv9rzkDIST23a8BIQ3J+4XCrlIWop9XgIOFK4eKMULvzdUMw8Xvz6f8xV34Ctw4AX43kJdIQBB1oKlvMSw3TFBBdrrBc2qRCLQLFgsEQtwunWCC52jSAHnJ3v5JdlVtgDfFVCEQBEQDsCJJsHRRkFXSNDZLDjSKGjasIcDTqwqILRhC3qc93UKvN89yuH6NEfq0lzsHvWMexC+K7CdzeQAEBBRIBLwXl0VcLxJIAQgIWtD2pB0NIgdd08AjzcLJOB8+mNXeiCgOEJUBSIBONboVGhwtpdlI8KS0cLHsz0owolThP9SVFQBaS6hzb0HAho7ziMC7ZVchj8y3bx2562K5m5SvgApyS1cxTZmAFCW+zn15IfotsJczialb5W/QYWjjQrhgLN/MgbENZt8iaauBN8Cnoqo1Ktwb+5r1rTbBXtm7U/iC99w/PBZTjYrrAYloSBIKQpbwkFwqA7CQYW4JmmvE9SrgpwtSWiSVcMR3hKEjgb/O9u3gEYVsto/zCWuu3yx+Ke0hp8l1HSSQ3ViM19PVCE40bTlbFYFnSGBDeQtZ51y8C3Vtg3+mr6CbevevugVLOn26eYy47E3uB17E91cvm8i5Sa/Oc8X0fg1stq9kv51bYbY7NBOo5REE4NoepycPst0YgDJI2wAyhAQX7jxwJjZhRuk0rcK40RqlLQ2XhhntDvMp75zzbOsFAuLl5hfvIxlpfymBJRzDkgfh4uU3I32YZoZNH2G+MqwKyS+NMx6PrZjTjJ1HcOcxzQTJFNDZVXpkR9keWOFu7GPmPp3ANs2XH5bGkwlrmJv9Mva+k/k9a3f6nl9irXsz77Xq8pJvJz8jUx2uqQ/p88SX/4cw5wjnfnB5c942EpR0UnsB0MzUFUFoXg/TxOp75HGBCqmyyel21aK6r0LSYmuuR+r2/1L2UlsP711H6r6MmebNma+9N20pEUqn3yoNar+NmrkDWyr9FMlZ+bQTK3i61f/dVqCoenOlxKs5lNY0qro8r6beKT3s4oWqDYH/ke9l4A0OP9J7hcKuQhWi31uAYIfAYZGx/aFiGQ6w7Vvx5yB5Gax39UDqinPWao4PT4Rfeydvk+qn6F/VoRqnys2uiowPHjpb6GKU8AXbGynPSYNfClU+7mR/suTe51MjRo1avzP+A949qQ11PGB5gAAAABJRU5ErkJggg==">
													<div class="d-flex flex-column" style="margin-left:25px">
														<a href="z-image.php" class="fs-5 text-dark text-hover-primary fw-bolder">Send Image Message with Caption</a>
														<div class="fs-6 fw-bold text-gray-400">Bulk Whatsapp Category</div>
													</div>
												</div>
											</div>
											<!--end::Item-->
												<div class="separator separator-dashed my-5"></div>
											
												<!--begin::Item-->
											<div class="d-flex flex-stack">
												<div class="d-flex col-md-6">
													<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAABWklEQVRoge2YsUrDUBSG/6QptiIWlTo4WKiUiIgi2OCgdi2IQ59AnNxE8H18BSdRxKWDgy4iOKjFBixqQSkoYoTUxEGUau0gnJND8XxbuPDf83FyD5cLKIqiKP8Zo/WjUNoJpQr5C+Xtpa+6TclCKLA6LbRaAu3dkV7/pOs7oALS6BSSRgWkYRGYWplFT3+CI7oNFoGh8WE4GwsYcUZ/jAl62H4hKxmHXZrE9GoeiVSSaxv+MzCYS8PZXESmMAbDoG9HJIc4Fo8hW7QxszaH3nQfaXakUyiVGUB+ff6jGyZNNyIfo6ZlIlu0kVueIMnreJ3m4vXRg7t/ifrJDUleZAK+56NWrqJ26CJoBmS57ALBW4Dbo2u4BxU0PZ88n00gDEPcn9VR3buA13jh2oZHoFF5wNXuOZ7vnjjiv8EicLp1zBH7K3oblabrBfRdSBoVkEbfhRRFURRFkneQnXFwYEqs4gAAAABJRU5ErkJggg==">
													<div class="d-flex flex-column" style="margin-left:25px">
														<a href="z-video.php" class="fs-5 text-dark text-hover-primary fw-bolder">Send Video Message with Caption</a>
														<div class="fs-6 fw-bold text-gray-400">Bulk Whatsapp Category</div>
													</div>
												</div>
												<div class="d-flex col-md-6">
													<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAAC0klEQVRoge2ZTUhUURiGnxnHwsZsNLOckhiVodCgv0WhKynKjRCEoRTRJugH3SRZQasW2kaKijQihAiUCtJ2GSaUYEGCVBKWVvQjESakqc3PbfExDDXk6L3neCeYd3O+Odxz3u+Z7957DudCUklZkiPeBca+fEOLs0Gjo3243uo0ThW5zFdGVi44OGlU5jdYncsWgFDtZYzlXiUQtgCQuZJQzSUlEPYAgDII+wBACYS9AGAZwn4AsASRGABgGiJxAMAURGIBQAxEvMtdC5FTjGlNibK5Eq8C81QSwG7pAdhQCk1dcGMAKg5rsYhID8CRRsj1QZobquoga5UWG9ABkO6JJvyqDxxO8BUpt4lIPcD0JIRDEmdkKZ/+b6kHCAbgw2uJVxdIOzaq3CYiPc9A731pHU4IheDzsBYb0AXQ3Q6BGYnfvYSZKS02oAvgx3d40StxKAiOuIcfpqUHwJkCvmKJ/ZthR5UWG9AFULQdPCvkgQaoroecPC1WegBKK6TtbIFnD2RBO90Ky7KVW6nfTi/NhG3lshY8bIOpCVmV1xRCXTO0NYE3H7w+cC2CcBiGnsOTDnlj2Q6w+yAsXgL93fDtE+T5YbBPAAo3wpnW2DE7q6G4BK6cmLedWoA0N+w6ILHbAxcf/XnvBwPgSo3+/jIifXl+qZqtAK5U2FsreyEA/yZpP76RavR3w1A/lB+CPccENtcXHT/41JSt9dNphxPKKiWpbK/0TU1Cbyd03YKRl7Fj0j2wpQzWrpfn4P0gPO6AmZ+x07cNz5qjtQp4C+Doebm3I3o7AOf2C8S/NDEOPXctWUdkHmDdVqi7Bu6MaF8wAM31syevWObWAWcKHG+S5Me/ghGW/tsXojvRBZK5CrhSZaUF8ORI23MH7l1VlNbcZa4Cv6bh+ln598dG4WYDtJwCQ8/XqNlk3zeyOSreWyh5rGK3kgB2678HSCopi/oNdqPUmdYNR/YAAAAASUVORK5CYII=">
													<div class="d-flex flex-column" style="margin-left:25px">
														<a href="z-pdf.php" class="fs-5 text-dark text-hover-primary fw-bolder">Send PDF Message with Caption</a>
														<div class="fs-6 fw-bold text-gray-400">Bulk Whatsapp Category</div>
													</div>
												</div>
											</div>
											<!--end::Item-->
												<div class="separator separator-dashed my-5"></div>
												<!--begin::Item-->
										
												<!--begin::Item-->
											<div class="d-flex flex-stack">
												<div class="d-flex col-md-6">
													<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAABrUlEQVRoge2XwUoCQRjH/7vrumptZZBFSIkhWBCeFroUdfDUoWeoW7du9Qh18wkCn6AXULoXhBjRITAlCLHLliVqm3ZKMCvT/XZmhfkdl+H/zW/mmxkWEAhsIfUbkLpotB2qfHJgaEd2Y2SKuQxKwCsBbRymLhvHdrO4CGxEFIwRSXAR8KsS1okkuAgAdBLcBAAaCa4CgH0J7gKAPQlXCADDS7hGABhOwlUCQK9Ev/EeFpP6ztnNO1mW63ZgUIQAb4TAf0hnSsgVTDStFnk2k1uobNZRvqrjPP+ElYUJJKKTmJvykWQzbaGm1UKuYCKdKZFlMhWQpb5/sAPD9CHb317C7cMLrovPZJlMBcZ9CoxYEEYsSJY58tco+Q5Uaxay+Qruy28AgMVQgLpEF6QC1ZqF00wR9eZH59vd4ytliR5IWyibr3RNngWkAl9twxJmh1hTFUdySQX+OrDRWWcOM6nA5uoMfD+stN+rYCsRoizVgVRgWvdiLxlBPKxDU2VoqozlsI7dZAS635k3kzxVD3iwszZPHfsrI/8SCwHeCAHeCAHeCAHejLyAQGCTTznGdJ9ppR74AAAAAElFTkSuQmCC">
													<div class="d-flex flex-column" style="margin-left:25px">
														<a href="z-audio.php" class="fs-5 text-dark text-hover-primary fw-bolder">Send Audio Message with Caption</a>
														<div class="fs-6 fw-bold text-gray-400">Bulk Whatsapp Category</div>
													</div>
												</div>
													<div class="d-flex col-md-6">
													<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAADq0lEQVRoge2WXWgUVxiG3zOzk01tEhNIjInGFKNLwARpd91sViql1htvNBL0qhdCsVeJPwh6ZSQqURRRc1EIhQaEQkspWgqKhaISY6i7CaLSGiTU0l2jROJGjbvz9/VCIjPjbHb+khSd5+6cM9857zfnPed8gI+Pj4/P+wwzdiRCococz3czoq0AFgO4w4hOt96//+N8CpOvNW0nsH0gNAPIMMLPvCJ1sS/+eqr9TpdAIhSqFDluEMBqkzl/KhLFryJjY5k51A36LbxYFsRvAbSbDI8GZCmuTYLTjuZ4vhvm4gGgXQwGk0ONjWHv5OoRf28OK4KYhLl4AAgpgnBY26FLgBG1zboCUYMK3EjFoh2ulJqQikU7GIcbBDTMLgHbtO2AYbzawlpBMDqXao1ulPminfUDA5N2xWp52tJSluXVPhDtsBhSo21whsG3DnV+aEtAEUf+Xd8Ssx6jJx0Lf5LlKAmCVfGAQaMxAZtQPaeq11Px6AGylTyQjq/bRYwbBGiVGwVGC9mGAAFEx9Ot0daHFiw1Yxmy99fzotuBZF3stvOpClvKoWV0jEiLEtq2LoGTG4+tPfV5t5wLBHPOps9vKbeWkYllz0wvyXS/qIlo+3WLrDieIgCofPEYe64eUVdN/Gl6RuorSi0syS7KfNHOEklSXt8yhf/6kp6saf8/spDreVkTHFcFAMCvbRfe6DYVOFFSja7NZ7lfmrYTALKg1gTawiu5xCtOHXFjmSu5Mux/XvdGvJG8h1jheHwf+ZqNVjVR5/Wj2SJFLLa7OANW2o2ZQSRO6p2uEgbEklm/K3iNJurXs31t/cVPSmvHnYqxy7gamNw9tbygeMDiOzBRUo29bf1LrzVsGoVjS1njD/HDvzszKyryWcaI5YdM4Xh88+nBUH+s4y4DPK9IGZDpm6q61/Ny6UeSjTfR9kt8uXFrM5i8FoQhu7GzMKxAiVxSytbYDXRUStQOjjx8JKkbQDgBl5YioG+6fDJed3P4gZN4x6VEJJmUABxMxSM3Qew7ABU2p5gCYdfyoVs/ONUAuC7mgGWDiYuMyR/btNSwCiW8zKV4wIMEAHuWcmsZI66r0RksWMoTyxjxZAe05LGUZ5Yx4nkCwGtLTVdMfgZGvWDU66VljHhmISOrLz3IAeicq/lnmJMdmE/8BBaady6B9IKosAOxlLapT4Dh/LyKcQKn6jTqrtHSV88OPf+gHCB8CaB2XoUVJs2InS+WhK6FFuLj4+Pj8//hP6t7cYwGuNS3AAAAAElFTkSuQmCC">
													<div class="d-flex flex-column" style="margin-left:25px">
														<a href="#" class="fs-5 text-dark text-hover-primary fw-bolder">Send Bulk Email</a>
														<div class="fs-6 fw-bold text-gray-400">Coming Soon</div>
													</div>
												</div>
											</div>
											<!--end::Item-->
												<div class="separator separator-dashed my-5"></div>
											
										</div>
										<!--end::Items-->
									</div>
									<!--end::Card body-->
								
								</div>
								<!--end::Content-->
							</div>
							<!--end::Connected Accounts-->
                    </div>
                    
                             <?php include 'footer.php'?> 
                             
                                                            
                    
	</body>
	<!--end::Body-->

</html>

<script src="assets/plugins/global/plugins.bundle.js"></script>


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




