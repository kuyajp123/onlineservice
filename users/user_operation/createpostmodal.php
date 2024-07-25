<?php








?>


<!-- Modal -->
<div class="modal fade" id="createpost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <button type="submit" name="submit" class="btn btn-primary">Post</button>
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
