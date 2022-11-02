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
include_once 'db_config.php';
include_once 'header.php'; ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Contact Us</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Contact Us</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /row -->
        <?php if(isset($_GET['deleted'])){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                         deleted Successfully! </div>
                </div>
            </div>
        <?php } ?>

        <?php if(isset($_GET['error1'])){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error deleting image.Please Try Again!</div>
                </div>
            </div>
        <?php } ?>

        <?php if(isset($_GET['success'])){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                         Stored Successfully! </div>
                </div>
            </div>
        <?php }

        if(isset($_GET['error'])){ ?>
            <div class="row m-b-20">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error Adding  Store. Please Try Again! </div>
                </div>
            </div>
        <?php } ?>
        <?php if(isset($_GET['success2'])){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Edited Successfully! </div>
                </div>
            </div>
        <?php }

        if (isset($_GET['error2'])) { ?>
            <div class="row m-b-20">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Error in Editing. Please Try Again!
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("select mobile, email, description from contactus");
        $stmt->execute();
        $stmt->bind_result($mob_no, $email_id, $desc);
        $stmt->fetch();
        $conn->close();
        ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Contact Us</h3>
                    <br>
                    <form class="form" method="post" action="process-contact-us.php" enctype="multipart/form-data">

                        <div class="form-group row">
                            <label for="mobile" class="col-2 col-form-label">Mobile No</label>
                            <div class="col-6">
                                <input class="form-control" type="text" placeholder="Mobile" name="mobile"
                                       id="mobile" value="<?php echo $mob_no;?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-2 col-form-label">Email Id</label>
                            <div class="col-6">
                                <input class="form-control" type="email" placeholder="Email" name="email"
                                       id="email" value="<?php echo $email_id; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-2 col-form-label">Description</label>
                            <div class="col-6">
                                <textarea name="description" id="" class="form-control" placeholder="Description" cols="10" rows="2"><?php echo $desc;?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-8">
                                <button type="submit" name="submit" class="btn btn-success waves-effect waves-light m-r-10 pull-right">Update</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    <?php include_once 'footer.php'; ?>
