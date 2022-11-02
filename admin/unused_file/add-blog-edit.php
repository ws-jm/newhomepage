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
include_once 'header.php';
include_once  'db_config.php';
?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Add Products</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Apprecier</li>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0"> <?php if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) {
                            echo "Edit ";
                            $edit_id = addslashes(trim($_GET['edit_id']));
                            $conn2 = new mysqli($servername, $username, $password, $dbname);
                            if ($conn2->connect_error) {
                                die("Connection failed: " . $conn2->connect_error);
                            }

                            $stmt2 = $conn2->prepare("SELECT `id`, `title`, `description`, `photo` FROM `blog` where id = ?");
                            $stmt2->bind_param("i", $edit_id);
                            $stmt2->execute();
                            $stmt2->bind_result($b_id, $b_title, $b_des, $image);
                            $stmt2->fetch();
                            $conn2->close();
                        } else {
                            $b_id = 0;
                            $b_title = "";
                            $b_des="";
                            $imgage="";
                            echo "Add New";
                        } ?>
                        Blog</h3>
                    <br>
                    <form class="form" method="post" action="process-blog-edit.php" enctype="multipart/form-data">
                        <input type="hidden" id="b_id" name="b_id" value="<?php echo $b_id; ?>">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Product Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Title" name="title"
                                       id="title" value="<?php echo stripslashes($b_title); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <!--                                <textarea name="description" id="" class="form-control" placeholder="Description" cols="10" rows="3" required></textarea>-->
                                <textarea name="description" class="form-control"><?php echo stripslashes($b_des); ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-sm-3 col-form-label">Upload Photo <small>(550 x 450px)</small></label>
                            <div class="col-sm-8">
                                <?php if (!empty($image)) { ?>
                                    <div class="zoo-gallery"><a
                                            href="img/upload/<?php echo $image; ?>"
                                            class="img-thumbnail waves-effect waves-light zoom-mp-img"><img
                                                src="img/upload/<?php echo $image; ?>"
                                                alt="" width="60px;" height="60px;"></a></div>
                                    <input type="file" id="photo" name="photo" class="form-control"  accept="image/png,image/jpeg">
                                    <p class="help-block text-danger"><small>Image should be smaller than 1mb. Only JPG and PNG are allowed.</small></p>
                                    <?php
                                } else { ?>
                                    <input type="file" id="photo" name="photo-1" class="form-control" required="required"
                                           accept="image/png,image/jpeg">
                                    <p class="help-block text-danger">
                                        <small>Image should be smaller than 1 mb. Only JPG and PNG are allowed.</small>
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <button type="submit" name="submit" class="btn btn-success waves-effect waves-light m-r-10 pull-right">Submit</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

    <?php include_once 'footer.php'; ?>
