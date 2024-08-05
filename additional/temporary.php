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
