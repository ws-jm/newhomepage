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
    <title>Add Reseller | Credit Panel | Bulk Whatsapp Broadcast</title>
		<?php include 'libfiles.php'?> 	
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" style="background-image: url()" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
		<?php include 'sidebar.php'?>
		<?php include 'header.php'?>
		
<div id="page-wrapper">
    <div class="container-fluid">

        <!-- /row -->

        <?php if (isset($_GET['added'])) { 
            echo "<script>
			$(document).ready(function(){
				toastr.success('Updated Successfully', 'Successfully!'); 
			});</script>";
        } ?>

        <?php if (isset($_GET['error1'])) { 

            echo "<script>
            $(document).ready(function(){
                toastr.error('Error in adding credit.Please Try Again!', 'Error'); 
            });</script>";
                        
        } ?>

        <?php if (isset($_GET['success'])) {
            
            echo "<script>
			$(document).ready(function(){
				toastr.success('Stored Successfully!', 'Successfully!'); 
			});</script>";
        }

        if (isset($_SESSION['error'])) {
            echo "<script>
			$(document).ready(function(){
				toastr.error('Error!', 'Error'); 
			});</script>";

            $_SESSION['error'] = null;
        } ?>


        <?php if (isset($_GET['edited'])) {
            echo "<script>
			$(document).ready(function(){
				toastr.success('Edited Successfully!', 'Successfully!'); 
			});</script>";
                        
        }

        if (isset($_GET['error2'])) {
            echo "<script>
			$(document).ready(function(){
				toastr.error('Error in Editing. Please Try Again!', 'Error'); 
			});</script>";
                        
        } ?>


        
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">

                <?php
                if (isset($_GET['action'])) {
                    // Add
                    if (($_GET['action']) == 'add') { ?>
                        <div class="row">
                            <div class="card card-flush">
                                <div class="white-box" style="padding:3%">
                                    <h3 class="box-title m-b-0" style="margin-bottom:3%" >Add New Reseller</h3>
                                    
                                    
                                    <form class="form" method="post" action="process-add-reseller.php"
                                          enctype="multipart/form-data">

                                        <div class="form-group row">
                                            <label for="title"  class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Fullname</label>
                                            <div class="col-lg-4 mb-5">
                                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Fullname"
                                                       name="rslr_fullname"
                                                       id="rslr_fullname" required>
                                            </div>
                                            <div class="col-lg-1"></div>
                                            <label for="title"  class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Username</label>
                                            <div class="col-lg-4 mb-5">
                                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Username"
                                                       name="rslr_username"
                                                       id="username" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="title"  class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Email Id</label>
                                            <div class="col-lg-4 mb-5">
                                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="email" placeholder="Email"
                                                       name="rslr_email"
                                                       id="rslr_email" required>
                                            </div>
                                            <div class="col-lg-1"></div>
                                            <label for="title"  class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Company </label>
                                            <div class="col-lg-4 mb-5">
                                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Company"
                                                       name="rslr_company"
                                                       id="rslr_company" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="title"  class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Mobile</label>
                                            <div class="col-lg-4 mb-5">
                                                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Mobile"
                                                       name="rslr_mobile"
                                                       id="rslr_mobile" >
                                            </div>
                                            <div class="col-lg-1"></div>
                                            <label for="title"  class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Status </label>
                                            <div class="col-lg-4 mb-5">

                                                <select  name="status" data-control="select2" class="form-select form-select-solid fw-semibold" data-hide-search="true">
                                                    <option value="Active" class="">Active</option>
                                                    <option value="Inactive" class="">Inactive</option>
                                                </select>

                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="photo"  class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Profilepic
                                                
                                            </label>
                                            <div class="col-lg-4 mb-5">
                                                <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo" src="assets/media/avatars/150-26.jpg">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <button type="submit" name="submit"
                                                        class="btn btn-primary pulse pulse-white">                      Submit
                                                </button>
                                                <a href="reseller.php" style="margin-left:1%"
                                                    class="btn btn-primary pulse pulse-white">Back</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- View -->
                        <?php } elseif (($_GET['action']) == 'view' && ($_GET['unique_id'])) {
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $stmt = $conn->prepare("SELECT `id`, `full_name` ,`username`, `email_id`, `pwd`, `company`, profilepic,  `mobile`, `credit`, `status` FROM `logins` WHERE  user_unique_id = ?");
                        $stmt->bind_param("s", $_GET['unique_id']);
                        $stmt->execute();
                        $stmt->bind_result($u_id, $u_fullname, $u_username, $u_email_id, $u_pwd, $u_company, $u_profile, $u_mobile, $credit, $status);
                        $stmt->fetch();
                        $conn->close();
                        ?>
                        <div class="row">
                            <div class="card card-flush">
                                                              
                                <div class="white-box" style="padding:3%">
                                    <div class="col-sm-12">
                                        <a href="reseller.php" style="float:right !important;"
                                                class="btn btn-primary pulse pulse-white">Back</a></div>
                                    
                                    <h3 style="margin-top:3%" class="box-title text-primary pulse pulse-white ">View Reseller Details
                                    </h3>

                                    <hr style="margin-top:2%">
                                    <div class="form-group row">
                                        <label class="col-lg-2 text-dark text-hover-primary fs-4 fw-bolder" for="userName">Fullname<span
                                                    class="mandatory text-danger">*</span></label>
                                        <div class="col-lg-4 mb-5 fs-5"> <?php echo $u_fullname; ?></div>
                                        <label class="col-lg-2 text-dark text-hover-primary fs-4 fw-bolder" for="userName">User Name <span
                                                    class="mandatory text-danger">*</span></label>
                                        <div class="col-lg-4 mb-5 fs-5"> <?php echo $u_username; ?></div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 text-dark text-hover-primary fs-4 fw-bolder" for="userName">Email Id <span
                                                    class="mandatory text-danger">*</span></label>
                                        <div class="col-lg-4 mb-5 fs-5"> <?php echo $u_email_id; ?></div>
                                        <label class="col-lg-2 text-dark text-hover-primary fs-4 fw-bolder" for="userName">Password <span
                                                    class="mandatory text-danger">*</span></label>
                                        <div class="col-lg-4 mb-5 fs-5"> <?php echo $u_pwd; ?></div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 text-dark text-hover-primary fs-4 fw-bolder" for="userName">Mobile Number <span
                                                    class="mandatory text-danger">*</span></label>
                                        <div class="col-lg-4 mb-5 fs-5"> <?php echo $u_mobile; ?></div>
                                        <label class="col-lg-2 text-dark text-hover-primary fs-4 fw-bolder" for="userName">Company Name</label>
                                        <div class="col-lg-4 mb-5 fs-5"> <?php echo $u_company; ?></div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 text-dark text-hover-primary fs-4 fw-bolder" for="userName">Profile Photo </label>
                                        <div class="col-lg-4 mb-5 fs-5">
                                            <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo" src="assets/media/avatars/150-26.jpg">
                                                </div>
                                            </div>
                                        <label class="col-lg-2 text-dark text-hover-primary fs-4 fw-bolder" for="userName">Create By </label>
                                        <div class="col-lg-4 mb-5 fs-5"> <?php echo $_SESSION['login_user']; ?></div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-lg-2 text-dark text-hover-primary fs-4 fw-bolder" for="confirm">Status </label>
                                        <div class="col-lg-4 mb-5 fs-5">
                                            <?php
                                            if ($status == 'Active') {
                                                ?>
                                                <strong class="box-title text-primary pulse pulse-white">Active</strong>
                                            <?php } else { ?>
                                                <strong class="box-title text-primary pulse pulse-white">Inactive</strong>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Edit -->
                        <?php } elseif (($_GET['action']) == 'edit' && ($_GET['unique_id']) && ($_GET['rollback'])) {
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $stmt = $conn->prepare("SELECT `id`, `full_name` ,`username`, `email_id`, `pwd`, `company`, `profilepic`, `mobile`, `credit`,`status`, `rollback`  FROM `logins` WHERE 	user_unique_id = ?");
                        $stmt->bind_param("s", $_GET['unique_id']);
                        $stmt->execute();
                        $stmt->bind_result($u_id, $u_fullname, $u_username, $u_email_id, $u_pwd, $u_company, $u_profile, $u_mobile, $credit, $status, $rollback_status);
                        $stmt->fetch();
                        $conn->close();
                        ?>
                        <div class="card card-flush">
                            <div class="white-box" style="padding:3%">
                                <h3 class="box-title m-b-0" style="margin-bottom:3%">Edit Reseller Details</h3>
                                
                                
                                <form class="form" method="post" action="process-edit-reseller.php"
                                        enctype="multipart/form-data">
                                    <input type="hidden" name="usr_unique_id" id="usr_unique_id"
                                            value="<?php echo $_GET['unique_id']; ?>">
                                    <div class="row">
                                        <label for="title" class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Fullname</label>
                                        <div class="col-lg-4 mb-5">
                                            <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Fullname"
                                                    name="rslr_fullname"
                                                    id="rslr_fullname" value="<?php echo $u_fullname; ?>" required>
                                        </div>
                                        <div class="col-lg-1"></div>
                                        <label for="title" class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Username</label>
                                        <div class="col-lg-4 mb-5">
                                            <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Username"
                                                    name="rslr_username"
                                                    id="username" value="<?php echo $u_username; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="title" class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Email Id</label>
                                        <div class="col-lg-4 mb-5">
                                            <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="email" placeholder="Email"
                                                    name="rslr_email"
                                                    id="rslr_email" value="<?php echo $u_email_id; ?>" required>
                                        </div>
                                        <div class="col-lg-1"></div>
                                        <label for="title" class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Password</label>
                                        <div class="col-lg-4 mb-5">
                                            <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Password"
                                                    name="rslr_pwd"
                                                    id="rslr_pwd" value="<?php echo $u_pwd; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="title" class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Mobile</label>
                                        <div class="col-lg-4 mb-5">
                                            <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Mobile"
                                                    name="rslr_mobile"
                                                    id="rslr_mobile" value="<?php echo $u_mobile; ?>" >
                                        </div>
                                        <div class="col-lg-1"></div>
                                        <label for="title" class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Company </label>
                                        <div class="col-lg-4 mb-5">
                                            <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" type="text" placeholder="Company"
                                                    name="rslr_company"
                                                    id="rslr_company" value="<?php echo $u_company; ?>" >
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="photo" class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Profilepic
                                            
                                        </label>
                                        <div class="col-lg-4 mb-5">
                                            <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo" src="assets/media/avatars/150-26.jpg">
                                            </div>
                                        </div>
                                        <div class="col-lg-1"></div>
                                        <label for="title" class="col-lg-me col-form-label text-dark text-hover-primary fs-5 fw-bolder">Status </label>
                                        <div class="col-lg-4 mb-5">
                                            <select name="status" data-control="select2" class="form-select form-select-solid fw-semibold" data-hide-search="true">
                                                <?php if ($status == 'Active') { ?>
                                                    <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                                    <option value="Inactive">Inactive</option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                                    <option value="Active">Active</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!---- rollback---------->

                                    <?php if($_GET['rollback'] == "Enable"){ ?>

                                        <label for="title" class="col-lg-1 col-form-label">Rollback </label>

                                        <input type="radio" name="rollback" value="enable"
                                                style="width:22px; height:22px;"
                                            <?php if ($rollback_status == "Enable") {
                                                echo "checked";
                                            }?>>&emsp;Enable

                                                        &nbsp; <input type="radio" name="rollback" value="disable"
                                                                    style="width:22px; height:22px;"
                                            <?php if ($rollback_status == "Disable") {
                                                echo "checked";
                                            }?>>&emsp;Disable

                                    <?php } ?>

                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <button type="submit" name="submit"
                                                    class="btn btn-primary pulse pulse-white">
                                                Submit
                                            </button>
                                            <a href="reseller.php" style="margin-left:1%;"
                                                class="btn btn-primary pulse pulse-white">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Credit -->
                    <?php } elseif (($_GET['action']) == 'credit' && ($_GET['unique_id'])) { ?>
                        <div class="row">
                            <div class="card card-flush">
                                <div class="white-box" style="padding:3%">
                                    <h3 class="box-title m-b-0" style="margin-bottom:3%">Add Credit </h3>
                                    
                                    
                                    <form class="form" method="post" action="process-add-credit.php"
                                          enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>">
                                        <input type="hidden" name="unique_id" value="<?php echo $_GET['unique_id']; ?>">
                                        <div class="form-group row">
                                            <label class="col-lg-1 control-label" style="margin-top:1.3%;" for="userName">No of SMS <span
                                                       style="float:right;" class="mandatory">*</span></label>
                                            <div class="col-lg-6 mb-5 ml-2">
                                                <input type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 required" id="no_of_sms"
                                                       name="no_of_sms" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-1 control-label" style="margin-top:.3%;" for="userName">Per SMS price <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-6 mb-5">
                                                <input type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 required" id="per_sms_price"
                                                       name="per_sms_price" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-1 control-label" style="margin-top:.3%;"style="margin-top:.3%;" for="userName">Tax Included </label>
                                            <div class="col-lg-6 mb-5">
                                                
                                            <input type="checkbox" class="form-check-input  h-30px w-30px form-check-custom form-check-solid mb-3 mb-lg-0" id="is_tax"
                                                    name="is_tax" value="1">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-1 control-label" style="margin-top:4%;" for="userName">Description <span
                                                        class="mandatory" style="float:right;">*</span></label>
                                            <div class="col-lg-6 mb-5">
                                                <textarea  class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 required" id="description"
                                                          name="description" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <div class="col-lg-8">
                                                <button type="submit" name="submit" style="margin-left:13%;"
                                                        class="btn btn-primary pulse pulse-white">Submit
                                                </button>
                                                <a href="reseller.php" style="margin-left:1%;"
                                                              class="btn btn-primary pulse pulse-white">Back</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Remove Credit -->
                    <?php } elseif (($_GET['action']) == 'debit' && ($_GET['unique_id'])) { ?>
                        <div class="row">
                            <div class="card">
                                <div class="white-box" style="padding:3%">
                                    <h3 class="box-title m-b-0" style="margin-bottom:3%">Subtract Credit</h3>
                                    
                                    
                                    <form class="form" method="post" action="process-remove-reseller-credit.php"
                                          enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>">
                                        <input type="hidden" name="unique_id" value="<?php echo $_GET['unique_id']; ?>">
                                        <div class="form-group row">
                                            <label class="col-lg-1 control-label " for="userName">No of SMS <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 required" id="no_of_sms"
                                                       name="no_of_sms" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group row" style="margin-top:2%">
                                            <label class="col-lg-1 control-label " for="userName">Description <span
                                                        class="mandatory">*</span></label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 required" id="description"
                                                          name="description" rows="4" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row" style="margin-top:2%">
                                            <div class="col-lg-8">
                                                <button type="submit" name="submit"
                                                        class="btn btn-primary pulse pulse-white">
                                                    Submit
                                                </button>
                                                <a href="reseller.php"
                                                    class="btn btn-primary pulse pulse-white">Back</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="white-box" id="imge-popups">

                                <h3 class="box-title m-b-0" style="margin-bottom:3%" id="fame">List Of All Reseller</h3>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body table-responsive">
                                            <div class="col-md-12"><a href="reseller.php?action=add" style="margin-left:2%; margin-top:1%; float:right"
                                                          class="btn btn-primary pulse pulse-white">Add New Reseller</a></div>
                                                <table id="selection-datatable" class="table table-bordered table-responsive nowrap">
                                                
                                                    <thead>
                                                        <tr class="fw-bolder text-muted bg-light">
                                                            <th class="text-center">Sr. No.</th>
                                                            <th class="text-center">User Type</th>
                                                            <th class="text-center">Fullname</th>
                                                            <th class="text-center">Username</th>
                                                            <th class="text-center">Email Id</th>
                                                            <th class="text-center">Credit</th>
                                                            <th class="text-center">Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php include_once 'db_config.php';
                                                            $parent_id = $_SESSION['login_id'];
                                                            $reseller_rollback = $_SESSION['rollback'];
                                                            $conn = new mysqli($servername, $username, $password, $dbname);
                                                            if ($conn->connect_error) {
                                                                die("Connection failed: " . $conn->connect_error);
                                                            }
                                                            $sql = "SELECT `id`, `user_type` ,`user_unique_id`, `full_name` ,`username`, `email_id`, `mobile`, `credit`,`status` FROM `logins` WHERE `user_type`= 'reseller' and parent_id = '$parent_id' order by id desc";
                                                            $stmt = $conn->prepare($sql);
                                                            if ($stmt->execute()) {
                                                                $stmt->bind_result($id, $user_type, $unique_id, $full_name, $username, $email_id, $mobile, $credit, $status);
                                                                $inc = 1;
                                                                    while ($stmt->fetch()) { ?>
                                                                            <tr>
                                                                                <td class="text-center">
                                                                                    <?php echo $inc; ?></td>
                                                                                <td class="text-dark fw-bolder text-hover-primary fs-6 text-center">
                                                                                    <span class="badge badge-light-primary fs-7 fw-bold"
                                                                                        style='font-size: 12px;text-transform:capitalize;'><?php echo stripcslashes($user_type); ?></span>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <?php echo stripcslashes($full_name); ?></td>
                                                                                <td class="text-center"><?php echo stripcslashes($username); ?></td>
                                                                                <td class="text-center"><?php echo stripcslashes($email_id); ?></td>
                                                                                <td class="text-center"><b><?php echo stripcslashes($credit); ?></b></td>
                                                                                <td class="text-center"><?php echo ($status == "Active") ? "<span class='badge badge-light-primary' >Active</span>" : "<span class='badge badge-light-danger'>Inactive</span>"
                                                                                    ?></td>
                                                                                <td class="text-center">

                                                                                    <a href='reseller.php?action=view&unique_id=<?php echo $unique_id; ?>' title='View Details' class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                                                        <span class="svg-icon svg-icon-3">
                                                                                        <i class='fa fa-eye'></i>
                                                                                        </span>
                                                                                    </a>

                                                                                    <a href='reseller.php?action=edit&unique_id=<?php echo $unique_id; ?>&rollback=<?php echo $reseller_rollback; ?>' title='Edit Details'  class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                                                        <span class="svg-icon svg-icon-3">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                                                        </svg>
                                                                                        </span>
                                                                                    </a>

                                                                                    <a href='reseller.php?action=credit&unique_id=<?php echo $unique_id; ?>' title='Fill Credit'  class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                                                        <span class="svg-icon svg-icon-3">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                                                                                <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
                                                                                            </svg>
                                                                                        </span>
                                                                                    </a>

                                                                                    <a href="reseller.php?action=debit&unique_id=<?php echo $unique_id; ?>" title="Remove Credit"  class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                                                        <span class="svg-icon svg-icon-3">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                                                                        </svg>
                                                                                        </span>
                                                                                    </a>
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
                        </div>
                    </div>
                <?php } ?>
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


	</body>
	<!--end::Body-->
</html>