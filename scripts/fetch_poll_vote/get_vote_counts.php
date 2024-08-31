<?php
session_start();
require_once '../../include/connect.php';

// Get poll_id from query parameters
$poll_id = isset($_GET['poll_id']) ? intval($_GET['poll_id']) : 0;

if ($poll_id <= 0) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid poll ID']);
    exit;
}

// Fetch vote counts for each option in the poll
try {
    $vote_counts = [];
    $sql = "SELECT options_id, COUNT(*) as vote_count FROM poll_votes WHERE poll_id = ? GROUP BY options_id";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $poll_id);
    $stmt->execute();
    $stmt->bind_result($option_id, $vote_count);

    while ($stmt->fetch()) {
        $vote_counts[$option_id] = $vote_count;
    }

    $stmt->close();

    // Respond with vote counts
    header('Content-Type: application/json');
    echo json_encode($vote_counts);
} catch (Exception $e) {
    // Handle SQL or connection errors
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
?>
