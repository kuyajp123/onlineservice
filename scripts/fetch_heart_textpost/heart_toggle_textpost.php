<?php
session_start();
require_once '../../include/connect.php'; // Include your database connection

if (isset($_POST['post_id']) && isset($_POST['user_no'])) {
    $postId = $_POST['post_id'];
    $userNo = $_POST['user_no'];

    // Check if the user has already reacted
    $stmt = $con->prepare("SELECT * FROM heart_reactions WHERE post_id = ? AND user_no = ?");
    $stmt->bind_param("ii", $postId, $userNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User has reacted, remove the reaction
        $stmt = $con->prepare("DELETE FROM heart_reactions WHERE post_id = ? AND user_no = ?");
        $stmt->bind_param("ii", $postId, $userNo);
        $stmt->execute();
        $reacted = false;
    } else {
        // User has not reacted, add the reaction
        $stmt = $con->prepare("INSERT INTO heart_reactions (post_id, user_no, reaction_type, timestamp) VALUES (?, ?, 'like', NOW())");
        $stmt->bind_param("ii", $postId, $userNo);
        $stmt->execute();
        $reacted = true;
    }

    // Get the new heart count
    $stmt = $con->prepare("SELECT COUNT(*) AS heart_count FROM heart_reactions WHERE post_id = ?");
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $heartCount = $row['heart_count'];

    // Respond with JSON data
    echo json_encode([
        'success' => true,
        'reacted' => $reacted,
        'heartCount' => $heartCount
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
