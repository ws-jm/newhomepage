<?php
session_start();
ini_set('upload_max_filesize', '64M');
ini_set('post_max_size', '20M');
ini_set('max_input_time', '-1');
ini_set('max_execution_time', '0');
//set_time_limit(5000);
date_default_timezone_set('Asia/Kolkata');

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
if ($_SESSION['login_type'] == 'admin') {
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

function uploadPdf($source, $target)
{
    $temp = explode(".", $source["name"]);
    $pimagename = 'file_' . randomSalt() . '.' . end($temp);
    if (!file_exists($target . DIRECTORY_SEPARATOR . $pimagename)) {
        if (move_uploaded_file($source['tmp_name'], $target . DIRECTORY_SEPARATOR . $pimagename)) {
            return $pimagename;
        } else {
            return false;
        }
    } else {
        uploadPdf($source, $target);
        return $pimagename;
    }
}

function uploadAudio($source, $target)
{
    $temp = explode(".", $source["name"]);
    $pimagename = 'audio_' . randomSalt() . '.' . end($temp);
    if (!file_exists($target . DIRECTORY_SEPARATOR . $pimagename)) {
        if (move_uploaded_file($source['tmp_name'], $target . DIRECTORY_SEPARATOR . $pimagename)) {
            return $pimagename;
        } else {
            return false;
        }
    } else {
        uploadAudio($source, $target);
        return $pimagename;
    }
}

function uploadVideo($source, $target)
{
    $temp = explode(".", $source["name"]);
    $pimagename = 'video' . randomSalt() . '.' . end($temp);
    if (!file_exists($target . DIRECTORY_SEPARATOR . $pimagename)) {
        if (move_uploaded_file($source['tmp_name'], $target . DIRECTORY_SEPARATOR . $pimagename)) {
            return $pimagename;
        } else {
            return false;
        }
    } else {
        uploadVideo($source, $target);
        return $pimagename;
    }
}
require_once 'db_config.php';
if (isset($_POST['send'])) {
    $_SESSION['error1'] = "";
    if (isset($_POST['headline']) && empty($_POST['headline'])) {
        $_SESSION['error1'] .= "<li>Headline should not be blank</li>";
    }
    if (empty($_SESSION['error1'])) {
        $created_at = date("Y-m-d h:i:s");
        $headline = $_POST['headline'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("update headlines set headline = ?, created_at = ?");
        $stmt->bind_param("ss", $headline, $created_at);
        $stmt->execute();
        $conn->close();

        $_SESSION['success1'] = "Stored Successfully!";
        unset($_SESSION['error1']);
        header("Location: sendwhatsapp.php");
        exit();
    } else {
        header("Location: sendwhatsapp.php");
        exit();
    }
}
if (isset($_POST['submit'])) {

    $_SESSION['error'] = "";
    $unique_id = $_SESSION['user_unique_id'];

    $conn2 = new mysqli($servername, $username, $password, $dbname);
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
    }
    $stmt2 = $conn2->prepare("Select credit from logins where logins.user_unique_id =? ");
    $stmt2->bind_param("s", $unique_id);
    $stmt2->execute();
    $stmt2->bind_result($credit);
    $stmt2->fetch();
    $conn2->close();

    if ($credit != 0 || !empty($credit)) {

        if (isset($_POST['numbercount']) && empty($_POST['numbercount'])) {
            $_SESSION['error'] .= "<li>Number Count should not be blank</li>";
        }
        if (isset($_POST['mobileno']) && empty($_POST['mobileno'])) {
            $_SESSION['error'] .= "<li>Component should be selected.</li>";
        }
        if (isset($_FILES['photo-1']) && !empty($_FILES['photo-1']['size'])) {

            $maxsize = 2507200;
            $acceptable = array(
                'jpeg',
                'jpg',
                'png'
            );
            $extension = explode(".", $_FILES['photo-1']["name"]);
            $extension = strtolower(end($extension));
            if (($_FILES['photo-1']['size'] >= $maxsize) || ($_FILES["photo-1"]["size"] == 0)) {
                $_SESSION['error'] .= '<li>File too large. File must be less than 2 MB.</li>';
            }
            if ((!in_array($extension, $acceptable)) || (empty($_FILES["photo-1"]["type"]))) {
                $_SESSION['error'] .= '<li>Invalid file type. Image-1 Only JPG and PNG types are accepted.</li>';
            }

        }
        if (isset($_FILES['photo-2']) && !empty($_FILES['photo-2']['size'])) {

            $maxsize = 2507200;
            $acceptable = array(
                'jpeg',
                'jpg',
                'png'
            );
            $extension = explode(".", $_FILES['photo-2']["name"]);
            $extension = strtolower(end($extension));
            if (($_FILES['photo-2']['size'] >= $maxsize) || ($_FILES["photo-2"]["size"] == 0)) {
                $_SESSION['error'] .= '<li>File too large. File must be less than 2 MB.</li>';
            }
            if ((!in_array($extension, $acceptable)) || (empty($_FILES["photo-2"]["type"]))) {
                $_SESSION['error'] .= '<li>Invalid file type. Image-2 Only JPG and PNG types are accepted.</li>';
            }

        }
        if (isset($_FILES['photo-3']) && !empty($_FILES['photo-3']['size'])) {

            $maxsize = 2507200;
            $acceptable = array(
                'jpeg',
                'jpg',
                'png'
            );
            $extension = explode(".", $_FILES['photo-3']["name"]);
            $extension = strtolower(end($extension));
            if (($_FILES['photo-3']['size'] >= $maxsize) || ($_FILES["photo-3"]["size"] == 0)) {
                $_SESSION['error'] .= '<li>File too large. File must be less than 2 MB.</li>';
            }
            if ((!in_array($extension, $acceptable)) || (empty($_FILES["photo-3"]["type"]))) {
                $_SESSION['error'] .= '<li>Invalid file type. Image-3 Only JPG and PNG types are accepted.</li>';
            }

        }
        if (isset($_FILES['photo-4']) && !empty($_FILES['photo-4']['size'])) {

            $maxsize = 2507200;
            $acceptable = array(
                'jpeg',
                'jpg',
                'png'
            );
            $extension = explode(".", $_FILES['photo-4']["name"]);
            $extension = strtolower(end($extension));
            if (($_FILES['photo-4']['size'] >= $maxsize) || ($_FILES["photo-4"]["size"] == 0)) {
                $_SESSION['error'] .= '<li>File too large. File must be less than 2 MB.</li>';
            }
            if ((!in_array($extension, $acceptable)) || (empty($_FILES["photo-4"]["type"]))) {
                $_SESSION['error'] .= '<li>Invalid file type. Image-4 Only JPG and PNG types are accepted.</li>';
            }
        }
        if (isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['size'])) {

            $maxsize = 5107200;
            $acceptable = array(
                'pdf'
            );
            $extension = explode(".", $_FILES['pdf_file']["name"]);
            $extension = strtolower(end($extension));
            if (($_FILES['pdf_file']['size'] >= $maxsize) || ($_FILES["pdf_file"]["size"] == 0)) {
                $_SESSION['error'] .= '<li>File too large. File must be less than 5 MB.</li>';
            }
            if ((!in_array($extension, $acceptable)) || (empty($_FILES["pdf_file"]["type"]))) {
                $_SESSION['error'] .= '<li>Invalid file type. Only Pdf types are accepted.</li>';
            }
        }

        if (isset($_FILES['video_file']) && !empty($_FILES['video_file']['size'])) {

            $maxsize = 5107200;
            $acceptable = array(
                'mp4',
                '3gp',
                'avi'
            );
            $extension = explode(".", $_FILES['video_file']["name"]);
            $extension = strtolower(end($extension));
            if (($_FILES['video_file']['size'] >= $maxsize) || ($_FILES["video_file"]["size"] == 0)) {
                $_SESSION['error'] .= '<li>File too large. File must be less than 5 MB.</li>';
            }
            if ((!in_array($extension, $acceptable)) || (empty($_FILES["video_file"]["type"]))) {
                $_SESSION['error'] .= '<li>Invalid Video file type. Only mp4 and 3gp , avi types are accepted.</li>';
            }
        }
        if (isset($_FILES['dp_image']) && !empty($_FILES['dp_image']['size'])) {
            $maxsize = 2507200;
            $acceptable = array(
                'jpeg',
                'jpg',
                'png'
            );
            $extension = explode(".", $_FILES['dp_image']["name"]);
            $extension = strtolower(end($extension));
            if (($_FILES['dp_image']['size'] >= $maxsize) || ($_FILES["dp_image"]["size"] == 0)) {
                $_SESSION['error'] .= '<li>File too large. File must be less than 2 MB.</li>';
            }
            if ((!in_array($extension, $acceptable)) || (empty($_FILES["dp_image"]["type"]))) {
                $_SESSION['error'] .= '<li>Invalid file type. Dp Image Only JPG and PNG types are accepted.</li>';
            }
        }
        if (empty($_SESSION['error'])) {
            $login_id = $_POST['login_id'];
            $caption = "";

            $header_message = trim($_POST['message_header']);
            $footer_message = trim($_POST['message_footer']);


            $description = trim($_REQUEST['description']);
                
            
            $msg = filter_var($description, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);


            $link = (isset($_POST['ctabtn1']) ? $_POST['ctabtn1'] : "");
            $phone = (isset($_POST['ctabtn2']) ? $_POST['ctabtn2'] : "");



            // $phone= filter_var($ctabtn1, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            // $link = filter_var($ctabtn2, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);


            $number_count = addslashes(trim($_POST['numbercount']));
            $mobile_no = explode("\n", $_POST['mobileno']);
            $unique_id = $_SESSION['user_unique_id'];
            $pimagename1 = "";
            $pimagename2 = "";
            $pimagename3 = "";
            $pimagename4 = "";
            $dp_image = "";
            $pdf_f = "";
            $audio_f = "";
            $video_f = "";
            
            $camp_unique_id = "CP-" . rand(11111111, 99999999);

            
            if (isset($_FILES['photo-1']) && !empty($_FILES['photo-1']['size'])) {
                $photo1 = $_FILES['photo-1'];
                $target = "admin/img/upload";
                $pimagename1 = uploadPhoto($photo1, $target);
            }

            if (isset($_FILES['dp_image']) && !empty($_FILES['dp_image']['size'])) {
                $dp_img = $_FILES['dp_image'];
                $target = "admin/img/upload";
                $dp_image = uploadPhoto($dp_img, $target);
            }
            if (isset($_FILES['pdf_file']) && !empty($_FILES['pdf_file']['size'])) {
                $pdf_file = $_FILES['pdf_file'];
                $target = "admin/img/upload/pdf";
                $pdf_f = uploadPdf($pdf_file, $target);
            }

            if (isset($_FILES['video_file']) && !empty($_FILES['video_file']['size'])) {
                $video_file = $_FILES['video_file'];
                $target = "admin/img/upload/video";
                $video_f = uploadVideo($video_file, $target);
            }
            $created_date = date("Y-m-d H:i:s");
            $sort_date = date("Y-m-d");

            $conn1 = new mysqli($servername, $username, $password, $dbname);
            if ($conn1->connect_error) {
                die("Connection failed: " . $conn1->connect_error);
            }
            $stmt1 = $conn1->prepare("SELECT count(login_id) FROM `send_wp_msgs` WHERE `login_id` = ? and `sort_date_wise` = ?");
            $stmt1->bind_param("is", $login_id, $sort_date);
            $stmt1->execute();
            $stmt1->bind_result($today_total_cam_count);
            $stmt1->fetch();
            $conn1->close();

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $mob = count($mobile_no);
            if ($credit >= $mob) {
                // New API Code Added start section

                $tempmob = implode(",",$mobile_no);
                $nums =  str_replace("\r","",$tempmob);


                if($mob <=10)
                {
                    $status = 'pending';
                    $path = "";
                    $pathv = "";
                    $pathp = "";
                    if(strlen($pimagename1) > 1 ) {
                        $imgurl = "https://".$_SERVER['HTTP_HOST'] . "/admin/img/upload/" . $pimagename1;
                        $path = $path . "&img1=" . $imgurl;
                    }

                    if(strlen($video_f) > 1 ){
                        $imgurlv = "https://".$_SERVER['HTTP_HOST'] . "/admin/img/upload/video/" . $video_f;
                        $pathv = $pathv."&vid1=".$imgurlv;
                    }
                    if(strlen($pdf_f) > 1 ){
                        $imgurlp = "https://".$_SERVER['HTTP_HOST'] . "/admin/img/upload/pdf/" . $pdf_f;
                        $pathp = $pathp."&pdf=".$imgurlp;
                    }


                    foreach(explode(",",$nums) as $tempnum){

                        if(1){

                            // $curl = curl_init();

                            // curl_setopt_array($curl, [
                            // CURLOPT_URL => "https://api.wali.chat/v1/messages",
                            // CURLOPT_RETURNTRANSFER => true,
                            // CURLOPT_ENCODING => "",
                            // CURLOPT_MAXREDIRS => 10,
                            // CURLOPT_TIMEOUT => 30,
                            // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            // CURLOPT_CUSTOMREQUEST => "POST",
                            // CURLOPT_POSTFIELDS => "{\"phone\":\"+$tempnum\",\"message\":\"$msg\"}",
                            // CURLOPT_HTTPHEADER => [
                            //     "Content-Type: application/json",
                            //     "Token: 0fec55e9da5b2c3b56d6b122d0243bb28f9aedd71d7f912046e3b7ad8aac6a984f31fd68c3081a9c"
                            // ],
                            // ]);

                            // $response = curl_exec($curl);
                            // $err = curl_error($curl);

                            // curl_close($curl);

                            // if ($err) {
                            // echo "cURL Error #:" . $err;
                            // } else {
                            // echo $response;
                            // }



                            





                            // $curl = curl_init();

                            // curl_setopt_array($curl, [
                            // CURLOPT_URL => "https://api.wali.chat/v1/files",
                            // CURLOPT_RETURNTRANSFER => true,
                            // CURLOPT_ENCODING => "",
                            // CURLOPT_MAXREDIRS => 10,
                            // CURLOPT_TIMEOUT => 30,
                            // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            // CURLOPT_CUSTOMREQUEST => "POST",
                            // CURLOPT_POSTFIELDS => "{\"url\":\"https://file-examples-com.github.io/uploads/2017/10/file_example_JPG_100kB.jpg\",\"expiration\":\"1d\",\"filename\":\"custom-filename.jpg\",\"reference\":\"Optional reference ID\"}",
                            // CURLOPT_HTTPHEADER => [
                            //     "Content-Type: application/json",
                            //     "Token: 0fec55e9da5b2c3b56d6b122d0243bb28f9aedd71d7f912046e3b7ad8aac6a984f31fd68c3081a9c"
                            // ],
                            // ]);

                            // $response = curl_exec($curl);
                            // $err = curl_error($curl);

                            // curl_close($curl);

                            // if ($err) {
                            // echo "cURL Error #:" . $err;
                            // } else {
                            // echo $response;
                            // }











            


                            // $curl = curl_init();
                     
                            // curl_setopt_array($curl, [
                            // CURLOPT_URL => "https://api.wali.chat/v1/messages",
                            // CURLOPT_RETURNTRANSFER => true,
                            // CURLOPT_ENCODING => "",
                            // CURLOPT_MAXREDIRS => 10,
                            // CURLOPT_TIMEOUT => 30,
                            // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            // CURLOPT_CUSTOMREQUEST => "POST",
                            // CURLOPT_POSTFIELDS => "{\"phone\":\"+$tempnum\",\"message\":\"$msg\",\"header\":\"$header_message\",\"footer\":\"$footer_message\",\"buttons\":[{\"id\":\"id1\",\"kind\":\"call\",\"text\":\"Call Now\",\"value\":\"+$phone\"},{\"id\":\"id2\",\"kind\":\"url\",\"text\":\"Visit Now\",\"value\":\"$link\"},{\"id\":\"id3\",\"text\":\"help you\"}]}",
                            // CURLOPT_HTTPHEADER => [
                            //     "Content-Type: application/json",
                            //     "Token: 0fec55e9da5b2c3b56d6b122d0243bb28f9aedd71d7f912046e3b7ad8aac6a984f31fd68c3081a9c"
                            // ],
                            // ]);

                            // $response = curl_exec($curl);
                            // $err = curl_error($curl);

                            // curl_close($curl);

                            // if ($err) {
                            // echo "cURL Error #:" . $err;
                            // } else {
                            // echo $response;
                            // }



                        }

                        // Send Button Message
                        // $curl = curl_init();

                        // curl_setopt_array($curl, [
                        // CURLOPT_URL => "https://api.wali.chat/v1/messages",
                        // CURLOPT_RETURNTRANSFER => true,
                        // CURLOPT_ENCODING => "",
                        // CURLOPT_MAXREDIRS => 10,
                        // CURLOPT_TIMEOUT => 30,
                        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        // CURLOPT_CUSTOMREQUEST => "POST",
                        // CURLOPT_POSTFIELDS => "{\"phone\":\"+$tempnum\",\"message\":\"$msg\",\"header\":\"$header_message\",\"footer\":\"$footer_message\",\"buttons\":[{\"id\":\"id1\",\"kind\":\"call\",\"text\":\"Call Now\",\"value\":\"+918788405045\"},{\"id\":\"id2\",\"kind\":\"url\",\"text\":\"Visit Now\",\"value\":\"https://google.com\"},{\"id\":\"id3\",\"text\":\"help you\"}]}",
                        // CURLOPT_HTTPHEADER => [
                        //     "Content-Type: application/json",
                        //     "Token: 0fec55e9da5b2c3b56d6b122d0243bb28f9aedd71d7f912046e3b7ad8aac6a984f31fd68c3081a9c"
                        // ],
                        // ]);
                    
                    }
                    

                //     $stmt = $conn->prepare("INSERT INTO `send_wp_msgs`(login_id,`campaign_unique_id`,`campaign_name`, `message`, `number_count`, `image-1`, `image-2`, `image-3`, `image-4`, `upload_pdf`, `send_audio`, `send_video`, `dp_image`,`repybtn1`,`repybtn2`,`ctabtn1`,`ctabtn2`, `status`, `updated_at`,`created_at`,`sort_date_wise`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                //     $stmt->bind_param("isssissssssssssssssss", $login_id, $camp_unique_id, $caption, nl2br($_POST['description']), $number_count, $pimagename1, $pimagename2, $pimagename3, $pimagename4, $pdf_f, $audio_f, $video_f, $dp_image, $rplybtn1, $rplybtn2, $ctabtn1, $ctabtn2, $status, $created_date,$created_date, $sort_date);
                //     if ($stmt->execute()) {
                //         $wp_insert_id = $stmt->insert_id;

                //         $conn = new mysqli($servername, $username, $password, $dbname);
                //         if ($conn->connect_error) {
                //             die("Connection failed: " . $conn->connect_error);
                //         }
                //         $stmt = $conn->prepare("INSERT INTO `wp_mobile_listings`(`mobile_no`, status, `send_wp_msgs_id`, `created_at`, `sort_date`) VALUES (?,?,?,?,?)");
                //         // echo count($component_name_array);
                //         for ($i = 0; $i < count($mobile_no); $i++) {
                //             $mobile_number = $mobile_no[$i];
                //             $stmt->bind_param("ssiss", $mobile_number, $status, $wp_insert_id, $created_date, $sort_date);
                //             $stmt->execute();

                //             $conn1 = new mysqli($servername, $username, $password, $dbname);
                //             if ($conn1->connect_error) {
                //                 die("Connection failed: " . $conn1->connect_error);
                //             }
                //             $stmt1 = $conn1->prepare("update logins set credit = credit - 1 where logins.user_unique_id =? ");
                //             $stmt1->bind_param("s", $unique_id);
                //             $stmt1->execute();
                //             $conn1->close();
                //         }
                //         $conn->close();
                //         $_SESSION['hc_id'] = $wp_insert_id;
                //         $_SESSION['success'] = " Campaign Sent Sucessfully!";

                //     }
                //     $conn->close();

                //     unset($_SESSION['error']);
                //     header("Location: sendwhatsapp.php");
                //     exit();

                //   // End Section Of API

                }else{
                    if($today_total_cam_count < 500) {
                        $stmt = $conn->prepare("INSERT INTO `send_wp_msgs`(login_id,`campaign_unique_id`,`campaign_name`, `message`, `number_count`, `image-1`, `image-2`, `image-3`, `image-4`, `upload_pdf`, `send_audio`, `send_video`, `dp_image`, `repybtn1`,`repybtn2`,`ctabtn1`,`ctabtn2`,`updated_at`,`created_at`,`sort_date_wise`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                        $stmt->bind_param("isssisssssssssssssss", $login_id, $camp_unique_id, $caption, nl2br($_POST['description']), $number_count, $pimagename1, $pimagename2, $pimagename3, $pimagename4, $pdf_f, $audio_f, $video_f, $dp_image,$rplybtn1, $rplybtn2, $ctabtn1, $ctabtn2, $created_date, $created_date, $sort_date);
                        if ($stmt->execute()) {
                            $wp_insert_id = $stmt->insert_id;

                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $stmt = $conn->prepare("INSERT INTO `wp_mobile_listings`(`mobile_no`, `send_wp_msgs_id`, `created_at`, `sort_date`) VALUES (?,?,?,?)");
                            // echo count($component_name_array);
                            for ($i = 0; $i < count($mobile_no); $i++) {
                                $mobile_number = $mobile_no[$i];
                                $stmt->bind_param("siss", $mobile_number, $wp_insert_id, $created_date, $sort_date);
                                $stmt->execute();

                                $conn1 = new mysqli($servername, $username, $password, $dbname);
                                if ($conn1->connect_error) {
                                    die("Connection failed: " . $conn1->connect_error);
                                }
                                $stmt1 = $conn1->prepare("update logins set credit = credit - 1 where logins.user_unique_id =? ");
                                $stmt1->bind_param("s", $unique_id);
                                $stmt1->execute();
                                $conn1->close();
                            }
                            $conn->close();
                            $_SESSION['hc_id'] = $wp_insert_id;
                            $_SESSION['success'] = " Submitted Successfully!";

                        }
                        //$conn->close();

                        unset($_SESSION['error']);
                        header("Location: sendwhatsapp.php");
                        exit();
                    }else{
                        $_SESSION['error'] = "you are exceeded the limit of 5 campaigns in a day";
                        header("Location: sendwhatsapp.php");
                        exit();
                    }
                }
            }
            $_SESSION['error'] = "Insufficient Balance.";
            header("Location: sendwhatsapp.php");
            exit();

        } else {
            header("Location: sendwhatsapp.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Insufficient Fund.";
        header("Location: sendwhatsapp.php");
        exit();
    }
}
?>
