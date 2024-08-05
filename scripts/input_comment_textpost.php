<?php
session_start();
require_once '../include/connect.php';
require_once '../functions/common_function.php';

// Handle comment insertion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null;
    $comment = isset($_POST['send_comment']) ? $_POST['send_comment'] : '';
    $loggedInUserNo = isset($_SESSION['user_no']) ? $_SESSION['user_no'] : null;

    if ($post_id && $loggedInUserNo) {
        if (!empty($comment)) {
            $sql = "INSERT INTO comments (post_id, user_no, comment_text) VALUES (?, ?, ?)";
            $stmt = $con->prepare($sql);

            if ($stmt === false) {
                error_log('Prepare failed: ' . htmlspecialchars($con->error));
                echo "Prepare failed: " . htmlspecialchars($con->error);
                exit;
            }

            $stmt->bind_param("iis", $post_id, $loggedInUserNo, $comment);

            if ($stmt->execute()) {
                echo "success";
            } else {
                error_log('Execute failed: ' . htmlspecialchars($stmt->error));
                echo "Execute failed: " . htmlspecialchars($stmt->error);
            }
        }
    } else {
        echo "Invalid post_id or user_no.";
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
