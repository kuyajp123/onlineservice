<?php
session_start();
require_once '../include/bootsrap.php';
require_once '../include/connect.php';
require_once '../functions/common_function.php';
// Get the user number from query parameters
$other_user_no = isset($_GET['user_no']) ? intval($_GET['user_no']) : null;
$data = getPosts($con);

$rows = $data['rows'];

foreach ($rows as $row):
    // Extract data
    $post_id = htmlspecialchars($row['post_id']);
    $user_no = htmlspecialchars($row['user_no']);
    $fname = htmlspecialchars($row['fname']);
    $lname = htmlspecialchars($row['lname']);
    $timestamp = htmlspecialchars($row['timestamp']);
    $postphoto = htmlspecialchars($row['postphoto']);
    $caption = htmlspecialchars($row['caption']);
    $comments = htmlspecialchars($row['comments']);
endforeach;
?>

<!-- Buttons to open the modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?php echo htmlspecialchars($post_id); ?>">Open modal for post <?php echo htmlspecialchars($post_id); ?></button>

<!-- Modal HTML -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Post Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-content">
        <!-- Modal body content will be dynamically loaded here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var exampleModal = document.getElementById('exampleModal');

  exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    var postId = button.getAttribute('data-bs-whatever');

    // Make an AJAX request to fetch post details
    fetch('scripts/fetch_post_details.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: new URLSearchParams('post_id=' + postId)
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(data => {
      // Update the modal's content
      var modalContent = exampleModal.querySelector('#modal-content');
      modalContent.innerHTML = data;
    })
    .catch(error => {
      console.error('Error fetching post details:', error);
    });
  });
});
</script>
