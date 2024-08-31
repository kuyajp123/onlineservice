<?php
session_start();
require_once '../../include/connect.php';

// Get the logged-in user's ID
$loggedInUserNo = $_SESSION['user_no'];

// Get JSON input data
$data = json_decode(file_get_contents('php://input'), true);

// Extract poll_id and selected_option_id from JSON data
$poll_id = isset($data['poll_id']) ? intval($data['poll_id']) : 0;
$selected_option_id = isset($data['selected_option_id']) ? intval($data['selected_option_id']) : 0;

// Check if poll_id and selected_option_id are valid
if ($poll_id <= 0 || $selected_option_id <= 0) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

// Prepare and execute SQL query to save the vote
try {
    // Check if the user has already voted for this poll
    $check_vote_sql = "SELECT COUNT(*) FROM poll_votes WHERE user_no = ? AND poll_id = ?";
    $check_vote_stmt = $con->prepare($check_vote_sql);
    $check_vote_stmt->bind_param("ii", $loggedInUserNo, $poll_id);
    $check_vote_stmt->execute();
    $check_vote_stmt->bind_result($vote_count);
    $check_vote_stmt->fetch();
    $check_vote_stmt->close();

    if ($vote_count > 0) {
        // Update the existing vote
        $update_vote_sql = "UPDATE poll_votes SET options_id = ? WHERE user_no = ? AND poll_id = ?";
        $update_vote_stmt = $con->prepare($update_vote_sql);
        $update_vote_stmt->bind_param("iii", $selected_option_id, $loggedInUserNo, $poll_id);
        $update_vote_stmt->execute();
        $update_vote_stmt->close();
    } else {
        // Insert a new vote
        $insert_vote_sql = "INSERT INTO poll_votes (user_no, poll_id, options_id) VALUES (?, ?, ?)";
        $insert_vote_stmt = $con->prepare($insert_vote_sql);
        $insert_vote_stmt->bind_param("iii", $loggedInUserNo, $poll_id, $selected_option_id);
        $insert_vote_stmt->execute();
        $insert_vote_stmt->close();
    }

    // Respond with success
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Vote saved successfully']);
} catch (Exception $e) {
    // Handle SQL or connection errors
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
?>
