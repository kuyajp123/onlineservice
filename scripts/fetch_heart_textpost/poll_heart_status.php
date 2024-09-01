<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../../include/connect.php'; // Include your database connection

$poll_id = $_POST['poll_id'];
$user_no = $_POST['user_no'];

// Prepare and execute query
$query = "SELECT COUNT(*) AS reacted, (SELECT COUNT(*) FROM heart_reactions WHERE poll_id = ?) AS heartCount FROM heart_reactions WHERE poll_id = ? AND user_no = ?";
$stmt = $con->prepare($query);

if ($stmt) {
    $stmt->bind_param('iii', $poll_id, $poll_id, $user_no);
    $stmt->execute();
    $stmt->bind_result($reacted, $heartCount);
    $stmt->fetch();
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'reacted' => $reacted > 0,
        'heartCount' => $heartCount
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Query failed']);
}
?>
