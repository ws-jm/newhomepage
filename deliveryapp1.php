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
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        
        <?php if (isset($_GET['deleted'])) { 
                echo "<script>
                $(document).ready(function(){					
                    toastr.success('deleted Successfully!', 'Success!'); 
                });
                </script>"; 
        } ?>

        <?php if (isset($_GET['error1'])) { 
                echo "<script>
                $(document).ready(function(){					
                    toastr.error('Error deleting image.Please Try Again!', 'Error!'); 
                });
                </script>"; 
            
             } ?>

        <?php if (isset($_SESSION['success'])) { 
            echo "<script>
            $(document).ready(function(){					
                toastr.success('". $_SESSION['success'] ."', 'Success!'); 
            });
            </script>"; 
            $_SESSION['success'] = null;
        }

        if (isset($_SESSION['error'])) { 
            echo "<script>
            $(document).ready(function(){					
                toastr.error('". $_SESSION['error'] ."', 'Erorr!'); 
            });
            </script>"; 
            $_SESSION['error'] = null;
        } ?>
        <?php if (isset($_GET['edited'])) { 
            echo "<script>
            $(document).ready(function(){					
                toastr.success('Edited Successfully!', 'Success!'); 
            });
            </script>";
        }

        if (isset($_GET['error2'])) {
            echo "<script>
            $(document).ready(function(){					
                toastr.error('Error in Editing. Please Try Again!', 'Error!'); 
            });
            </script>";
            
        } ?>
        <!-- /.row -->

        <?php

        if (isset($_GET['action'])) {
        if (($_GET['action']) == 'view' && ($_GET['unique_id'])) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT
                                                send_wp_msgs.id,
                                                `campaign_unique_id`,
                                                `campaign_name`,
                                                `message`,
                                                `image-1`,
                                                `image-2`,
                                                `image-3`,
                                                `image-4`,
                                                `upload_pdf`,
                                                `send_audio`,
                                                `send_video`,
                                                `dp_image`,
                                                 send_wp_msgs.status,
                                                send_wp_msgs.created_at,
                                                logins.username,
                                                logins.user_type,
                                                `repybtn1`, `repybtn2`, `ctabtn1`, `ctabtn2`
                                            FROM
                                                `send_wp_msgs`
                                            Left Join logins on logins.id = send_wp_msgs.login_id    
                                            WHERE
                                                campaign_unique_id = ?");
        $stmt->bind_param("s", $_GET['unique_id']);
        $stmt->execute();
        $stmt->bind_result($camp_id, $camp_unique_id, $camp_name, $camp_msg, $photo1, $photo2, $photo3, $photo4, $up_pdf, $audio, $video, $dp_image, $camp_status, $camp_created_at, $created_by, $created_user_type,$rplybtn1,$rplybtn2,$cta1,$cta2);
        $stmt->fetch();
        $conn->close();
        ?>

        <div class="row">
            <div class="card card-flush">
            <div class="col-md-12"><a href="reseller.php"  style="float:right;margin-top:2%;margin-right:2%"
                                              class="btn btn-primary pull-right">Back</a></div>
                <div class="white-box" style="padding:3%">
                    <h3 class="col-lg-3 col-form-label text-primary fs-2 fw-bolder">Campaign Wise Details</h3>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-dark text-hover-primary fs-5" for="userName">Caption </label>
                        <div class="col-lg-10"><?php echo stripcslashes($camp_name); ?></div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-dark text-hover-primary fs-5" for="userName">Message </label>
                        <div class="col-lg-10"><?php echo stripcslashes($camp_msg); ?></div>
                    </div>
                    <div class="form-group row">
                        <?php if (!empty($photo1)) { ?>
                            <label class="col-lg-1 control-label text-dark text-hover-primary fs-5" for="userName">Image-1</label>
                            <div class="col-lg-2">
                                <a href="admin/img/upload/<?php echo $photo1; ?>"
                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                    <img src="admin/img/upload/<?php echo $photo1; ?>"
                                         style="width:50px; height:50px;">
                                </a>
                                <br/>
                                <a href="admin/img/upload/<?php echo $photo1; ?>" class="btn btn-outline-primary"
                                   title="Download" download><i class="fa fa-download"></i> Download</a>
                            </div>
                        <?php } ?>
                        <?php if (!empty($photo2)) { ?>
                            <label class="col-lg-1 control-label text-dark text-hover-primary fs-5" for="userName">Image-2</label>
                            <div class="col-lg-2">
                                <a href="admin/img/upload/<?php echo $photo2; ?>"
                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                    <img src="admin/img/upload/<?php echo $photo2; ?>"
                                         style="width:50px; height:50px;">
                                </a>
                                <br/>
                                <a href="admin/img/upload/<?php echo $photo2; ?>" title="Download"
                                   class="btn btn-outline-primary" download><i class="fa fa-download"></i>
                                    Download</a>
                            </div>
                        <?php } ?>
                        <?php if (!empty($photo3)) { ?>
                            <label class="col-lg-1 control-label text-dark text-hover-primary fs-5" for="userName">Image-3</label>
                            <div class="col-lg-2">
                                <a href="admin/img/upload/<?php echo $photo3; ?>"
                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                    <img src="admin/img/upload/<?php echo $photo3; ?>"
                                         style="width:50px; height:50px;">
                                </a>
                                <br/>
                                <a href="admin/img/upload/<?php echo $photo3; ?>" title="Download"
                                   class="btn btn-outline-primary" download><i class="fa fa-download"></i>
                                    Download</a>
                            </div>
                        <?php } ?>
                        <?php if (!empty($photo4)) { ?>
                            <label class="col-lg-1 control-label text-dark text-hover-primary fs-5" for="userName">Image-4</label>
                            <div class="col-lg-2">
                                <a href="admin/img/upload/<?php echo $photo4; ?>"
                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                    <img src="admin/img/upload/<?php echo $photo4; ?>"
                                         style="width:50px; height:50px;">
                                </a>
                                <br/>
                                <a href="admin/img/upload/<?php echo $photo4; ?>" title="Download"
                                   class="btn btn-outline-primary" download><i class="fa fa-download"></i>
                                    Download</a>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group row">
                        <?php if (!empty($up_pdf)) { ?>
                            <label class="col-lg-1 control-label text-dark text-hover-primary fs-5" for="confirm">Pdf </label>
                            <div class="col-lg-2"><a href="admin/img/upload/pdf/<?php echo $up_pdf; ?>"
                                                     target="_blank" title="Download"
                                                     class="btn btn-outline-primary"><i
                                            class="fa fa-download"></i> Download</a>
                            </div>
                        <?php } ?>
                        <?php if (!empty($audio)) { ?>
                            <label class="col-lg-1 control-label text-dark text-hover-primary fs-5" for="confirm">Audio </label>
                            <div class="col-lg-2"><a href="admin/img/upload/audio/<?php echo $audio; ?>"
                                                     title="Download" target="_blank"
                                                     class="btn btn-outline-primary"><i
                                            class="fa fa-download"></i> Download</a></div>
                        <?php } ?>
                        <?php if (!empty($video)) { ?>
                            <label class="col-lg-1 control-label text-dark text-hover-primary fs-5" for="confirm">Video </label>
                            <div class="col-lg-2"><a href="admin/img/upload/video/<?php echo $video; ?>"
                                                     title="Download"
                                                     class="btn btn-outline-primary" download><i
                                            class="fa fa-download"></i> Download</a></div>
                        <?php } ?>
                    </div>
                    <div class="form-group row">

                        <?php if (!empty($dp_image)) { ?>
                            <label class="col-lg-1 control-label text-dark text-hover-primary fs-5" for="Dp Image">Dp Image</label>
                            <div class="col-lg-2">
                                <a href="admin/img/upload/<?php echo $dp_image; ?>"
                                   class="img-thumbnail waves-effect waves-light zoom-mp-img">
                                    <img src="admin/img/upload/<?php echo $dp_image; ?>"
                                         style="width:50px; height:50px;">
                                </a>
                                <br/>
                                <a href="admin/img/upload/<?php echo $dp_image; ?>" title="Download"
                                   class="btn btn-outline-primary" download><i class="fa fa-download"></i>
                                    Download</a>
                            </div>
                        <?php } ?>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <?php if (!empty($rplybtn1)) { ?>
                        <label class="col-lg-2 control-label text-dark text-hover-primary fs-5" for="Created At">Button 1 </label>
                        <div class="col-lg-10"><span class="label label-info"
                         style="font-size:12px;"><?php echo $rplybtn1; ?></span>
                        </div>
                        <?php } ?>
                        <?php if (!empty($rplybtn2)) { ?>
                        <label class="col-lg-2 control-label text-dark text-hover-primary fs-5" for="Created At">Button 2 </label>
                        <div class="col-lg-10"><span class="label label-info"
                         style="font-size:12px;"><?php echo $rplybtn2; ?></span>
                        </div>
                        <?php } ?>
                        <?php if (!empty($cta1)) { ?>
                        <label class="col-lg-2 control-label text-dark text-hover-primary fs-5" for="Created At">Call-to-action button 1 </label>
                        <div class="col-lg-10"><span class="label label-info"
                         style="font-size:12px;"><?php echo urldecode($cta1); ?></span>
                        </div>
                        <?php } ?>
                        <?php if (!empty($cta2)) { ?>
                        <label class="col-lg-2 control-label text-dark text-hover-primary fs-5" for="Created At">Call-to-action button 2 </label>
                        <div class="col-lg-10"><span class="label label-info"
                         style="font-size:12px;"><?php echo urldecode($cta2); ?></span>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-primary text-hover-primary fs-5 badge badge-light-primary" for="Created At">Created At </label>
                        <div class="col-lg-10"><span class="badge badge-light-success"
                                                     style="font-size:12px;"><?php echo date_format(date_create($camp_created_at), "d-m-Y h:i"); ?></span>
                        </div><p></p>
                        <label class="col-lg-2 control-label text-primary text-hover-primary fs-5 badge badge-light-primary" for="Created By">Created By </label>
                        <div class="col-lg-10"> <span class="badge badge-light-success"><?php echo $created_by; ?></span></div><p></p>
                        <label class="col-lg-2 control-label text-primary text-hover-primary fs-5 badge badge-light-primary" for="Created User Type">Created User Type </label>
                        <div class="col-lg-10"><span class="badge badge-light-success"><?php echo $created_user_type; ?></span></div><p></p>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-2 control-label text-dark text-hover-primary fs-5" for="userName">Unique Id</label>
                        <div class="col-lg-4"><span class="badge badge-light-success"><?php echo $camp_unique_id; ?></span></div>
                    </div>
                    <hr>

                    <h4 class="col-lg-12 box-title m-b-0">Change Status</h4>

                    <form action="process-change-status.php" method="post">
                        <div class="form-group row">&emsp;
                            <label class="checkbox-inline text-primary text-hover-primary col-lg-2 fs-4 col-form-label">

                            <input class="form-check-input" name="select_all" type="checkbox" value="" id="select_all">
                            Check All</label>
                            <div class="col-lg-3 mb-5">
                                <select name="chg-status" required id="" data-control="select2" class="form-select form-select-solid fw-semibold" data-hide-search="true">
                                    <option value="" selected disabled>---Change Status----</option>
                                    <option value="pending">Pending</option>
                                    <option value="process">Process</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="discard">Discard</option>
                                </select>
                            </div>
                            <div class="col-lg-1 mb-5" >
                                <button type="submit" name="submit"
                                        class="btn btn-primary waves-effect waves-light" style="margin-left:2%">Submit
                                </button>
                            </div>
                            
                            <div class="col-lg-3 mb-5" >
                                <button type="button" style="float:right" class="btn btn-primary waves-effect waves-light download-excel-mobile" value="Download Excel">
                                    <i class="fa fa-download"></i> Download
                                </button>
                            </div>
                        </div>

                        <div class="card-body" style="display: none;">
                            <table id="selection-datatable" class="table">
                                <thead>
                                <tr class="fw-bolder text-muted bg-light">
                                    <th class="text-center">Sr. No.</th>
                                    <th class="text-center">Unique Id</th>
                                    <th class="text-center">Mobile No.</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php include_once 'db_config.php';
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $sql = "SELECT wp_mobile_listings.id, `mobile_no`, wp_mobile_listings.status, send_wp_msgs_id, wp_mobile_listings.created_at FROM `wp_mobile_listings` 
                                            Left Join  send_wp_msgs on send_wp_msgs.id = wp_mobile_listings.send_wp_msgs_id
                                            where send_wp_msgs.campaign_unique_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $_GET['unique_id']);
                                if ($stmt->execute()) {
                                    $stmt->bind_result($wp_id, $mobile_no, $wp_status, $camp_id , $wp_created_at);
                                    $inc = 1;
                                    while ($stmt->fetch()) { ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $inc; ?>
                                            </td>
                                            <td class="text-center"><?php echo $_GET['unique_id']; ?></td>
                                            <td class="text-center"><?php echo $mobile_no; ?></td>
                                            <td class="text-center"><?php echo $created_by; ?></td>
                                            <td class="text-center"><?php if ($wp_status != 'discard') { ?>
                                                    <span class="label label-success"
                                                          style="text-transform: capitalize; font-size: 12px; background-color:orange;"><?php echo $wp_status; ?></span>
                                                <?php } else { ?>
                                                    <span class="label label-danger"
                                                          style="text-transform: capitalize; font-size: 12px; background-color: skyblue;"><?php echo $wp_status; ?></span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center"><?php echo date_format(date_create($wp_created_at), "d-m-Y h:i"); ?></td>
                                        </tr>
                                        <?php $inc++;
                                    }
                                } else {

                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="card">
                        <div class="card-body table-responsive">
                            <table id="selection-datatable2" class="table table-bordered aside-fixed">
                                <thead>
                                <tr class="fw-bolder text-muted bg-light">
                                    <th class="text-center">Sr. No.</th>
                                    <th class="text-center">Mobile No.</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php include_once 'db_config.php';
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $sql = "SELECT wp_mobile_listings.id, `mobile_no`, wp_mobile_listings.status, send_wp_msgs_id FROM `wp_mobile_listings` 
                                            Left Join  send_wp_msgs on send_wp_msgs.id = wp_mobile_listings.send_wp_msgs_id
                                            where send_wp_msgs.campaign_unique_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $_GET['unique_id']);
                                if ($stmt->execute()) {
                                    $stmt->bind_result($wp_id, $mobile_no, $wp_status, $camp_id);
                                    $inc = 1;
                                    while ($stmt->fetch()) { ?>
                                        <tr>
                                            <td class="text-center fs-6">
                                                <?php echo $inc; ?>
                                                <input type="hidden" name="campaign_id" value="<?php echo $camp_id; ?>">
                                                <input style="margin-left:2%" id="select_one" type="checkbox" name="check[]" class="form-check-input"
                                                       value="<?php echo $wp_id; ?>">
                                            </td>

                                            <td class="text-center"><?php echo $mobile_no; ?></td>
                                            <td class="text-center"><span class='badge badge-light-primary'><?php echo $created_by; ?></span></td>
                                            <td class="text-center"><?php if ($wp_status != 'discard') { ?>
                                                    <span class="badge badge-light-info"
                                                          style="text-transform: capitalize; font-size: 12px;"><?php echo $wp_status; ?></span>
                                                <?php } else { ?>
                                                    <span class="badge badge-light-danger"
                                                          style="text-transform: capitalize; font-size: 12px;"><?php echo $wp_status; ?></span>
                                                <?php } ?>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit -->
    <?php }
    } else {
        if (isset($_GET['username']) && !empty($_GET['username']) && isset($_GET['unique_id']) && !empty($_GET['unique_id'])) { ?>

            <div class="row">
                <div class="col-sm-5">
                    <div class="white-box">
                    <div class="card">
                        <div class="card-body table-responsive">
                        <table id="selection-datatable" class="table table-bordered nowrap">
                                <thead>
                                <tr class="fw-bolder text-muted bg-light">
                                    <th>Sr. No.</th>
                                    <th>Mobile No.</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php include_once 'db_config.php';
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $sql = "SELECT wp_mobile_listings.id, `mobile_no`, wp_mobile_listings.status, send_wp_msgs_id FROM `wp_mobile_listings` 
                                            Left Join  send_wp_msgs on send_wp_msgs.id = wp_mobile_listings.send_wp_msgs_id
                                            where send_wp_msgs.campaign_unique_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $_GET['unique_id']);
                                if ($stmt->execute()) {
                                    $stmt->bind_result($wp_id, $mobile_no, $wp_status, $camp_id);
                                    $inc = 1;
                                    while ($stmt->fetch()) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $inc; ?>
                                                <input type="hidden" name="campaign_id" value="<?php echo $camp_id; ?>">
                                                <input type="checkbox" name="check[]" class="check"
                                                       value="<?php echo $wp_id; ?>"
                                                       style="width:18px;height:18px;">
                                            </td>

                                            <td><?php echo $mobile_no; ?></td>
                                            <td><?php echo $_GET['unique_id']; ?></td>
                                            <td><?php if ($wp_status != 'discard') { ?>
                                                    <span class="label label-success"
                                                          style="text-transform: capitalize; font-size: 12px;"><?php echo $wp_status; ?></span>
                                                <?php } else { ?>
                                                    <span class="label label-danger"
                                                          style="text-transform: capitalize; font-size: 12px;"><?php echo $wp_status; ?></span>
                                                <?php } ?>
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
                    </div>
                            </div>
                </div>
            </div>
        <?php } ?>
    <?php }
    ?>
</div>
<!-- /.container-fluid -->

<!-- /.container-fluid -->

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

    $(".download-excel-mobile").on("click", function () {
        table.button('.buttons-csv').trigger();
    });
    var table = $('#selection-datatable2').DataTable();
    var buttons = new $.fn.dataTable.Buttons(table, {
        buttons: [
            {
                extend: 'csvHtml5',
                title: 'mobile_no_excel',
                text: 'Download',

            }
        ]
    });

    $(document).ready(function () {
        $("#selection-datatable2").DataTable();


        $('#select_all').on('click', function () {
            if (this.checked) {
                $('.form-check-input').each(function () {
                    this.checked = true;
                });
            } else {
                $('.form-check-input').each(function () {
                    this.checked = false;
                });
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

    // Show loader & then get content when modal is shown
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
