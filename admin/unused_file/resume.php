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

include_once 'header.php'; ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">View CV</h4>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box" id="imge-popups">
                    <h3 class="box-title m-b-0">LIST OF all CV</h3>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Date</th>
                                <th>CV</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php include_once 'db_config.php';
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $sql="SELECT `id`,`resume_pdf`,`created_at` FROM `resume` ";
                            $stmt = $conn->prepare($sql);
                            if($stmt->execute()){
                                $stmt->bind_result($id, $cv, $created_at);
                                $inc=1;
                                while ($stmt->fetch()){ ?>
                                    <tr>
                                        <td><?php echo $inc; ?></td>
                                        <td><?php echo date_format(date_create($created_at),'d-m-Y h:i') ?></td>
                                        <td><?php if(!empty($cv)){ ?>

                                                <a href="img/upload/pdf/<?php echo $cv; ?>" target="_blank" title="<?php echo $cv; ?>" class="btn btn-outline btn-default">
                                                    <i class="fa fa-file-pdf-o m-r-5"></i> <span>Download</span>
                                                </a>

                                            <?php } else{ echo "&nbsp;"; } ?>
                                        </td>

                                    </tr>

                                    <?php $inc++; }
                            }
                            else{

                            }
                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
<!--        <div class="row">-->
<!--            <div class="col-sm-12">-->
<!--                <div class="white-box" id="imge-popups">-->
<!--                    <h3 class="box-title m-b-0" id="fame">LIST OF all CV</h3>-->
<!--                    <div class="table-responsive">-->
<!--                        <table id="myTable" class="table table-striped">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>Sr. No.</th>-->
<!--                                <th>Title</th>-->
<!--                                <th>Description</th>-->
<!--                                <th>Photo</th>-->
<!--                                <th>Date</th>-->
<!--                                <th>Action</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            --><?php //include_once 'db_config.php';
//                            $conn = new mysqli($servername, $username, $password, $dbname);
//                            if ($conn->connect_error) {
//                                die("Connection failed: " . $conn->connect_error);
//                            }
//                            $sql="SELECT `id`, `title`, `description`, `photo`, `created_at` FROM `blog`";
//                            //$sql = "SELECT medical_store.id, centre_name, cities.name, states.name, centre_address, contact_nos, photo FROM medical_store, cities, states WHERE medical_store.centre_state = states.id AND medical_store.centre_city = cities.id";
//                            $stmt = $conn->prepare($sql);
//                            if($stmt->execute()){
//                                $stmt->bind_result($id,$title,$description, $photo, $created_date);
//                                $inc=1;
//                                while ($stmt->fetch()){ ?>
<!--                                    <tr>-->
<!--                                        <td>--><?php //echo $inc; ?><!--</td>-->
<!--                                        <td>--><?php //echo $title; ?><!--</td>-->
<!--                                        <td>--><?php //echo $description; ?><!--</td>-->
<!--                                        <td>--><?php //if(!empty($photo)){ ?>
<!--                                                <div class="zoo-gallery">-->
<!--                                                    <a href="img/upload/--><?php //echo $photo; ?><!--" title="--><?php //echo $title; ?><!--" class="btn btn-outline btn-default waves-effect waves-light zoom-mp-img">-->
<!--                                                        <i class="fa fa-search m-r-5"></i> <span>View</span>-->
<!--                                                    </a>-->
<!--                                                </div>-->
<!--                                            --><?php //} else{ echo "&nbsp;"; } ?>
<!--                                        </td>-->
<!--                                        <td>--><?php // echo date_format(date_create($created_date),'d-m-Y'); ?><!--</td>-->
<!--                                        <td>-->
<!--                                            <a href='add-blog-edit.php?edit_id=--><?php //echo $id; ?><!--' class='btn btn-circle btn-success btn-sm' title='edit'><i class='fa fa-pencil'></i></a>-->
<!--                                            <a title="Delete Entry" href="delete-blog.php?id=--><?php //echo $id; ?><!--" class="btn btn-danger btn-circle" onclick="if(!confirm('Are you sure to delete this entry?')){return false;}"><i class="fa fa-trash"></i> </a></td>-->
<!--                                    </tr>-->
<!--                                    --><?php //$inc++; }
//                            }
//                            else{
//
//                            }
//                            ?>
<!--                            </tbody>-->
<!--                        </table>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
    <!-- /.container-fluid -->

    <?php include_once 'footer.php'; ?>
