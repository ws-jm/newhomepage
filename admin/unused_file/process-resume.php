<?php
set_time_limit(5000);
date_default_timezone_set('Asia/Kolkata');

require_once 'db_config.php';

if (isset($_POST['submit'])) {

        $created_at = date('Y-m-d h:i');
        $tmp_name = $_FILES['image']['tmp_name'];
        $file_size = $_FILES['image']['size'];
        $file_name = $_FILES['image']['name'];    //seshu.JPG

        $extension = explode(".", $file_name);
        $ext = strtolower(end($extension));
        // $ext = strtolower(end(explode(".", $file_name)));
        $allowed_exts = array('pdf','doc','docx');
        if (!in_array($ext, $allowed_exts))
            $err_msg = "Invalid file";

        if ($file_size > 5097152)
            $err_msg = "file size should be less than or equal to 5MB";
        if (empty($err_msg)) {
            if (move_uploaded_file($tmp_name, "img/upload/pdf/" . $file_name)) {

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $stmt = $conn->prepare("INSERT INTO `resume`(`resume_pdf`, created_at) VALUES (?,?)");
            $stmt->bind_param("ss", $file_name,$created_at);
            $stmt->execute();
            $hc_id = $stmt->insert_id;
            $conn->close();
             }
			 header("Location: ../current_opening.php?success#s");
        exit();
        }else{
            header("Location: ../current_opening.php?error#e");
            exit();
        }

}
	