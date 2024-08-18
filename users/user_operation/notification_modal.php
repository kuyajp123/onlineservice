<?php
// Assuming $con is your database connection
$sql = "SELECT * FROM notifications WHERE user_no = ? ORDER BY timestamp DESC";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $current_user_no);
$stmt->execute();
$result = $stmt->get_result();

// Fetch all notifications
$notifications = $result->fetch_all(MYSQLI_ASSOC);

// Close the statement
$stmt->close();



if (isset($_POST['notification_id'])) {
    $notification_id = $_POST['notification_id'];

    // Sanitize and validate notification_id if necessary
    if (filter_var($notification_id, FILTER_VALIDATE_INT) !== false) {
        $sql = "DELETE FROM notifications WHERE notification_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $notification_id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete notification']);
        }

        $stmt->close();
    }
}

?>


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Notifications</h1>
        <button type="button" class="btn-close" id="close_button1" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Notification Content -->
        <?php if (count($notifications) > 0): ?>
        <div class="container-fluid notifmodal1" data-id="<?php echo htmlspecialchars($notification['notification_id'], ENT_QUOTES, 'UTF-8'); ?>">
          <?php foreach ($notifications as $notification): ?>
          <div class="container-fluid notifbody">
            <div class="container-fluid notificonnotifmessage">
              <a href="#" 
                 class="messagelink"
                 data-comment="<?php echo htmlspecialchars($notification['notification_text'], ENT_QUOTES, 'UTF-8'); ?>"
                 data-type="<?php echo htmlspecialchars(ucfirst($notification['notification_type']), ENT_QUOTES, 'UTF-8'); ?>">

                <div class="container-fluid notificon">
                  <!-- Icon based on notification type -->
                  <?php if ($notification['notification_type'] == 'warning'): ?>
                  <i class="fa-solid fa-triangle-exclamation" style="color: #836a11;"></i>
                  <?php elseif ($notification['notification_type'] == 'ban'): ?>
                  <i class="fa-solid fa-circle-exclamation" style="color: #d01b24;"></i>
                  <?php elseif ($notification['notification_type'] == 'reaction'): ?>
                  <i class="fa-solid fa-heart" style="color: #d11f1f;"></i>
                  <?php elseif ($notification['notification_type'] == 'comment'): ?>
                  <i class="fa-solid fa-comment" style="color: #1fa836;"></i>
                  <?php else: ?>
                  <i class="fa-solid fa-bell" style="color: #000;"></i>
                  <?php endif; ?>
                </div>

                <div class="container-fluid notifmessage">
                  <div class="container-fluid titlenotif">
                    <?php echo ucfirst($notification['notification_type']); ?>
                  </div>
                  <div class="container-fluid text-wrap text-break d-inline-block text-truncate textnotif">
                    <?php 
                    $notification_text = $notification['notification_text'];
                    $limited_text = substr($notification_text, 0, 80); // Limit to first 95 characters
                    if(strlen($notification_text) > 80) {
                        $limited_text .= '...'; // Add ellipsis if text is longer than the limit
                    }
                    echo $limited_text;
                    ?>
                  </div>
                </div>
              </a>
            </div>

            <div class="dropdown notifdots">
              <a class="dropdown-toggle notificondots" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item delete-notification" href="#" data-id="<?php echo htmlspecialchars($notification['notification_id'], ENT_QUOTES, 'UTF-8'); ?>">Delete</a></li>
              </ul>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="container-fluid nonotif">
          No notifications yet
        </div>
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <!-- Footer content -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"></h1>
        <button type="button" class="btn-close" id="close_button2"></button>
      </div>
      <div class="modal-body ">

        <div class="container-fluid notiffull" id="fullComment">
            <!-- Full comment will be dynamically inserted here -->
        </div>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var messageLinks = document.querySelectorAll('.messagelink');
    var fullComment = document.getElementById('fullComment');

    // Initialize both modals
    var exampleModalToggle1 = new bootstrap.Modal(document.getElementById('exampleModalToggle'));
    var exampleModalToggle2 = new bootstrap.Modal(document.getElementById('exampleModalToggle2'));

    // Handle clicking on notification links
    messageLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default anchor behavior

            // Get the comment and type from the clicked link
            var comment = link.getAttribute('data-comment');
            var type = link.getAttribute('data-type');

            // Update the content of the second modal
            fullComment.innerHTML = '<strong>' + type + ':</strong> ' + comment;

            var modalTitle = document.getElementById('exampleModalToggleLabel2');
            modalTitle.textContent = type;

            // Close the first modal and show the second modal
            exampleModalToggle1.hide();
            exampleModalToggle2.show();
        });
    });

    // Handle the close buttons
    document.getElementById('close_button2').addEventListener('click', function() {
        exampleModalToggle2.hide();
    });

    // Handle delete button clicks
    var deleteButtons = document.querySelectorAll('.delete-notification');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            var notificationId = button.getAttribute('data-id');
            var notifBody = button.closest('.notifbody'); // Correctly find the specific notification element

            console.log('Delete button clicked for ID:', notificationId);

            fetch('index.php', {  // this is the right path for my deletion
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'notification_id': notificationId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Remove the specific notification from the DOM
                    notifBody.remove();
                } else {
                    alert('Failed to delete notification: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});

</script>

