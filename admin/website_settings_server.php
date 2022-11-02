<?php
include_once 'db_config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


session_start();
ini_set('upload_max_filesize', '64M');
ini_set('post_max_size', '20M');
ini_set('max_input_time', '-1');
ini_set('max_execution_time', '0');
//set_time_limit(5000);
date_default_timezone_set('Asia/Kolkata');

function randomSalt($len = 8){
    $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
    $l = strlen($chars) - 1;
    $str = '';
    for ($i = 0; $i < $len; $i++) {
        $str .= $chars[rand(0, $l)];
    }
    return $str;
}


function uploadPhoto($source, $target){
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


if(isset($_POST['submit']))
{	 
    if (isset($_FILES['sitelogo']) && !empty($_FILES['sitelogo']['size'])) {

        $maxsize = 2507200;
        $acceptable = array(
            'jpeg',
            'jpg',
            'png'
        );
        $extension = explode(".", $_FILES['sitelogo']["name"]);
        $extension = strtolower(end($extension));
        if (($_FILES['sitelogo']['size'] >= $maxsize) || ($_FILES["sitelogo"]["size"] == 0)) {
            $_SESSION['error'] .= '<li>File too large. File must be less than 2 MB.</li>';
        }
        if ((!in_array($extension, $acceptable)) || (empty($_FILES["sitelogo"]["type"]))) {
            $_SESSION['error'] .= '<li>Invalid file type. Image-1 Only JPG and PNG types are accepted.</li>';
        }

    }

    if (isset($_FILES['sitefavicon']) && !empty($_FILES['sitefavicon']['size'])) {

        $maxsize = 2507200;
        $acceptable = array(
            'jpeg',
            'jpg',
            'png'
        );
        $extension = explode(".", $_FILES['sitefavicon']["name"]);
        $extension = strtolower(end($extension));
        if (($_FILES['sitefavicon']['size'] >= $maxsize) || ($_FILES["sitefavicon"]["size"] == 0)) {
            $_SESSION['error'] .= '<li>File too large. File must be less than 2 MB.</li>';
        }
        if ((!in_array($extension, $acceptable)) || (empty($_FILES["sitefavicon"]["type"]))) {
            $_SESSION['error'] .= '<li>Invalid file type. Image-1 Only JPG and PNG types are accepted.</li>';
        }

    }

    if (isset($_FILES['sitelogo']) && !empty($_FILES['sitelogo']['size'])) {
        $photo1 = $_FILES['sitelogo'];
        $target = "img/upload/sitelogo";
        $sitelogoname = uploadPhoto($photo1, $target);
    }

    if (isset($_FILES['sitefavicon']) && !empty($_FILES['sitefavicon']['size'])) {
        $photo1 = $_FILES['sitefavicon'];
        $target = "img/upload/sitefavicon";
        $sitefaviconname = uploadPhoto($photo1, $target);
    }

    $sitetitle = $_POST['sitetitle'];
    $sitedescription = $_POST['sitedescription'];
    $sitekeywors = $_POST['sitekeywors'];
    $sitecolour = $_POST['sitecolour'];
    $condition = $_POST['condition'];
    $privacypolicy = $_POST['privacypolicy'];
    $supportemail = $_POST['supportemail'];
    $supportphone = $_POST['supportphone'];
    $footertext = $_POST['footertext'];  
    $tawktocode = $_POST['tawktocode'];
     
    $stmt1 = $conn->prepare("SELECT email_id FROM logins WHERE email_id='$supportemail'");
    $stmt1->execute();
    $stmt1->bind_result($data);
    $stmt1->fetch();
     
     
    if(isset($data)){
        header("Location: website_settings.php");
        $_SESSION['alread'] = "Data Error!";
        exit();
    }else{
        $sql = "INSERT INTO cp_site_settings (title,description,keywords,logo,favicon,colour,terms,policy,support_email,support_phone,footer,live_chat) VALUES ('$sitetitle','$sitedescription','$sitekeywors','$sitelogoname','$sitefaviconname','$sitecolour','$condition','$privacypolicy','$supportemail','$supportphone','$footertext', '$tawktocode')";
        if (mysqli_query($conn, $sql)) {
            header("Location: website_settings.php");
            $_SESSION['d_success'] = "Date is saved!!!";
            exit();
        } else {
            header("Location: website_settings.php");
            $_SESSION['c_error'] = "Connect Error!";
            exit();
        }
        mysqli_close($conn);   
    }    
}
?>
