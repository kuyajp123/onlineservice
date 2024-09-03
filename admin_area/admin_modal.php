<?php

$remove_warnpass = '';
$remove_banpass = '';

if(isset($_POST['remove_warn'])){
  $remove_warnpass = $_POST['remove_warnpass'];

  if($remove_warnpass == $admin_password){
    $sql = "DELETE FROM active_warning WHERE user_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_no);
    if( $stmt->execute() ){
      echo '<script>window.open("admin_action.php?user_no=' . htmlspecialchars($user_no) . '", "_self")</script>';
    }else{
      $error = "there was a problem removing warning";
    }
  }else{
    $error = 'password didnt match';
  }
}

if(isset($_POST['remove_ban'])){
  $remove_banpass = $_POST['remove_banpass'];

  if($remove_banpass == $admin_password){
    $sql = "DELETE FROM active_ban WHERE user_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_no);
    if( $stmt->execute() ){
      echo '<script>window.open("admin_action.php?user_no=' . htmlspecialchars($user_no) . '", "_self")</script>';
    }else{
      $error = "there was a problem removing ban";
    }
  }else{
    $error = 'password didnt match';
  }
}

if (isset($_POST['delete_post'])) {
  $delete_banpass = $_POST['delete_banpass'];
  $post_id = $_POST['post_id'];
  $user_no = $_POST['user_no'];
  $admin_id = $_POST['admin_id'];
  $report_id = $_POST['report_id'];

  // Fetch post details for notification
  $postSql = "SELECT postphoto, caption FROM posts WHERE post_id = ?";
  $postStmt = $con->prepare($postSql);
  $postStmt->bind_param("i", $post_id);
  $postStmt->execute();
  $postResult = $postStmt->get_result()->fetch_assoc();

  $postPhoto = $postResult['postphoto'] ? $postResult['postphoto'] : '';
  $postCaption = $postResult['caption'] ?: '';

  if ($delete_banpass == $admin_password) {
      $sql = "UPDATE posts SET deleted_at = NOW() WHERE post_id = ?";
      $stmt = $con->prepare($sql);
      $stmt->bind_param("i", $post_id);
      if ($stmt->execute()) {
          $query = "SELECT pr.report_id, pr.user_no, pr.report_reason, p.timestamp , u.fname, u.lname, p.postphoto, p.caption 
          FROM post_reports pr
          LEFT JOIN user_registration u ON pr.user_no = u.user_no
          LEFT JOIN posts p ON p.post_id = pr.post_id
          WHERE pr.report_id = ?
          ";
          $stmt = $con->prepare($query);
          $stmt->bind_param("i", $report_id);
          $stmt->execute();
          $result = $stmt->get_result();
          $row = $result->fetch_assoc();

          $formattedTimestamp = date('F j, Y, g:i a', strtotime($row['timestamp']));

          $notification = '
          <p>Important Notice: Post Termination Due to Community Standards Violation </p>
          <p>Dear ' . htmlspecialchars($row['fname']) . ' ' . htmlspecialchars($row['lname']) . ',</p>
          <p>We hope this message finds you well. We want to inform you that one of your recent posts has been terminated or deleted due to a violation of our community standards.</p>
          <p><strong>Reason for Action:</strong> ' . htmlspecialchars($row['report_reason']) . '</p>
          <p><strong>Reported Post Details:</strong></p>
          <p><strong>Posted On:</strong> ' . htmlspecialchars($formattedTimestamp) . '</p>';

          // Add photo if it exists
          if (!empty($row['postphoto'])) {
              $notification .= '
              <p><strong>Photo:</strong></p>
              <img src="include/posts_images/' . htmlspecialchars($row['postphoto']) . '" alt="Reported Post Photo">
              <br><br>';
          }

          // Add caption if it exists
          if (!empty($row['caption'])) {
              $notification .= '
              <p><strong>Caption:</strong> ' . htmlspecialchars($row['caption']) . '</p>';
          }

          $notification .= '
          <p>We take these matters seriously to maintain a positive and respectful environment for all users. Please review our community standards <a href="users/t_c.php" target="_blank">here</a> to better understand our guidelines and ensure future compliance.</p>
          <p>If you believe this action was taken in error or if you have any questions, please feel free to contact our support team at <a href="users/user_appeal.php">CVStagram support</a>.</p>
          <p>Thank you for your understanding and cooperation.</p>
          <p>Best regards,<br>
          CVStagram</p>';

          
          // Insert notification
          $notificationSql = "INSERT INTO notifications (user_no, admin_id, post_id, notification_type, notification_text, notification_photo, notification_caption, timestamp) 
                    VALUES (?, ?, ?, 'Post deleted', ?, ?, ?, NOW())";
          $notificationStmt = $con->prepare($notificationSql);
          $notificationStmt->bind_param("iiisss", $user_no, $admin_id, $post_id, $notification, $postPhoto, $postCaption);
          $notificationStmt->execute();

          
          echo '<script>window.open("review_post.php?user_no=' . htmlspecialchars($user_no) . '", "_self")</script>';
      } else {
          $error = "There was a problem deleting the post.";
      }
  } else {
      $error = 'Password didn’t match.';
  }
}


