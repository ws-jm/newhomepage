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
if($_SESSION['login_type'] != 'admin'){
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

//    print_r($_POST);
//    print_r($_FILES['photo']);
//    exit;
    $_SESSION['error'] = "";
    if (isset($_POST['usr_unique_id']) && empty($_POST['usr_unique_id'])) {
        $_SESSION['error'] .= "<li>Unique Id should not be blank.</li>";
    }

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

        if(!empty($_POST['usr_unique_id'])){

            $user_unique_id = trim($_POST['usr_unique_id']);
            $full_name = addslashes(trim($_POST['usr_fullname']));
            $user_name = addslashes(trim($_POST['usr_username']));
            $email_id = addslashes(trim($_POST['usr_email']));
            $pwd = addslashes(trim($_POST['usr_pwd']));
            $mobile = $_POST['usr_mobile'];
            $company = addslashes(trim($_POST['usr_company']));
            $update_date = date("Y-m-d h:i:s");
            $user_type = 'user';
            $status = $_POST['status'];

            if (isset($_FILES['photo']) && !empty($_FILES['photo']['size'])) {

                $photo = $_FILES['photo'];
                $target = "img/upload";
                if (!empty($photo)) {
                    $pimagename = uploadPhoto($photo, $target);
                }
                $conn1 = new mysqli($servername, $username, $password, $dbname);
                if ($conn1->connect_error) {
                    die("Connection failed: " . $conn1->connect_error);
                }
                $stmt1 = $conn1->prepare("SELECT count(id), `profilepic` FROM `logins` WHERE user_unique_id = ? and  user_type = ?");
                $stmt1->bind_param("ss", $user_unique_id, $user_type);
                $stmt1->execute();
                $stmt1->bind_result($count_id, $image);
                $stmt1->fetch();
                $conn1->close();
                if ($count_id == 1) {

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    if (!empty($pimagename)) {

                        $target_file1 = $target . "/" . $image;
                        if (file_exists($target_file1)) {
                            unlink($target_file1);
                        }
                        $stmt = $conn->prepare("Update logins Set full_name = ?, username = ?, email_id = ?, pwd = ?, mobile = ?, company = ?, profilepic = ?, status = ?, updated_at = ? where user_unique_id = ? and  user_type = ?");
                        $stmt->bind_param("sssssssssss", $full_name, $user_name, $email_id, $pwd, $mobile, $company, $pimagename, $status, $update_date, $user_unique_id, $user_type);
                        $stmt->execute();
                        $conn->close();
                        unset($_SESSION['error']);
                        header("Location: user.php?edited");
                        exit();
                    }
                }else{
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    if (!empty($pimagename)) {
                        $stmt = $conn->prepare("Update logins Set full_name = ?, username = ?, email_id = ?, pwd = ?, mobile = ?, company = ?, profilepic = ?, status = ?, updated_at = ? where user_unique_id = ? and  user_type = ?");
                        $stmt->bind_param("sssssssssss", $full_name, $user_name, $email_id, $pwd, $mobile, $company, $pimagename, $status, $update_date, $user_unique_id, $user_type);
                        $stmt->execute();
                        $conn->close();
                        unset($_SESSION['error']);
                        header("Location: user.php?edited");
                        exit();
                    }
                }
            }else {

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $stmt = $conn->prepare("Update logins Set full_name = ?, username = ?, email_id = ?, pwd = ?, mobile = ?, company = ?, status = ?, updated_at = ? where user_unique_id = ? and  user_type = ?");
                $stmt->bind_param("ssssssssss", $full_name, $user_name, $email_id, $pwd, $mobile, $company, $status, $update_date, $user_unique_id, $user_type);
                $stmt->execute();
                $conn->close();
                unset($_SESSION['error']);
                header("Location: user.php?edited");
                exit();
            }
        }else {
            header("Location: user.php?error2");
            exit();
        }
    } else {
        header("Location: user.php?error2");
        exit();
    }

}
	