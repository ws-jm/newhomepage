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

    if (isset($_FILES['photo']) && !empty($_FILES['photo']['size'])) {
        if (isset($_FILES['photo']) && empty($_FILES['photo'])) {
            $_SESSION['error'] .= "<li>Photo should be uploaded.</li>";
        } else {
            $maxsize = 2007200;
            $acceptable = array(
                'jpeg',
                'jpg',
                'png'
            );
            $extension = explode(".", $_FILES['photo']["name"]);
            $extension = strtolower(end($extension));
            if (($_FILES['photo']['size'] >= $maxsize) || ($_FILES["photo"]["size"] == 0)) {
                $_SESSION['error'] .= '<li>File too large. File must be less than 1 mb.</li>';
            }

            if ((!in_array($extension, $acceptable)) || (empty($_FILES["photo"]["type"]))) {
                $_SESSION['error'] .= '<li>Invalid file type. Only JPG and PNG types are accepted.</li>';
            }

        }
    }
    if (empty($_SESSION['error'])) {
        //$centre_name=addslashes(trim($_POST['centre_name']));
        $b_id = trim($_POST['b_id']);
        $title = $_POST['title'];
        $description = $_POST['description'];
        $photo = $_FILES['photo'];
        $created_at = date('Y-m-d h:i:s');
        $target = "img/upload";

        if (isset($_FILES['photo']) && !empty($_FILES['photo']['size'])) {

            if (!empty($photo)) {

                $pimagename = uploadPhoto($photo, $target);

            }
            $conn1 = new mysqli($servername, $username, $password, $dbname);
            if ($conn1->connect_error) {
                die("Connection failed: " . $conn1->connect_error);
            }
            $stmt1 = $conn1->prepare("SELECT id, count(id),`photo` FROM blog WHERE blog.id = ?");
            $stmt1->bind_param("i", $b_id);
            $stmt1->execute();
            $stmt1->bind_result($id, $count_id, $image);
            $stmt1->fetch();
            $conn1->close();

            if ($count_id == 1) {
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if (!empty($pimagename)) {

                    $target_file = $target . "/" . $image;
                    if (file_exists($target_file)) {

                        unlink($target_file);
                    }
                    $stmt = $conn->prepare("UPDATE `blog` SET `title`= ?,`description` = ?,`photo` = ?,`created_at`= ? Where blog.id= ?");
                    $stmt->bind_param("ssssi", $title, $description, $pimagename,$created_at, $b_id);
                    $stmt->execute();
                    $conn->close();
                }
            }
        } else {
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $stmt = $conn->prepare("UPDATE `blog` SET `title`= ?,`description` = ?,`created_at`= ? Where blog.id= ?");
            $stmt->bind_param("sssi", $title, $description, $created_at, $b_id);
            $stmt->execute();
        }

        header("Location: add-blog.php?success2");
        exit();
    } else {
        header("Location: add-blog.php?error2");
        exit();
    }

}
