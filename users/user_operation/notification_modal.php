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
?>

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Notifications</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <?php if (count($notifications) > 0): ?>
          <div class="container-fluid notifmodal1">
            <?php foreach ($notifications as $notification): ?>
              <div class="container-fluid notifbody">
                <div class="container-fluid notificonnotifmessage">
                  <a href="#" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" class="messagelink">

                    <div class="container-fluid notificon">
                      <!-- Change icon based on notification type -->
                      <?php if ($notification['notification_type'] == 'warning'): ?>
                        <i class="fa-solid fa-triangle-exclamation" style="color: #836a11;"></i>
                      <?php elseif ($notification['notification_type'] == 'ban'): ?>
                        <i class="fa-solid fa-circle-exclamation" style="color: #d01b24;"></i>
                      <?php elseif ($notification['notification_type'] == 'reaction'): ?>
                        <i class="fa-solid fa-heart" style="color: #d11f1f;"></i>
                      <?php elseif ($notification['notification_type'] == 'comment'): ?>
                        <i class="fa-solid fa-comment" style="color: #1fa836;"></i>
                      <?php else: ?>
                        <i class="fa-solid fa-bell" style="color: #000;"></i> <!-- Default icon -->
                      <?php endif; ?>
                    </div>

                    <div class="container-fluid notifmessage">
                      <!-- Display notification type -->
                      <div class="container-fluid titlenotif">
                        <?php echo ucfirst($notification['notification_type']); ?>
                      </div>
                      <!-- Display notification text -->
                      <div class="container-fluid text-wrap text-break d-inline-block text-truncate textnotif">
                        <?php echo htmlspecialchars($notification['notification_text']); ?>
                      </div>
                    </div>

                  </a>
                </div>

                <div class="dropdown notifdots">
                  <a class="dropdown-toggle notificondots" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i>
                  </a>

                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Delete</a></li>
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
        <!-- Footer content (if any) -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Hide this modal and show the first with the button below.
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
      </div>
    </div>
  </div>
</div>
