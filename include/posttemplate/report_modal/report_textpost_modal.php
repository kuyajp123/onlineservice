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
        
      <div class="container ">
        <div class="container-fluid text-center h4 mb-4">Why you're reporting this post?</div>
        <div class="container h5">
            <div class="form-check m-2">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="imagepostreport1" style="border: 1px solid black;">
              <label class="form-check-label" for="imagepostreport1">
                Misleading or scam
              </label>
            </div>
            <div class="form-check m-2">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="imagepostreport2" style="border: 1px solid black;">
              <label class="form-check-label" for="imagepostreport2">
                Sexually inappropriate
              </label>
          </div>
          <div class="form-check m-2">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="imagepostreport3" style="border: 1px solid black;">
              <label class="form-check-label" for="imagepostreport3">
                offensive
              </label>
          </div>
          <div class="form-check m-2">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="imagepostreport4" style="border: 1px solid black;">
              <label class="form-check-label" for="imagepostreport4">
                Violence
              </label>
          </div>
          <div class="form-check m-2">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="imagepostreport5" style="border: 1px solid black;">
              <label class="form-check-label" for="imagepostreport5">
                Pretending to be someone else
              </label>
          </div>
          <div class="form-check m-2">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="imagepostreport6" style="border: 1px solid black;">
              <label class="form-check-label" for="imagepostreport6">
                Probihited content
              </label>
          </div>
          <div class="form-check m-2">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="imagepostreport7" style="border: 1px solid black;">
              <label class="form-check-label" for="imagepostreport7">
                False news
              </label>
          </div>
          <div class="form-check m-2">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="imagepostreport8" style="border: 1px solid black;">
              <label class="form-check-label" for="imagepostreport8">
                Spam
              </label>
          </div>
          <div class="form-check m-2">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="imagepostreport9" style="border: 1px solid black;">
              <label class="form-check-label" for="imagepostreport9">
                Other
              </label>
          </div>
        </div>
          
      </div>
      

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
