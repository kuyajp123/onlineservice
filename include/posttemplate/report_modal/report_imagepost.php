<?php
require_once 'include/connect.php';
// Check if the form was submitted
if (isset($_POST['submit_report_imagepost'])) {
    // Get form values
    $post_id = $_POST['post_id'];
    $report_reason = isset($_POST['report_reason']) ? $_POST['report_reason'] : ''; // Handle undefined array key
    $user_no = $_SESSION['user_no']; // Assuming you store the user number in session

    // Validate input
    if (empty($post_id) || empty($report_reason)) {
        echo "All fields are required.";
        exit;
    }

    // Insert report into the database
    $stmt = $con->prepare('INSERT INTO post_reports (post_id, user_no, report_reason, report_date) VALUES (?, ?, ?, NOW())');
    $stmt->bind_param('iis', $post_id, $user_no, $report_reason);

    if ($stmt->execute()) {
        echo "Report submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
}
?>


<!-- Modal -->
<div class="modal fade" id="reportmodal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="container text-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo htmlspecialchars($fnameOfPost); ?>'s Post</h1>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">
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
              <div class="form-check m-2">
                <input class="form-check-input" type="radio" name="report_reason" id="imagepostreport9" value="Other" style="border: 1px solid black;">
                <label class="form-check-label" for="imagepostreport9">Other</label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="submit_report_imagepost" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
