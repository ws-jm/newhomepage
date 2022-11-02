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
require_once 'db_config.php';

if (isset($_GET['id'])) {
    if (!empty($_GET['id'])
    ) {
        $id = addslashes(trim($_GET['id']));
//exit;
        $conn1 = new mysqli($servername, $username, $password, $dbname);
        if ($conn1->connect_error) {
            die("Connection failed: " . $conn1->connect_error);
        }
        $stmt1 = $conn1->prepare("DELETE FROM logins WHERE id = ?");
        $stmt1->bind_param("i", $id);
        $stmt1->execute();
        $conn1->close();

        header("Location: reseller.php?deleted");
        exit();
    } else {
        header("Location: reseller.php?error2");
        exit();
    }
}
