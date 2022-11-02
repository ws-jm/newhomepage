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
if ($_SESSION['login_type'] == 'admin') {
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
//				print_r( $_POST);
//				print_r($_FILES);
    $_SESSION['error'] = "";

    if (isset($_POST['mobile']) && empty($_POST['mobile'])) {
        $_SESSION['error'] .= "<li>Title should not be blank</li>";
    }
    if (empty($_SESSION['error'])) {
        //$centre_name=addslashes(trim($_POST['centre_name']));

        $mobile = $_POST['mobile'];
        $email_id = $_POST['email'];
        $description = $_POST['description'];
        $created_date = date("Y-m-d h:i:s");

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("Update `contactus` Set `mobile`=?, `email`=?, `description`=?, `created_at`=?");
        $stmt->bind_param("ssss", $mobile, $email_id, $description, $created_date);
        $stmt->execute();
        $hc_id = $stmt->insert_id;
        $conn->close();

        $_SESSION['hc_id'] = $hc_id;
        unset($_SESSION['error']);
        header("Location: contact.php?success");
        exit();
    } else {
        header("Location: contact.php?error");
        exit();
    }

}
	