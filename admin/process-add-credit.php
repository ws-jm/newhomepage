<?php
set_time_limit(5000);
date_default_timezone_set('Asia/Kolkata');
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
if ($_SESSION['login_type'] != 'admin') {
    $_SESSION['login_status'] = 0;
    header("Location: process_login.php");
    exit();
}

function randomSalt($len = 8)
{
    $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
    $l = strlen($chars) - 1;
    $str = '';
    for ($i = 0; $i < $len; $i++) {
        $str .= $chars[rand(0, $l)];
    }
    return $str;
}

function uploadPhoto($source, $target)
{
    $temp = explode(".", $source["name"]);
    $pimagename = 'images_' . randomSalt() . '.' . end($temp);
    if (!file_exists($target . DIRECTORY_SEPARATOR . $pimagename)) {
        if (move_uploaded_file($source['tmp_name'], $target . DIRECTORY_SEPARATOR . $pimagename)) {
            return $pimagename;
        } else {
            return false;
        }
    } else {
        uploadPhoto($source, $target);
        return $pimagename;
    }
}

require_once 'db_config.php';

if (isset($_POST['submit'])) {

//				print_r($_FILES);
    $_SESSION['error'] = "";

    $unique_id = $_SESSION['user_unique_id'];
    /* print_r($_SESSION);die();
    echo "<script>alert('" . $unique_id . "')</script>"; */
            
    $conn2 = new mysqli($servername, $username, $password, $dbname);
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
    }
    $stmt2 = $conn2->prepare("Select credit from logins where logins.user_unique_id =? ");
    $stmt2->bind_param("s", $unique_id);
    $stmt2->execute();
    $stmt2->bind_result($credit);
    $stmt2->fetch();
    $conn2->close();

    if (($credit != 0 || !empty($credit)) && $_POST['no_of_sms'] < $credit) {

        if (isset($_POST['no_of_sms']) && empty($_POST['no_of_sms'])) {
            $_SESSION['error'] .= "<li>No of SMS should not be blank</li>";
        }
        if (isset($_POST['per_sms_price']) && empty($_POST['per_sms_price'])) {
            $_SESSION['error'] .= "<li>Per SMS Price should not be blank</li>";
        }

        if (isset($_POST['description']) && empty($_POST['description'])) {
            $_SESSION['error'] .= "<li>Description should not be blank</li>";
        }
        
        if (empty($_SESSION['error'])) {
            //$centre_name=addslashes(trim($_POST['centre_name']));
            $txn_type = $_POST['action'];
            $reseller_unique_id = $_POST['unique_id'];
            $description = $_POST['description'];
            $no_of_sms = $_POST['no_of_sms'];
            $per_sms_price = $_POST['per_sms_price'];
            $total_amount = $no_of_sms * $per_sms_price;
            $tax_amount = 0;
            $unique_id = $_SESSION['user_unique_id'];
            $tax_status = "No";
            
            if (isset($_POST['is_tax']) && ($_POST['is_tax']) == 'Yes') {
                $tax_status = $_POST['is_tax'];
                $total_amt = $no_of_sms * $per_sms_price;
                $tax_amount = ($total_amount * 18) / 100;
                $total_amount = $total_amt + $tax_amount;
            }

            $created_date = date("Y-m-d h:i:s");
            $updated_at = date("Y-m-d h:i:s");
            $tax_percentage = 18;
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            echo "first, ";
            $stmt = $conn->prepare("INSERT INTO transaction_logs(`credit`, `per_sms_price`,`old_credit`, `tax_status`, `tax_percentage`, `tax_amount`, `total_amount`, `description`, `login_user_unique_id`, `user_unique_id`, `txn_type`, `created_at`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("dddsiddsssss", $no_of_sms, $per_sms_price, $credit, $tax_status, $tax_percentage, $tax_amount, $total_amount, $description, $unique_id, $reseller_unique_id, $txn_type, $created_date);
            if ($stmt->execute()) {
                $hc_id = $stmt->insert_id;
                $conn1 = new mysqli($servername, $username, $password, $dbname);
                if ($conn1->connect_error) {
                    die("Connection failed: " . $conn1->connect_error);
                }
                $stmt1 = $conn1->prepare("update logins set credit = credit + ?, updated_at = ? where logins.user_unique_id =? ");
                $stmt1->bind_param("dss", $no_of_sms, $updated_at, $reseller_unique_id);
                if ($stmt1->execute()) {
                    $conn2 = new mysqli($servername, $username, $password, $dbname);
                    if ($conn2->connect_error) {
                        die("Connection failed: " . $conn2->connect_error);
                    }
                    $stmt2 = $conn2->prepare("update logins set credit = credit - ?, updated_at = ? where logins.user_unique_id =? ");
                    $stmt2->bind_param("dss", $no_of_sms, $updated_at, $unique_id);
                    $stmt2->execute();
                    $conn2->close();
                }
                $conn1->close();
            }
            $conn->close();

            $_SESSION['hc_id'] = $hc_id;
            unset($_SESSION['error']);
            header("Location: reseller.php?added");
            exit();
        } else {
            header("Location: reseller.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Insufficient Fund.";
        header("Location: reseller.php");
        exit();
    }

}
