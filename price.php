<?php 
    session_start();
    require_once 'db_config.php';

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn2 = new mysqli($servername, $username, $password, $dbname);
    if ($conn2->connect_error) {
        die("Connection failed: " . $conn2->connect_error);
    }
    $unique_id = $_SESSION['user_unique_id'];
    $stmt2 = $conn2->prepare("Select credit from logins where logins.user_unique_id =? ");
    $stmt2->bind_param("s", $unique_id);
    $stmt2->execute();
    $stmt2->bind_result($credits);
    $stmt2->fetch();


    if(isset($_REQUEST['email']) && isset($_REQUEST['total']) && isset($_REQUEST['credit'])){
    
    $email = $_REQUEST['email'];
    $total = $_REQUEST['total'];
    $credit = $_REQUEST['credit'];    
    $created_date = date("Y-m-d h:i:s");
    $updated_at = date("Y-m-d h:i:s");
     

	$stmt1 = $conn->prepare("SELECT email_id FROM prices WHERE email_id='$email'");
    $stmt1->execute();
    $stmt1->bind_result($data);
    $stmt1->fetch();
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT user_unique_id, full_name, username, email_id, mobile FROM logins WHERE email_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_unique_id, $full_name, $user, $email_id, $mobile);
    $stmt->fetch();


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
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.wali.chat/v1/messages",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"phone\": \"+918788405045\",
                                    \"list\": {
                                        \"description\": \"This is the list message required description\",
                                        \"button\": \"Check User Details\",
                                        \"title\": \"$full_name ($user) Add Credits and Money\",
                                        \"footer\": \"© Credit Panel 2022-2023\",
                                        \"sections\": [
                                            {
                                                \"title\": \"User Information\",
                                                \"rows\": [
                                                    {
                                                    \"id\": \"a1\",
                                                    \"title\": \"Username\",
                                                    \"description\": \"$user\"
                                                    },
                                                    {
                                                    \"id\": \"a2\",
                                                    \"title\": \"Name\",
                                                    \"description\": \"$full_name\"
                                                    },
                                                    {
                                                    \"id\": \"a3\",
                                                    \"title\": \"Whatsapp\",
                                                    \"description\": \"+$mobile\"
                                                    },
                                                    {
                                                    \"id\": \"a4\",
                                                    \"title\": \"Email\",
                                                    \"description\": \"$email_id\"
                                                    },
                                                    {
                                                    \"id\": \"a5\",
                                                    \"title\": \"Add Credit\",
                                                    \"description\": \"$credit\"
                                                    },
                                                    {
                                                    \"id\": \"a6\",
                                                    \"title\": \"Add Money\",
                                                    \"description\": \"$total\"
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
           echo "info" ;
        }else{


              $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $status = false;
            $per_sms_price = "18";
            $tax_status = "Yes";
            $description = "Add Credits";
            $txn_type = "Add Credits";
            $total_amount = $credit * $per_sms_price;
            
            $total_amt = $credit * $per_sms_price;
            $tax_amount = ($total_amount * 18) / 100;
            $total_amount = $total_amt + $tax_amount;

            $stmt = $conn->prepare("INSERT INTO transaction_logs(`credit`, `status`, `per_sms_price`,`old_credit`, `tax_status`, `tax_percentage`, `tax_amount`, `total_amount`, `description`, `login_user_unique_id`, `user_unique_id`, `txn_type`, `created_at`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("dddsiddsssss", $credit, $status, $per_sms_price, $credits, $tax_status, $per_sms_price, $tax_amount, $total_amount, $description, $unique_id, $unique_id, $txn_type, $created_date);
            if ($stmt->execute()) {
                if($status == true){
                     $sql = "UPDATE prices SET credit=credit+'$credit', price=price+'$total', updated_at='$updated_at' WHERE email_id = '$email'";
                    
                     if (mysqli_query($conn, $sql)) {
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                         $sql = "UPDATE logins SET credit=credit+'$credit', updated_at='$updated_at' WHERE email_id = '$email'";
                        if (mysqli_query($conn, $sql)) {
                           echo "success"; 
                        }else{
                            echo "Error"; 
                        }
                	} else {
                		 echo "Error";
                	}   
                }else{
                    echo "pending";
                }
           
            }else{
                echo "Error";
            }
        }

     }else{

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.wali.chat/v1/messages",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\"phone\": \"+918788405045\",
                                    \"list\": {
                                        \"description\": \"This is the list message required description\",
                                        \"button\": \"Check User Details\",
                                        \"title\": \"$full_name ($user) Purchase Credit and Money\",
                                        \"footer\": \"© Credit Panel 2022-2023\",
                                        \"sections\": [
                                            {
                                                \"title\": \"User Information\",
                                                \"rows\": [
                                                    {
                                                    \"id\": \"a1\",
                                                    \"title\": \"Username\",
                                                    \"description\": \"$user\"
                                                    },
                                                    {
                                                    \"id\": \"a2\",
                                                    \"title\": \"Name\",
                                                    \"description\": \"$full_name\"
                                                    },
                                                    {
                                                    \"id\": \"a3\",
                                                    \"title\": \"Whatsapp\",
                                                    \"description\": \"+$mobile\"
                                                    },
                                                    {
                                                    \"id\": \"a4\",
                                                    \"title\": \"Email\",
                                                    \"description\": \"$email_id\"
                                                    },
                                                    {
                                                    \"id\": \"a5\",
                                                    \"title\": \"Add Credit\",
                                                    \"description\": \"$credit\"
                                                    },
                                                    {
                                                    \"id\": \"a6\",
                                                    \"title\": \"Add Money\",
                                                    \"description\": \"$total\"
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
           echo "info" ;
        }else{
            

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $per_sms_price = "18";
            $tax_status = "Yes";
            $description = "Add Credits";
            $txn_type = "Add Credits";
            $total_amount = $credit * $per_sms_price;
            
            $total_amt = $credit * $per_sms_price;
            $tax_amount = ($total_amount * 18) / 100;
            $total_amount = $total_amt + $tax_amount;

            $stmt = $conn->prepare("INSERT INTO transaction_logs(`credit`, `per_sms_price`,`old_credit`, `tax_status`, `tax_percentage`, `tax_amount`, `total_amount`, `description`, `login_user_unique_id`, `user_unique_id`, `txn_type`, `created_at`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("dddsiddsssss", $credit, $per_sms_price, $credits, $tax_status, $per_sms_price, $tax_amount, $total_amount, $description, $unique_id, $unique_id, $txn_type, $created_date);
            if ($stmt->execute()) {
               
                $sql = "INSERT INTO prices (user_unique_id, full_name, username, email_id, mobile, credit, price, created_at, updated_at) VALUES ('$user_unique_id', '$full_name', '$user', '$email_id', '$mobile', '$credit', '$total', '$created_date', '$updated_at')";
                if (mysqli_query($conn, $sql)) {
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                     $sql = "UPDATE logins SET credit=credit+'$credit', updated_at='$updated_at' WHERE email_id = '$email'";
                    if (mysqli_query($conn, $sql)) {
                      echo "success"; 
                    }else{
                        echo "Error"; 
                    }
      	    
            	} else {
            		 echo "Error" ;
            	}  
            	mysqli_close($conn);
                    
                }else{
                    echo "error";
                }
    
        }
    }
     
}


?>