?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warn user</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <form action="" method="post">
            <input type="hidden" name="user_no" value="<?php echo htmlspecialchars($user_no) ?>">
          <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($admin_id) ?>">
      </div>
      <div class="modal-body">
          
        <div class="container-fluid warnmodalbod">
            Enter report ID
            <div class="container-fluid">
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($warn_post_id) ?>" name="warn_post_id">
            </div>
            Enter your password to confirm
            <input type="password" name="warn_pass" class="form-control">
        </div>  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit_warn" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ban user</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <form action="" method="post">
        <input type="hidden" name="user_no" value="<?php echo htmlspecialchars($user_no) ?>">
        <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($admin_id) ?>">
      </div>
      <div class="modal-body">
        
        <div class="container-fluid warnmodalbod">
            
                                    <select name="ban_type" class="form-select" aria-label="Default select example">
                                        <option value="0" selected>Choose ban type</option>
                                        <option value="1">Ban for 7 Days</option>
                                        <option value="2">Ban for 30 Days</option>
                                        <option value="3">Permanently ban</option>
                                    </select>
            Enter your password to confirm
            <input type="password" name="ban_pass" class="form-control">
        </div>  
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit_ban" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal3 -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Remove user warning</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <form action="" method="post">
        <input type="hidden" name="user_no" value="<?php echo htmlspecialchars($user_no) ?>">
        <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($admin_id) ?>">
      </div>
      <div class="modal-body">
        
        <div class="container-fluid warnmodalbod">
            Enter your password to confirm
            <input type="password" name="remove_warnpass" class="form-control">
        </div>  
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="remove_warn" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal4 -->
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Unban user</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <form action="" method="post">
        <input type="hidden" name="user_no" value="<?php echo htmlspecialchars($user_no) ?>">
        <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($admin_id) ?>">
      </div>
      <div class="modal-body">
        <div class="container-fluid warnmodalbod">
            Enter your password to confirm
            <input type="password" name="remove_banpass" class="form-control">
        </div>  
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="remove_ban" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal5 -->
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete post</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <form action="" method="post">
        <input type="hidden" name="user_no" value="">
        <input type="hidden" name="post_id" value="">
        <input type="hidden" name="admin_id" value="">
        <input type="hidden" name="report_id" value="">
      </div>
      <div class="modal-body">
        <div class="container-fluid warnmodalbod">
            <div id="post-photo-container">
                <!-- Photo will be inserted here -->
                <img id="post-photo" src="" alt="Post Photo" width="100" style="display: none;">
            </div>
            <p id="post-caption"></p>
            Enter your password to confirm
            <input type="password" name="delete_banpass" class="form-control">
        </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="delete_post" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>