<?php
session_start();
if(isset($_POST['email']) || isset($_POST['upass'])){
    
    include_once 'db_config.php';
    $_SESSION['er'] = "";
    $email_id = trim($_POST['email']);
    $upass = trim($_POST['upass']);

//    $captcha_sys = $_SESSION['captcha']['code'];
//    $captcha_user = trim($_POST['form_captcha']);

//    if ($captcha_sys != $captcha_user) {
//        //echo "<li>Incorrect captcha.</li>";
//
//        $_SESSION['er'] .= "<h4>Incorrect captcha.</h4>";
//    } else {

        $conn = new mysqli($servername, $username, $password, $dbname);

        $sql = "SELECT id, user_unique_id, username, pwd FROM logins WHERE user_type = 'admin' and email_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email_id);
        $stmt->execute();
        $stmt->bind_result($user_id, $user_unique_id, $uname, $db_upass);
        $stmt->fetch();
        $conn->close();
        if ($upass == $db_upass) {
            session_start();
            $_SESSION['login_status'] = 1;
            $_SESSION['login_id'] = $user_id;
            $_SESSION['user_unique_id'] = $user_unique_id;
            $_SESSION['login_user'] = $uname;
            $_SESSION['login_type'] = 'admin';
            $_SESSION['success'] = "ok";
            $_SESSION['name'] = $email_id;
            header("Location: index.php");
            exit();
        }
        $_SESSION['er'] .= "<h4>Incorrect Email or Password.</h4>" . " <p>Please check for valid Email and password and try again!.</p>";
        header("Location: login.php");
        exit();
//    }
//    header("Location: login.php");
//    exit();
}
else{

    session_start();
    if(isset($_SESSION['login_status']) && $_SESSION['login_status'] == 1){
        $_SESSION['success'] = "ok";
        header("Location: index.php");
        exit();
    }
    else{
        header("Location: logout.php");
        exit();
    }
}