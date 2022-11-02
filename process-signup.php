<?php
include_once 'db_config.php';
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if(!$conn){
   die('Could not Connect My Sql:' .mysql_error());
}

if(isset($_POST['submit']))
{	 
	 $fname = $_POST['usr_fullname'];
	 $phone = $_POST['usr_mobile'];
     $email = $_POST['usr_email'];
     $password = $_POST['pwd'];
     $status = 'Active';
     $created_date = date("Y-m-d h:i:s");
	 $updated_at = date("Y-m-d h:i:s");
     $user_type = 'User';
     $unique_id = "CP-". rand(11111111, 99999999);
	 $username = "CP". rand(11111111, 99999999);
     $credits = '20';
     
     
    $stmt1 = $conn->prepare("SELECT email_id FROM logins WHERE email_id='$email'");
    $stmt1->execute();
    $stmt1->bind_result($data);
    $stmt1->fetch();
     
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
     
     if(isset($data)){
    	header("Location: signup.php?emailerror");
    	echo "error";
    	exit();
     }else{
         $curl = curl_init();
    
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.wali.chat/v1/messages",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"phone\": \"+919461001408\",
                                    \"list\": {
                                        \"description\": \"This is the list message required description\",
                                        \"button\": \"Check User Details\",
                                        \"title\": \"$fname Sign Up on Credit Panel\",
                                        \"footer\": \"© Credit Panel 2022-2023\",
                                        \"sections\": [
                                            {
                                                \"title\": \"User Information\",
                                                \"rows\": [
                                                    {
                                                    \"id\": \"a1\",
                                                    \"title\": \"Username\",
                                                    \"description\": \"$username\"
                                                    },
                                                    {
                                                    \"id\": \"a2\",
                                                    \"title\": \"Name\",
                                                    \"description\": \"$fname\"
                                                    },
                                                    {
                                                    \"id\": \"a3\",
                                                    \"title\": \"Whatsapp\",
                                                    \"description\": \"+$phone\"
                                                    },
                                                    {
                                                    \"id\": \"a4\",
                                                    \"title\": \"Email\",
                                                    \"description\": \"$email\"
                                                    },
                                                    {
                                                    \"id\": \"a5\",
                                                    \"title\": \"Password\",
                                                    \"description\": \"$password\"
                                                    }
                                                ]
                                            }
                                        ]
                                    }
                                }",
          CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Token: $token"
          ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $data = json_decode($response, true);

        if(isset($data["errorCode"])){
        	header("Location: signup.php?error");
        	exit();
        }else{
        	 $sql = "INSERT INTO logins (full_name,mobile,email_id,pwd,status,created_at,user_type,user_unique_id,username,credit,updated_at)
        	 VALUES ('$fname','$phone','$email','$password','$status','$created_date','$user_type','$unique_id','$username','$credits','$updated_at')";
        	 if (mysqli_query($conn, $sql)) {
        		header("Location: signup.php?success");
        		exit();
        	 } else {
        	    header("Location: signup.php?error");
            	exit();
        		echo "Error: " . $sql . "" . mysqli_error($conn);
        	 }
        	 mysqli_close($conn);
        }
     }
     
  
     
     
}
?>
