<?php
if (isset($_POST["submit_comment"])) {
  $comment = $_POST["send_comment"];
  $post_id = $_POST['post_id'];

  if (!empty($comment)) {
      // Use the correct table name within the schema
      $sql = "INSERT INTO posts_management.comments (post_id, user_no, comment_text) VALUES (?, ?, ?)";
      $stmt = $con->prepare($sql);
      $stmt->bind_param("iis", $post_id, $loggedInUserNo, $comment);
      
      if ($stmt->execute()) {
          echo "success";
      } else {
          $error = "error";
          echo "$error";
      }
  }else{
      $error = "comment cannot be empty";
          echo "$error";
  }
}

?>