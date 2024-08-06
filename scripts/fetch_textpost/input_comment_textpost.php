<?php
session_start();
require_once '../../include/connect.php';
require_once '../../functions/common_function.php'; 

header('Content-Type: application/json');

// Handle comment insertion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $comment = isset($_POST['send_comment']) ? trim($_POST['send_comment']) : '';
    $loggedInUserNo = isset($_SESSION['user_no']) ? intval($_SESSION['user_no']) : 0;

    if ($post_id && $loggedInUserNo) {
        if (!empty($comment)) {
            $sql = "INSERT INTO comments (post_id, user_no, comment_text) VALUES (?, ?, ?)";
            $stmt = $con->prepare($sql);

            if ($stmt === false) {
                $response['message'] = 'Prepare failed: ' . htmlspecialchars($con->error);
                echo json_encode($response);
                exit;
            }

            $stmt->bind_param("iis", $post_id, $loggedInUserNo, $comment);

            if ($stmt->execute()) {
                $response['status'] = 'success';
                // Fetch updated comments
                $comments_query = $con->prepare("SELECT * FROM comments WHERE post_id = ?");
                $comments_query->bind_param("i", $post_id);
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
        $response['message'] = 'Invalid post_id or user_no.';
    }
}
?>

<div class="container-fluid formcommentdiv">
          <form action="" method="post">
              <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">
              <div class="container-fluid writecomments">
                  <input class="form-control inputcomments" name="send_comment" placeholder="Write a comment..." required>
                  <button type="submit" name="submit_comment" class="btn btn-outline-primary" id="sendbtncomments">
                      <i class="fa-solid fa-paper-plane"></i>
                  </button>
              </div>
          </form>
          </div>