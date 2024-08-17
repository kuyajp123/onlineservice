<?php
include("../include/connect.php");
global $con;

$sql = "SELECT * FROM notifications WHERE user_no = 49 ORDER BY timestamp DESC";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();



echo $row['notification_text'];
?>