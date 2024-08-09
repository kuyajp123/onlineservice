<?php
session_start();
require_once '../../include/connect.php'; // Include your database connection

$post_id = $_POST['post_id'];
$user_no = $_POST['user_no'];

// Prepare and execute query
$query = "SELECT COUNT(*) AS reacted, (SELECT COUNT(*) FROM heart_reactions WHERE post_id = ?) AS heartCount FROM heart_reactions WHERE post_id = ? AND user_no = ?";
$stmt = $con->prepare($query);

if ($stmt) {
    $stmt->bind_param('sss', $post_id, $post_id, $user_no);
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