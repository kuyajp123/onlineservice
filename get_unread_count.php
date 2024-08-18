<?php
session_start();
require_once 'include/connect.php';

$current_user_no = $_SESSION['user_no'];

$query = "SELECT COUNT(*) AS unread_count FROM notifications WHERE user_no = ? AND is_opened = 0";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $current_user_no);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$unread_count = $row['unread_count'];

header('Content-Type: application/json');
echo json_encode(['unread_count' => $unread_count]);
?>
