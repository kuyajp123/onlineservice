<?php
session_start();
require_once '../../include/connect.php'; // Go up two directories from fetch_textpost to reach include
require_once '../../functions/common_function.php'; // Go up two directories from

// Fetch comments for the post
if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    $sql = "SELECT c.comment_id, c.comment_text, c.timestamp, u.fname, u.lname, u.profilepicture
            FROM comments c
            JOIN user_registration u ON c.user_no = u.user_no
            WHERE c.post_id = ?
            ORDER BY c.timestamp DESC";
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
                                    <img src='users/images/profilepicture/".htmlspecialchars($row['profilepicture'])."' style='object-fit:contain; width: 40px; height: 40px; border-radius: 50%;' alt=''>
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
<!-- Comment form
<form action="" method="post">
    <input type="hidden" name="post_id" value="<?php //echo htmlspecialchars($post_id); ?>">
    <div class="container-fluid writecomments">
        <input class="form-control inputcomments" name="send_comment" placeholder="Write a comment..." required>
        <button type="submit" name="submit_comment" class="btn btn-outline-primary" id="sendbtncomments">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>
</form> -->