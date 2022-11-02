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
include_once 'db_config.php';


if (isset($_POST['submit'])) {

    $_SESSION['error'] = "";

    if (isset($_POST['old_password']) && empty($_POST['old_password'])) {
        $_SESSION['error'] .= "<li>Old Password should not be blank.</li>";
    } else {
        $unique_id = $_SESSION['user_unique_id'];
//Fetch Old password
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("SELECT pwd from logins WHERE user_unique_id = ?");
        $stmt->bind_param("i", $unique_id);
        $stmt->execute();
        $stmt->bind_result($old_db_pwd);
        $stmt->fetch();
        $conn->close();

        $old_pass = addslashes(trim($_POST['old_password']));
//    echo $admin_pass;
        if ($old_db_pwd != $old_pass) { //if passwords match
            $_SESSION['error'] .= "<li>Old Password is Incorrect.</li>";
        }
    }
    if (isset($_POST['form_new_password']) && empty($_POST['form_new_password'])) {
        $_SESSION['error'] .= "<li>New Password should not be blank.</li>";
    }
    if (isset($_POST['form_confirm_new_password']) && empty($_POST['form_confirm_new_password'])) {
        $_SESSION['error'] .= "<li>Confirm Password should not be blank.</li>";
    }
    if ($_POST['new_password'] != $_POST['confirm_new_password']) {
        $_SESSION['error'] .= "<li>New password and confirm password doesn't match.</li>";
    }

//    echo $_SESSION['error'];

    if ($_SESSION['error'] == "") {
        $old_pass = addslashes(trim($_POST['old_password']));
        $new_pass = addslashes(trim($_POST['new_password']));
        $confirm_pass = addslashes(trim($_POST['confirm_new_password']));
        $update_date = date("Y-m-d h:i:s");
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $unique_id = $_SESSION['user_unique_id'];
        $stmt = $conn->prepare("UPDATE logins SET pwd = ?, updated_at = ? WHERE user_unique_id = ?");
        $stmt->bind_param("sss", $new_pass, $update_date, $unique_id);
        if (!$stmt->execute()) {
            $query_success = false;
        }
        $conn->close();

        unset($_SESSION['error']);
        header("Location: change-password.php?success");
        exit();
    }
    header("Location: change-password.php?error");
    exit();
}

