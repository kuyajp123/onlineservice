<?php
session_start();
require_once '../include/connect.php';
require_once '../functions/common_function.php';

// Debugging output
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Handle comment insertion
if (isset($_POST['submit_comment'])) {
    $post_id = $_POST['post_id'];
    $comment = $_POST['send_comment'];
    $loggedInUserNo = $_SESSION['user_no'];

    if (!empty($comment)) {
        $sql = "INSERT INTO comments (post_id, user_no, comment_text) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($con->error));
        }

        $stmt->bind_param("iis", $post_id, $loggedInUserNo, $comment);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error: " . htmlspecialchars($stmt->error);
        }
    } else {
        echo "comment cannot be empty";
    }
    exit;
}

// Fetch comments for the post
if (isset($_POST['post_id']) && !isset($_POST['submit_comment'])) {
    $post_id = $_POST['post_id'];

    $sql = "SELECT c.comment_id, c.comment_text, c.timestamp, u.fname, u.lname
            FROM comments c
            JOIN user_registration u ON c.user_no = u.user_no
            WHERE c.post_id = ?
            ORDER BY c.timestamp ASC";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='container-fluid usercomments'>
                    <div class='container-fluid lgyan'>
                        <div class='container-fluid prof_pic' style='display: flex; align-items: center; justify-content: flex-start; width:auto;'>
                            <div>
                                <a href='#' style='font-size:1rem; text-decoration: none; color: black;'>
                                    <img src='users/images/profilepicture/default.png' style='object-fit:contain; width: 40px; height: 40px; border-radius: 50%;' alt=''>
                                </a>
                            </div>
                        </div>
                        <div class='container-fluid pangalan' style='justify-content:flex-start; padding:0;'>
                            <div style='margin-left:5px'>
                                <a href='#' style='font-size:1rem; text-decoration: none; color: black;'>
                                    <span class='pangalantextpost'>" . htmlspecialchars($row['fname'] . ' ' . $row['lname']) . "</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class='container-fluid commenttext'>
                        <figure>
                            <figcaption>" . htmlspecialchars($row['comment_text']) . "</figcaption>
                        </figure>
                    </div>
                </div>";
        }
    } else {
        echo "<p>No comments yet.</p>";
    }
} else {
    echo "Invalid request.";
}
?>
<!-- Comment form -->
<form action="" method="post">
    <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">
    <div class="container-fluid writecomments">
        <input class="form-control inputcomments" name="send_comment" placeholder="Write a comment..." required>
        <button type="submit" name="submit_comment" class="btn btn-outline-primary" id="sendbtncomments">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>
</form>
<div class="line"></div>
<!-- Display comments -->
<div class="container-fluid comments" id="modal-comment-content">
    <!-- Comments will be dynamically loaded here -->
</div>