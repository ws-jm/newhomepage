<?php
    session_start();
    include_once 'db_config.php';
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
    if(!$conn){
    die('Could not Connect My Sql:' .mysql_error());
    }


    if(isset($_POST['token'])){

        $token = $_POST['token'];
        $name = $_POST['name'];

        
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT name FROM cp_api_settings WHERE name='$name';";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows != 0) {
            $continue = "1";
        }else{
            $continue = null;
        }



        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        if(isset($continue)){
            $sql = "UPDATE cp_api_settings SET token='$token' WHERE name='$name';";
              if (mysqli_query($conn, $sql)) {
                header("Location: api_settings.php");
                echo "success";
                $_SESSION['success'] = "success";
                $_SESSION["token"] = $token;
                exit();
              }else{
                header("Location: api_settings.php");
                $_SESSION['error'] = "error";
                exit();
              }
        }else{
            $sql = "INSERT INTO cp_api_settings (name, token)
            VALUES ('$name','$token')";
            if (mysqli_query($conn, $sql)) {
                header("Location: api_settings.php");
                $_SESSION['success'] = "success";
                $_SESSION["token"] = $token;
                exit();
            } else {
                header("Location: api_settings.php");
                $_SESSION['error'] = "error";
                exit();
            }
        }


        mysqli_close($conn);
    }

?>