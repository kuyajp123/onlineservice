<?php
session_start();
require_once '../../include/connect.php';
require_once '../../functions/common_function.php'; 

header('Content-Type: application/json');

// Handle comment insertion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $poll_id = isset($_POST['poll_id']) ? intval($_POST['poll_id']) : 0;
    $comment = isset($_POST['send_comment']) ? trim($_POST['send_comment']) : '';
    $loggedInUserNo = isset($_SESSION['user_no']) ? intval($_SESSION['user_no']) : 0;

    if ($poll_id && $loggedInUserNo) {
        if (!empty($comment)) {
            $sql = "INSERT INTO comments (poll_id, user_no, comment_text) VALUES (?, ?, ?)";
            $stmt = $con->prepare($sql);

            if ($stmt === false) {
                $response['message'] = 'Prepare failed: ' . htmlspecialchars($con->error);
                echo json_encode($response);
                exit;
            }

            $stmt->bind_param("iis", $poll_id, $loggedInUserNo, $comment);

            if ($stmt->execute()) {
                $response['status'] = 'success';
                // Fetch updated comments
                $comments_query = $con->prepare("SELECT * FROM comments WHERE poll_id = ?");
                $comments_query->bind_param("i", $poll_id);
                $comments_query->execute();
                $comments = $comments_query->get_result();
                
                $comments_html = '';
                while ($row = $comments->fetch_assoc()) {
                    $comments_html .= '<div class="comment">' . htmlspecialchars($row['comment_text']) . '</div>';
                }

                $response['comments'] = $comments_html;
            } else {
                $response['message'] = 'Execute failed: ' . htmlspecialchars($stmt->error);
            }
        }
    } else {
        $response['message'] = 'Invalid poll_id or user_no.';
    }
}
?>

<div class="container-fluid formcommentdiv">
          <form action="" method="post">
              <input type="hidden" name="poll_id" value="<?php echo htmlspecialchars($poll_id); ?>">
              <div class="container-fluid writecomments">
                  <input class="form-control inputcomments" name="send_comment" placeholder="Write a comment..." required>
                  <button type="submit" name="submit_comment" class="btn btn-outline-primary" id="sendbtncomments">
                      <i class="fa-solid fa-paper-plane"></i>
                  </button>
              </div>
          </form>
          </div>