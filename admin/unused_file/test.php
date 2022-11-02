<?php

$csv_hdr .= "\n Id,UniqueId,Username, MobileNo, Status, CreatedAt";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT
send_wp_msgs.campaign_unique_id,
logins.username,
wp_mobile_listings.mobile_no,
wp_mobile_listings.status,
wp_mobile_listings.created_at
FROM
`wp_mobile_listings`
LEFT JOIN send_wp_msgs ON send_wp_msgs.id = wp_mobile_listings.send_wp_msgs_id
LEFT JOIN logins ON logins.id = send_wp_msgs.login_id
WHERE
send_wp_msgs.campaign_unique_id = ? AND logins.username = ?");
$stmt->bind_param("ss", $unique_id, $username);
$stmt->execute();
$stmt->bind_result($unique_id, $u_name, $mobile_no, $status, $created_at);
$cnt = 1;
while ($stmt->fetch()) {
    $id = $cnt;
    $wp_unique_id = $unique_id;
    $usrname = $u_name;
    $mob = $mobile_no;
    $st = $status;
    $crtd_at = $created_at;
    $cnt = $cnt + 1;
    $csv_output .= $id . ", " . $wp_unique_id . ", " . $username . ", " . $mob . ", " . $st . ", " . $crtd_at;
    $csv_output .= "\n";

}