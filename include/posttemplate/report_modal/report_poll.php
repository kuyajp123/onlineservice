<?php
require_once 'include/connect.php'; // Go up two directories from fetch_textpost to reach include

$message = "";
$messageType = ""; // To hold the type of message (success or error)

// Check if the form was submitted
if (isset($_POST['submit_report_pollpost'])) {
    // Retrieve and sanitize form data
    $poll_id = isset($_POST['poll_id']) ? intval($_POST['poll_id']) : 0;
    $user_no = isset($_POST['user_no']) ? intval($_POST['user_no']) : 0;
    $report_reason = isset($_POST['report_reason']) ? htmlspecialchars($_POST['report_reason']) : '';
    $reporter_user_no = isset($_POST['reporter_user_no']) ? intval($_POST['reporter_user_no']) : 0;

    

    // Validate input
    if ($poll_id > 0 && $user_no > 0 && !empty($report_reason) && $reporter_user_no > 0) {
        // Prepare SQL query to insert the report
        $stmt = $con->prepare("INSERT INTO post_reports (poll_id, user_no, reporter_user_no, report_reason) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('iiis', $poll_id, $user_no, $reporter_user_no, $report_reason);

        if ($stmt->execute()) {
            // Set success message and type
            $message = "Thank you for your cooperation. Your report has been submitted successfully. Our team will review the details and take appropriate action. We appreciate your help in keeping our community safe and respectful. If you have any further concerns or need assistance, please do not hesitate to contact us.";
            $messageType = "success";
        } else {
            // Set error message and type
            $message = "Error: " . $stmt->error;
            $messageType = "error";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        $message = "Please provide the reason for your report.";
        $messageType = "error";
        
    }

    // Set message in session and redirect
    $_SESSION['message'] = $message;
    $_SESSION['messageType'] = $messageType;

        // Redirect with message
    echo "<script>
        window.location.href = 'index.php?newsfeed=" . htmlspecialchars($reporter_user_no) . "&message=" . urlencode($message) . "&messageType=" . $messageType . "';
    </script>";
    exit();

}

// Check for message in session and clear it after displaying
$message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
$messageType = isset($_SESSION['messageType']) ? $_SESSION['messageType'] : "";
unset($_SESSION['message']);
unset($_SESSION['messageType']);
?>



<!-- Modal -->
<div class="modal fade" id="reportmodal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="container text-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Report user</h1>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        <input type="hidden" id="modal_poll_id" name="poll_id">
        <input type="hidden" id="modal_user_no" name="user_no">
        <input type="hidden" id="modal_reporter_user_no" name="reporter_user_no">
          <div class="container">
            <div class="container-fluid text-center h4 mb-4">Why are you reporting this post?</div>
            <div class="container h5">
              <div class="form-check m-2">
                <input class="form-check-input" type="radio" name="report_reason" id="imagepostreport1" value="Misleading or scam" style="border: 1px solid black;">
                <label class="form-check-label" for="imagepostreport1">Misleading or scam</label>
              </div>
              <div class="form-check m-2">
                <input class="form-check-input" type="radio" name="report_reason" id="imagepostreport2" value="Sexually inappropriate" style="border: 1px solid black;">
                <label class="form-check-label" for="imagepostreport2">Sexually inappropriate</label>
              </div>
              <div class="form-check m-2">
                <input class="form-check-input" type="radio" name="report_reason" id="imagepostreport3" value="Offensive" style="border: 1px solid black;">
                <label class="form-check-label" for="imagepostreport3">Offensive</label>
              </div>
              <div class="form-check m-2">
                <input class="form-check-input" type="radio" name="report_reason" id="imagepostreport4" value="Violence" style="border: 1px solid black;">
                <label class="form-check-label" for="imagepostreport4">Violence</label>
              </div>
              <div class="form-check m-2">
                <input class="form-check-input" type="radio" name="report_reason" id="imagepostreport5" value="Pretending to be someone else" style="border: 1px solid black;">
                <label class="form-check-label" for="imagepostreport5">Pretending to be someone else</label>
              </div>
              <div class="form-check m-2">
                <input class="form-check-input" type="radio" name="report_reason" id="imagepostreport6" value="Prohibited content" style="border: 1px solid black;">
                <label class="form-check-label" for="imagepostreport6">Prohibited content</label>
              </div>
              <div class="form-check m-2">
                <input class="form-check-input" type="radio" name="report_reason" id="imagepostreport7" value="False news" style="border: 1px solid black;">
                <label class="form-check-label" for="imagepostreport7">False news</label>
              </div>
              <div class="form-check m-2">
                <input class="form-check-input" type="radio" name="report_reason" id="imagepostreport8" value="Spam" style="border: 1px solid black;">
                <label class="form-check-label" for="imagepostreport8">Spam</label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="submit_report_pollpost" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Toast Container -->
<div class="toast-container position-fixed top-50 start-50 translate-middle">
    <div id="liveToastreport" class="toast">
        <div class="toast-header">
            <strong class="me-auto">Notification</strong>
            <small>Just now</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body-report text-center">
            <!-- Toast message will be inserted here -->
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const message = "<?php echo $message; ?>";
    const messageType = "<?php echo $messageType; ?>"; // 'success' or 'error'

    if (message) {
        // Set the toast message and type
        const toastBody = document.querySelector('#liveToastreport .toast-body-report');
        toastBody.textContent = message;

        // Remove any previous alert classes
        toastBody.classList.remove('alert', 'alert-success', 'alert-danger');

        // Set toast class based on type
        if (messageType === 'success') {
            toastBody.classList.add('alert', 'alert-success');
        } else if (messageType === 'error') {
            toastBody.classList.add('alert', 'alert-danger');
        }

        // Initialize and show the toast
        const toastEl = document.getElementById('liveToastreport');
        const toast = new bootstrap.Toast(toastEl, { 
            autohide: messageType === 'error', // Auto-hide only for errors
            delay: messageType === 'error' ? 5000 : 20000 // 5 seconds for errors, longer for success
        });
        toast.show();
    }
});
</script>

