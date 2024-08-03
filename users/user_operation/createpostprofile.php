<!-- post creation -->
<?php

// Initialize an empty string for error messages
$error = "";
$postphoto = "";

// Prepare SQL query to fetch user data
$sql = "SELECT * FROM user_registration WHERE user_ID = ? OR email = ? OR student_no = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('sss', $_SESSION['user_ID'], $_SESSION['email'], $_SESSION['student_no']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


$_SESSION['user_no'] = $row['user_no'];

if (isset($_POST['post'])) {
    // Initialize flags to check if any content is provided
    $is_relation_set = isset($_POST['relation']) && !empty($_POST['relation']);
    $is_services_set = isset($_POST['services']) && !empty($_POST['services']);
    $is_caption_set = isset($_POST['caption']) && !empty(trim($_POST['caption']));
    $is_postphoto_set = isset($_FILES['postphoto']['name']) && !empty($_FILES['postphoto']['name']);

    // Check if category fields (relation and services) are empty
    if (!$is_relation_set || !$is_services_set) {
        $error = "Please provide a category to post.";
    }

    // Check if both caption and postphoto are empty
    if (!$is_caption_set && !$is_postphoto_set) {
        $error = "Please provide content for your post.";
    }

    // If no errors, process the post
    if (empty($error)) {
      $user_no = $_SESSION['user_no'];
      $relation = $_POST['relation'];
      $services = $_POST['services'];
      $caption = $_POST['caption'];
      $postphoto = isset($_FILES['postphoto']['name']) ? $_FILES['postphoto']['name'] : '';


      // Handle file upload
      if ($postphoto) {
        $tmp_postphoto = $_FILES['postphoto']['tmp_name'];
        $upload_path = "../include/posts_images/$postphoto";

        if (move_uploaded_file($tmp_postphoto, $upload_path)) {
            $sql = "INSERT INTO posts (user_no, relation, services, caption, postphoto) VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('issss', $user_no, $relation, $services, $caption, $postphoto);
            $stmt->execute();

            echo "<script>window.open('../users/profile.php?sideprof','_self')</script>";
        } else {
            $error = "Failed to upload photo.";
        }
    } else {
        // Insert post without photo
        $sql = "INSERT INTO posts (user_no, relation, services, caption, postphoto) VALUES (?, ?, ?, ?, '')";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('isss', $user_no, $relation, $services, $caption);
        $stmt->execute();
        echo "<script>window.open('../users/profile.php?sideprof','_self')</script>";
    }
  }
}


?>


<!-- Modal -->
<div class="modal fade" id="createpostprofile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Share your amazing story</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body postbody">
        <div class="modal-body bodypost">
            <div class="container-fluid chil1">
              <div class="container-fluid category">Select Category</div>
              <div class="container-fluid store">
                <form action="" method="post" enctype="multipart/form-data">
                <select class="form-select" name="relation" aria-label="Default select example">
                  <option selected value="bothrelation">All</option>
                  <option value="Friends">Friends</option>
                  <option value="Followers">Followers</option>
                </select>
              </div>
              <div class="container-fluid bookspost">
                <select class="form-select" name="services" aria-label="Default select example">
                  <option selected value="bothservices">all</option>
                  <option value="Store">Store</option>
                  <option value="Books">Books</option>
                </select>
              </div>
            </div>
            <div class="container-fluid chil2">
              <div class="container-fluid addcaptionpost">Add Captions</div>
              <div class="container-fluid captionpost">
                <div class="mb-3">
                  <textarea class="form-control" name="caption" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
              </div>
            </div>
            <div class="container-fluid chil3">
              <div class="mb-3">
                <label for="formFile" class="form-label" style="margin-left:10px;margin-top:10px;">Upload your photo here</label>
                <input class="form-control" name="postphoto" type="file" id="formFile">
              </div>
            </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" name="post" class="btn btn-primary">Post</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  


    <div class="toast-header">
      <strong class="me-auto">Notification</strong>
      <small>Just now</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="alert alert-danger" role="alert">
    <div class="toast-body">
      
      <!-- Toast message will be inserted here -->
    </div>
    </div>
  </div>
</div>

<!-- // toast message popup on creating post -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if (!empty($error)): ?>
        // Set the toast message
        var toastBody = document.querySelector('#liveToast .toast-body');
        toastBody.textContent = '<?php echo addslashes($error); ?>';

        // Initialize and show the toast
        var toastEl = document.getElementById('liveToast');
        var toast = new bootstrap.Toast(toastEl, { delay: 5000 }); // 5 seconds delay

        // Show the toast
        toast.show();
    <?php endif; ?>
});
</script>
