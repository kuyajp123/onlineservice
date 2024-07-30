<?php
$error = "";
$user_no = $_SESSION['user_no'];

if (isset($_POST['submit_profile'])) { // Handle profile picture update
    if (isset($user_no)) {
        // Check if a file is uploaded
        if (isset($_FILES['profilepicture']) && $_FILES['profilepicture']['error'] === UPLOAD_ERR_OK) {
            $profilepicture = $_FILES['profilepicture']['name'];
            $tmp_profilepicture = $_FILES['profilepicture']['tmp_name'];
            $upload_path = "../users/images/profilepicture/" . basename($profilepicture);

            // Move uploaded file
            if (move_uploaded_file($tmp_profilepicture, $upload_path)) {
                // Remove old profile picture if it exists
                $old_picture = getOldProfilePicture($user_no, $con); // Function to get old image path from DB
                if ($old_picture && file_exists("../users/images/profilepicture/" . $old_picture) && $old_picture !== 'profile.jpg') {
                    unlink("../users/images/profilepicture/" . $old_picture);
                }

                // Update the database with the new profile picture
                $sql = "UPDATE user_registration SET profilepicture = ? WHERE user_no = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("si", $profilepicture, $user_no);

                if ($stmt->execute()) {
                    $_SESSION['profilepicture'] = $profilepicture;
                    echo "<script>window.open('profile.php?sideprof','_self')</script>";
                } else {
                    $error = "Error updating profile picture in database.";
                }
            } else {
                $error = "Error moving the uploaded file.";
            }
        } else {
            // If no file is uploaded, proceed to reset to default profile picture
            $profilepicture = 'profile.jpg'; // Default image
            $sql = "UPDATE user_registration SET profilepicture = ? WHERE user_no = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("si", $profilepicture, $user_no);

            if ($stmt->execute()) {
                $_SESSION['profilepicture'] = $profilepicture;
                echo "<script>window.open('profile.php?sideprof','_self')</script>";
            } else {
                $error = "Error setting default profile picture in database.";
            }
        }
    } else {
        $error = "User number not set.";
    }
}

if (isset($_POST['remove_profile'])) { // Handle removing profile picture and setting default
    if ($user_no) {
        // Remove current profile picture if it exists
        $old_picture = getOldProfilePicture($user_no, $con); // Function to get old image path from DB
        if ($old_picture && file_exists("../users/images/profilepicture/" . $old_picture) && $old_picture !== 'profile.jpg') {
            unlink("../users/images/profilepicture/" . $old_picture);
        }

        // Set the profile picture to default
        $profilepicture = 'profile.jpg'; // Default image
        $sql = "UPDATE user_registration SET profilepicture = ? WHERE user_no = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si", $profilepicture, $user_no);

        if ($stmt->execute()) {
            $_SESSION['profilepicture'] = $profilepicture;
            echo "<script>window.open('profile.php?sideprof','_self')</script>";
        } else {
            $error = "Error setting default profile picture in database.";
        }
    } else {
        $error = "User number not set.";
    }
}
?>


<style>
    .card{
        margin-top: 5%;
    }
    .profilepictureholder{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="editprofile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Profile Picture</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <div class="row g-3 px-3 pt-2">
        <div class="col profileelements">
          <form action="" method="post" enctype="multipart/form-data"> <!-- Added method and enctype -->
          <div class="mb-0">
            <label for="profilepicture" class="p-2">Upload your photo here</label>
            <input type="file" id="profilepicture" name="profilepicture" class="form-control form-control-solid"/>
          </div>
            <div class="container-fluid profilepictureholder">
                <div class="card" style="width: 18rem;">
                        <img src="../users/images/profilepicture/<?php echo $_SESSION['profilepicture']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                        <button type="submit" name="remove_profile" class="btn btn-outline-danger">Remove</button>
                        </div>
                </div>   
            </div>
        </div>
        </div>
        <div id="liveAlertPlaceholderprofilepicture" class="alert-container p-0 text-center"></div>
      <div class="modal-footer">
        <button type="submit" name="submit_profile" class="btn btn-primary">Change</button> <!-- Fixed button name -->
        </form>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const error = "<?php echo htmlspecialchars(addslashes($error), ENT_QUOTES, 'UTF-8'); ?>";
    if (error) {
        const alertPlaceholder = document.getElementById('liveAlertPlaceholderprofilepicture');
        const exampleModal = new bootstrap.Modal(document.getElementById('editprofile'));

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
