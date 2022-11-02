<?php
header('Content-Type: application/json');
date_default_timezone_set("Asia/kolkata");
$now = date('Y-m-d H:i:s');

function gettime($now,$end)
{
    $d1 = new DateTime($now);
    $d2 = new DateTime($end);
    $interval = $d1->diff($d2);
    $diffInSeconds = $interval->s; //45
    $diffInMinutes = $interval->i; //23
    $diffInHours   = $interval->h; //8
    $diffInDays    = $interval->d; //21
    $diffInMonths  = $interval->m; //4
    $diffInYears   = $interval->y; //1

    return $diffInHours ."h". $diffInMinutes."m".$diffInSeconds."s";
}

include_once 'db_config.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT
                                                send_wp_msgs.id,
                                                `campaign_name`,
                                                `message`,
                                                `number_count`,
                                                send_wp_msgs.status,
                                                send_wp_msgs.created_at,
                                                logins.username,
                                                logins.user_type
                                            FROM
                                                `send_wp_msgs`
                                            LEFT JOIN logins ON logins.id = send_wp_msgs.login_id
                                            ORDER BY
                                               send_wp_msgs.id
                                            DESC";
$stmt = $conn->prepare($sql);
if ($stmt->execute()) {
    $stmt->bind_result($campaign_id, $campaign_name, $message, $number_count, $status, $created_at, $login_created_by, $login_user_type);
    $inc = 1;
    while ($stmt->fetch()) {

        $time_to_expire = date('Y-m-d H:i:s',strtotime("+4 hour",strtotime($created_at)));

        $time = gettime($now,$time_to_expire);
        if($now >= $time_to_expire){
//            $time = "0h 0m 0s";
            $time = "4 hours expired";
        }
        $response[] = array("id"=>$inc,"time1"=>$time);
        $inc++;
    }

}
echo json_encode($response);
