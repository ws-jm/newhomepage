<?php


session_start();
if(isset($_POST['uname']) || isset($_POST['upass'])){

    include_once 'db_config.php';
    $_SESSION['er'] = "";
    $email_id = trim($_POST['email']);
    $upass = trim($_POST['upass']);

    $captcha_sys = $_SESSION['captcha']['code'];
    $captcha_user = trim($_POST['form_captcha']);
    if ($captcha_sys != $captcha_user) {
        //echo "<li>Incorrect captcha.</li>";

        $_SESSION['er'] .= "<h4>Incorrect captcha.</h4>";
    } else {
        $conn = new mysqli($servername, $username, $password, $dbname);

        $sql = "SELECT id, user_unique_id, full_name, username, pwd, user_type, logins.rollback FROM logins WHERE email_id = ? and status = 'Active'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email_id);
        $stmt->execute();
        $stmt->bind_result($user_id, $user_unique_id, $fullName, $uname, $db_upass, $user_type, $rollback);
        $stmt->fetch();
        $conn->close();


////////////////////////////////////////////////////////


        include_once 'db_config.php';
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt1 = $conn->prepare("SELECT token FROM cp_api_settings");
        $stmt1->execute();
        $stmt1->bind_result($token);
        $stmt1->fetch();


/////////////////////////////////////////////////////////



        if ($upass == $db_upass && $user_type == 'reseller') {
            session_start();
            $_SESSION['login_status'] = 1;
            $_SESSION['login_id'] = $user_id;
            $_SESSION['user_unique_id'] = $user_unique_id;
            $_SESSION['login_user'] = $uname;
            $_SESSION['login_type'] = $user_type;
            $_SESSION['rollback'] = $rollback;
            $_SESSION['username'] = $email_id;
  
            $curl = curl_init();

            curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.wali.chat/v1/messages",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"phone\":\"+919461001408\",\"message\":\"$fullName ($uname) has just logged in to credit panel.\"}",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Token: $token"
            ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);


            header("Location: index.php");
            $_SESSION['success'] = "ok";
            
            
            exit();
        }
        if ($upass == $db_upass && $user_type == 'user') {
            session_start();
            $_SESSION['login_status'] = 1;
            $_SESSION['login_id'] = $user_id;
            $_SESSION['user_unique_id'] = $user_unique_id;
            $_SESSION['login_user'] = $uname;
            $_SESSION['login_type'] = $user_type;
            $_SESSION['rollback'] = $rollback;
            $_SESSION['username'] = $email_id;
            
            $curl = curl_init();

            curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.wali.chat/v1/messages",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"phone\":\"+919461001408\",\"message\":\"$fullName ($uname) has just logged in to credit panel\"}",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Token: $token"
            ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            
            
        
            header("Location: index.php");
            $_SESSION['success'] = "ok";
            exit();
        }
        $_SESSION['er'] .= "<h4>Incorrect Email or Password.</h4>" . " <p>Please check for valid Email and password and try again!.</p>";
        header("Location: login.php");
        exit();
    }
    header("Location: login.php");
    exit();
}
else{

    session_start();
    if(isset($_SESSION['login_status']) && $_SESSION['login_status'] == 1){
        header("Location: index.php");
        $_SESSION['success'] = "ok";
        $_SESSION['username'] = $_POST['email'];
        exit();
    }
    else{
        header("Location: logout.php");
        exit();
    }


// session_start();
// if(isset($_POST['email']) || isset($_POST['upass'])){

//     include_once 'db_config.php';
//     $_SESSION['er'] = "";
//     $email_id = trim($_POST['email']);
//     $upass = trim($_POST['upass']);

//     //$captcha_sys = $_SESSION['captcha']['code'];
//     //$captcha_user = trim($_POST['form_captcha']);
//     if (isset($email_id) && isset($upass)) {

//         $conn = new mysqli($servername, $username, $password, $dbname);

//         $sql = "SELECT id, user_unique_id, username, pwd, user_type, logins.rollback FROM logins WHERE email_id = ? and status = 'Active'";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("s", $email_id);
//         $stmt->execute();
//         $stmt->bind_result($user_id, $user_unique_id, $uname, $db_upass, $user_type, $rollback);
//         $stmt->fetch();
//         $conn->close();
//         if ($upass == $db_upass && $user_type == 'reseller') {
//             $_SESSION['login_status'] = 1;
//             $_SESSION['login_id'] = $user_id;
//             $_SESSION['user_unique_id'] = $user_unique_id;
//             $_SESSION['login_user'] = $uname;
//             $_SESSION['login_type'] = $user_type;
//             $_SESSION['rollback'] = $rollback;
//             $_SESSION['success'] = "ok";
//             header("Location: index.php");
//             exit();
//         }
//         if ($upass == $db_upass && $user_type == 'user') {
//             $_SESSION['login_status'] = 1;
//             $_SESSION['login_id'] = $user_id;
//             $_SESSION['user_unique_id'] = $user_unique_id;
//             $_SESSION['login_user'] = $uname;
//             $_SESSION['login_type'] = $user_type;
//             $_SESSION['rollback'] = $rollback;
//             $_SESSION['success'] = "ok";
//             header("Location: index.php");
//             exit();
//         }
//         $_SESSION['er'] .= "<h4>Incorrect Email or Password.</h4>" . " <p>Please check for valid Email and password and try again!.</p>";
//         header("Location: login.php");
//         exit();
//     }
//     header("Location: login.php");
//     exit();
// }
// else{

//     session_start();
//     if(isset($_SESSION['login_status']) && $_SESSION['login_status'] == 1){
//         $_SESSION['success'] = "ok";
//         header("Location: index.php");
//         exit();
//     }
//     else{
//         header("Location: logout.php");
//         exit();
//     }
}