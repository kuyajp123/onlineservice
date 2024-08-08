
<?php
$query = 'SELECT ur.fname
          FROM user_registration ur
          JOIN posts p ON ur.user_no = p.user_no
          WHERE p.post_id = ?';

$stmt = $con->prepare($query);
$stmt->bind_param('i', $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $fnameOfPost = $row['fname'];
}
?>
<!-- Modal HTML -->
<div class="modal fade" id="exampleModal_imagepost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo htmlspecialchars($fnameOfPost); ?>'s Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div id="modal-content-image">
        <!-- Post content will be dynamically loaded here -->
      </div>

      <!-- Line separator -->
    <div class="line"></div>

      <div class="container contcomments" id="modal-commentimage-content">
        <!-- Comments will be dynamically loaded here -->
      </div>
      </div>

      <div class="modal-footer" id="modal-imageinput-comment">
         <!-- Comment form will be dynamically load here-->
          
      </div>
    </div>
  </div>
</div>  