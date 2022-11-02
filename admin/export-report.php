<?php
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
if($_SESSION['login_type'] != 'admin'){
    $_SESSION['login_status']=0;
    header("Location: process_login.php");
    exit();
}
include_once 'db_config.php';

$fromdate = "dfs";
$todate = "fdg";

$current_date = date("d-m-Y");

$wp_unique_id = $_GET['unique_id'];
$user_name = $_GET['username'];
//echo $fromdate;
//First we'll generate an output variable called out. It'll have all of our text for the CSV file.
$out = '';
$csv_output = '';
$csv_hdr = '';

$csv_hdr .= "Id,Unique Id,Username,MobileNo,Status,Created At";
//$csv_hdr .= "\n\n Id,Date,Time";

$out .= $csv_hdr;
//$out .= "\n\n";
$out .= "\n";
$data = [];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT
                            wp.mobile_no,
                            wp.status,
                            wp.created_at
                        FROM
                            wp_mobile_listings as wp
                        LEFT JOIN send_wp_msgs AS send_wp ON send_wp.id = wp.send_wp_msgs_id
                        LEFT JOIN logins as lg ON lg.id = send_wp.login_id
                        WHERE
                          send_wp.campaign_unique_id = ? and lg.username = ?");
$stmt->bind_param("ss", $wp_unique_id, $user_name);
$stmt->execute();
$stmt->bind_result($mobile_no, $status, $created_at);
$cnt = 1;
while ($stmt->fetch()) {
//  $data[] = array(
//            "id" => $cnt,
//            'unique_id' => $wp_unique_id,
//            'usrname' => $user_name,
//            'mob' => stripcslashes($mobile_no),
//            'st' => stripcslashes($status),
//            'wp_created_at' => stripcslashes($created_at)
//            );
    $id = $cnt;
    $unique_id = $wp_unique_id;
    $usrname = $user_name;
    $mob = $mobile_no;
    $st = $status;
    $crtd_at = date_format(date_create($created_at),"d-m-Y h:i");
    $csv_output .= $id . "," . $unique_id . "," . $usrname . "," . trim($mob) . "," . trim($st) . "," . $crtd_at;
    $csv_output .= "\n";
    $cnt = $cnt + 1;
}
//for($i=0; $i < count($data); $i++){
//    $csv_output .= $data[$i]['id']. ", " . $data[$i]['unique_id'] . ", " . $data[$i]['usrname'] . ", " . $data[$i]['mob'] . ", " . $data[$i]['st'] . ", " . $data[$i]['wp_created_at'] ;
//    $csv_output .= "\n";
//}

//$csv_output .= $id . ", " . $date . ", " . $time . ", " . $movie . ", " . $name . ", " . $email . ", " . $phone . ", " . $approved;
$out .= $csv_output . "\n\n";

$filename = "$user_name-$wp_unique_id-$current_date";

//Generate the CSV file header

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header("Content-disposition: attachment; filename=" . $filename . ".csv");

//Print the contents of out to the generated file.
//echo "\n                                                               " . " Report of FirstLook Preview";
//echo "                      " . " Mobile No List Based On Unique Id";

print $out;
exit;
?>

