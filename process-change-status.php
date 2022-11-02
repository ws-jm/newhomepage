<?php
set_time_limit(5000);
date_default_timezone_set('Asia/Kolkata');
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
if($_SESSION['login_type'] == 'admin'){
    $_SESSION['login_status']=0;
    header("Location: process_login.php");
    exit();
}
require_once 'db_config.php';
if(isset($_POST['submit-status'])){
//print_r($_POST);
//exit();
    $_SESSION['error'] = "";

    if(isset($_POST['change-status']) && empty($_POST['change-status'])){
        $_SESSION['error'] .= "<li>Status should not be blank</li>";
    }
    if(isset($_POST['campaign_id']) && empty($_POST['campaign_id'])){
        $_SESSION['error'] .= "<li>Campaign id should not be blank</li>";
    }

    if(empty($_SESSION['error'])){

        $status = $_POST['change-status'];
        $campaign_id = $_POST['campaign_id'];
        $updated_at = date("Y-m-d h:i:s");

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("update send_wp_msgs set status = ?, updated_at = ?  WHERE id = ? ");
        $stmt->bind_param("ssi", $status, $updated_at, $campaign_id);
        if($stmt->execute()){
            $conn1 = new mysqli($servername, $username, $password, $dbname);
            if ($conn1->connect_error) {
                die("Connection failed: " . $conn1->connect_error);
            }
            $stmt1 =  $conn1->prepare("update wp_mobile_listings Set status = ? where send_wp_msgs_id = ?");
            $stmt1->bind_param("si",$status, $campaign_id);
            $stmt1->execute();
            $conn1->close();
        }
        $conn->close();

        unset($_SESSION['error']);
        $_SESSION['success'] = "Status Updated Successfully";
        header("Location: deliveryapp.php");
        exit();
    }else{
        header("Location: deliveryapp.php");
        exit();
    }
}

if(isset($_POST['submit'])){
//print_r($_POST);
//exit();
    $_SESSION['error'] = "";

    if(isset($_POST['chg-status']) && empty($_POST['chg-status'])){
        $_SESSION['error'] .= "<li>Status should not be blank</li>";
    }
    if(isset($_POST['campaign_id']) && empty($_POST['campaign_id'])){
        $_SESSION['error'] .= "<li>Campaign id should not be blank</li>";
    }
    if(isset($_POST['check']) && empty($_POST['check'])){
        $_SESSION['error'] .= "<li>Checkbox should not be blank</li>";
    }

    if(empty($_SESSION['error'])){

        $status = $_POST['chg-status'];
        $campaign_id = $_POST['campaign_id'];
        $updated_at = date("Y-m-d h:i:s");
        $check_box_id = $_POST['check'];

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("update send_wp_msgs set status = ?, updated_at = ?  WHERE id = ? ");
        $stmt->bind_param("ssi", $status, $updated_at, $campaign_id);
        if($stmt->execute()){
            $conn1 = new mysqli($servername, $username, $password, $dbname);
            if ($conn1->connect_error) {
                die("Connection failed: " . $conn1->connect_error);
            }
            $stmt1 =  $conn1->prepare("update wp_mobile_listings Set status = ? where wp_mobile_listings.id = ? and  send_wp_msgs_id = ?");
            for ($i = 0; $i < count($check_box_id); $i++) {
                $checkbox_id  = $check_box_id[$i];
                $stmt1->bind_param("sii", $status, $checkbox_id,  $campaign_id);
                $stmt1->execute();
            }

            $conn1->close();
        }
        $conn->close();

        unset($_SESSION['error']);
        $_SESSION['success'] = "Status Updated Successfully";
        header("Location: deliveryapp.php");
        exit();
    }else{
        header("Location: deliveryapp.php");
        exit();
    }
}

?>

