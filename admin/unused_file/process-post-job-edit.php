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

    $_SESSION['error'] = "";

    if (isset($_POST['title']) && empty($_POST['title'])) {
        $_SESSION['error'] .= "<li>Title Name should not be blank</li>";
    }
    if (isset($_POST['description']) && empty($_POST['description'])) {
        $_SESSION['error'] .= "<li>Description should not be blank</li>";
    }


    if (empty($_SESSION['error'])) {
        //$centre_name=addslashes(trim($_POST['centre_name']));
        $pj_id = trim($_POST['pj_id']);
        $title = $_POST['title'];
        $description = $_POST['description'];
        $created_at = date('Y-m-d h:i:s');
        if(($pj_id)!= 0){
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $stmt = $conn->prepare("UPDATE `post_job` SET `title`= ?,`description` = ?,`created_at`= ? Where id= ?");
            $stmt->bind_param("sssi", $title, $description, $created_at, $pj_id);
            $stmt->execute();
        }
        header("Location: job-post.php?success2");
        exit();
    } else {
        header("Location: job-post.php?error2");
        exit();
    }
}
