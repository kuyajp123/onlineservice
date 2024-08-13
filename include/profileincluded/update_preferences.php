<?php
session_start();
require_once '../../include/connect.php'; // Include your database connection file

$user_no = $_SESSION['user_no'];
$hide_birthdate = isset($_POST['hide_birthdate']) ? 1 : 0;
$hide_gender = isset($_POST['hide_gender']) ? 1 : 0;

$sql = "INSERT INTO users_preferences (user_no, hide_birthdate, hide_gender) VALUES (?, ?, ?) 
        ON DUPLICATE KEY UPDATE hide_birthdate = VALUES(hide_birthdate), hide_gender = VALUES(hide_gender)";
$stmt = $con->prepare($sql);
$stmt->bind_param('iii', $user_no, $hide_birthdate, $hide_gender);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

$stmt->close();
$con->close();
?>
