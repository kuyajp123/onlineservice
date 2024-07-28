<?php

$error = "";
$coverphoto = "";
$user_no = $_SESSION['user_no'];

if (isset($_POST['submit_coverphoto'])) {
    if (isset($user_no)) {
        if (isset($_FILES['coverphoto']) && $_FILES['coverphoto']['error'] === UPLOAD_ERR_OK) {
            $coverphoto = $_FILES['coverphoto']['name'];
            $tmp_coverphoto = $_FILES['coverphoto']['tmp_name'];
            $upload_path = "../users/images/coverphoto/" . basename($coverphoto);

            // Move the uploaded file to the desired location
            if (move_uploaded_file($tmp_coverphoto, $upload_path)) {
                // Update the cover photo in the database
                $sql = "UPDATE user_registration SET coverphoto = ? WHERE user_no = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("si", $coverphoto, $user_no);

                if ($stmt->execute()) {
                    $_SESSION['coverphoto'] = $coverphoto; // Update session variable
                    echo "<script>window.open('profile.php?sideprof','_self')</script>";
                } else {
                    $error = "Error updating cover photo in database.";
                }
            } else {
                $error = "Error moving the uploaded file.";
            }
        } else {
            $error = "Error uploading file or no file selected.";
        }
    } else {
        $error = 'User number not set.';
    }
}
?>

<!-- Modal -->
<div class="modal fade" id="editcoverphoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cover Photo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="row g-3 px-3 pt-2">
          <div class="col">
            <div class="mb-0">
              <label for="coverphoto" class="p-2">Upload your cover photo here</label>
              <input type="file" id="coverphoto" name="coverphoto" class="form-control form-control-solid" required />
            </div>
          </div>
        </div>
        <div id="liveAlertPlaceholdercoverphoto" class="alert-container p-0 text-center"></div>
        <div class="modal-footer">
          <button type="submit" name="submit_coverphoto" class="btn btn-primary">Change</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const error = "<?php echo htmlspecialchars(addslashes($error), ENT_QUOTES, 'UTF-8'); ?>";
    if (error) {
        const alertPlaceholder = document.getElementById('liveAlertPlaceholdercoverphoto');
        const exampleModal = new bootstrap.Modal(document.getElementById('editcoverphoto'));

        exampleModal.show();

        if (alertPlaceholder) {
            const wrapper = document.createElement('div');
            wrapper.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${error}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            alertPlaceholder.innerHTML = ''; // Clear previous alerts
            alertPlaceholder.append(wrapper);

            setTimeout(() => {
                wrapper.querySelector('.alert').classList.add('show');
            }, 10);

            setTimeout(() => {
                const alertElement = wrapper.querySelector('.alert');
                alertElement.classList.remove('show');
                setTimeout(() => {
                    if (alertElement.parentElement) {
                        alertElement.parentElement.removeChild(alertElement);
                    }
                }, 500);
            }, 5000);
        }
    }
});
</script>
