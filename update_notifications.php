<?php
session_start();
require_once 'include/connect.php';

$current_user_no = $_SESSION['user_no']; 

$query = "UPDATE notifications SET is_opened = 1 WHERE user_no = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $current_user_no);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}
?>
