<?php
// require_once '../include/connect.php';
// require_once '../functions/common_function.php';

// if (!isset($_SESSION['user_no'])) {
//     echo json_encode(['success' => false, 'message' => 'User not logged in']);
//     exit();
// }

// $follower_id = $_SESSION['user_no'];
// $followed_id = isset($_POST['followed_id']) ? (int)$_POST['followed_id'] : null;
// $action = isset($_POST['action']) ? $_POST['action'] : null;

// if ($followed_id === null || $action === null) {
//     echo json_encode(['success' => false, 'message' => 'Invalid input']);
//     exit();
// }

// $action = strtolower($action);

// if ($action === 'follow') {
//     $query = "INSERT INTO follows (follower_id, followed_id) VALUES (?, ?)";
// } elseif ($action === 'unfollow') {
//     $query = "DELETE FROM follows WHERE follower_id = ? AND followed_id = ?";
// } else {
//     echo json_encode(['success' => false, 'message' => 'Invalid action']);
//     exit();
// }

// $stmt = $con->prepare($query);
// if ($action === 'follow' || $action === 'unfollow') {
//     $stmt->bind_param('ii', $follower_id, $followed_id);
// }

// if ($stmt->execute()) {
//     echo json_encode(['success' => true, 'action' => $action]);
// } else {
//     echo json_encode(['success' => false, 'message' => 'Database error']);
// }
// $stmt->close();
// $con->close();
?>
