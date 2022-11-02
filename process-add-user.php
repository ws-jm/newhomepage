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
if($_SESSION['login_type'] == 'admin'){
    $_SESSION['login_status']=0;
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

//    print_r( $_POST);
//    print_r($_FILES['photo']);
//    exit;
    $_SESSION['error'] = "";

    if (isset($_FILES['photo']) && !empty($_FILES['photo']['size'])) {

        $maxsize = 1007200;
        $acceptable = array(
            'jpeg',
            'jpg',
            'png'
        );
        $extension = explode(".", $_FILES['photo']["name"]);
        $extension = strtolower(end($extension));
        if (($_FILES['photo']['size'] >= $maxsize) || ($_FILES["photo"]["size"] == 0)) {
            $_SESSION['error'] .= '<li>File too large. File must be less than 500 KB.</li>';
        }

        if ((!in_array($extension, $acceptable)) || (empty($_FILES["photo"]["type"]))) {
            $_SESSION['error'] .= '<li>Invalid file type. Only JPG and PNG types are accepted.</li>';
        }

    }
    if (empty($_SESSION['error'])) {

        //$centre_name=addslashes(trim($_POST['centre_name']));
        $full_name = addslashes(trim($_POST['usr_fullname']));
        $user_name = addslashes(trim($_POST['usr_username']));
        $email_id = addslashes(trim($_POST['usr_email']));
//        $pwd = addslashes(trim($_POST['usr_pwd']));
        $pwd = "CP". rand(1111,9999);
        $mobile = $_POST['usr_mobile'];
        $company = addslashes(trim($_POST['usr_company']));

        $status = $_POST['status'];
        $photo = $_FILES['photo'];
        $target = "admin/img/upload";
        $pimagename = uploadPhoto($photo, $target);
        $created_date = date("Y-m-d h:i:s");

        $user_type = 'user';
        $unique_id = "CP-". rand(11111111, 99999999);

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("INSERT INTO `logins`(user_unique_id, user_type, full_name, username, email_id, pwd, mobile, company, profilepic, parent_id, `created_at`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssis", $unique_id, $user_type, $full_name, $user_name, $email_id, $pwd, $mobile, $company, $pimagename, $_SESSION['login_id'], $created_date);
        $stmt->execute();
        $hc_id = $stmt->insert_id;
        $conn->close();

        $_SESSION['hc_id'] = $hc_id;
        unset($_SESSION['error']);
        header("Location: user.php?success");
        exit();
    } else {
        header("Location: user.php?error");
        exit();
    }

}
	