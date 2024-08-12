<?php
$new_password = "";
$user_password = "";
$user_no = $_SESSION['user_no'];
$error = "";

// Check if the user is set
if (isset($user_no)) {
    if (isset($_POST['submit_password'])) { // Ensure the form submit button name is 'submit_password'
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $user_password = $_POST['user_password'];

        // Fetch the current hashed password from the database
        $sql = "SELECT user_password FROM user_registration WHERE user_no = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $user_no);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            $old_password = $row["user_password"];

            if ($new_password === $confirm_password) {
                if (password_verify($user_password, $old_password)) {
                    if (password_verify($new_password, $old_password)) {
                        $error = "The new password cannot be the same as the old password.";
                    } else {
                        // Hash the new password
                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                        // Update the user_password in the database
                        $query = "UPDATE user_registration SET user_password = ? WHERE user_no = ?";
                        $stmt = $con->prepare($query);
                        $stmt->bind_param("ss", $hashed_password, $user_no);

                        if ($stmt->execute()) {
                            $_SESSION["user_password"] = $hashed_password; // Update session variable
                            echo "<script>window.open('../users/logout.php','_self')</script>";
                        } else {
                            $error = "Update failed. Please try again.";
                        }
                    }
                } else {
                    $error = "Old password didn't match.";
                }
            } else {
                $error = "New password and confirmation do not match.";
            }
        } else {
            $error = "No user found.";
        }
    }
} else {
    $error = "User ID not set.";
}
?>
<style>
    .passbut{
        display: flex;
        justify-content: flex-end;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="editpassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Enter your new Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="" method="post">
        <div class="mb-3 px-3">
          <label for="new_password" class="form-label">New Password</label>
          <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter your new password" required>
          <label for="confirm_password" class="form-label" style="padding-top:10px;">Confirm Password</label>
          <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm your new password" required>
          <label for="user_password" class="form-label" style="padding-top:10px;">Verify Identity</label>
          <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Enter your old password" required>
        </div>
        <div id="liveAlertPlaceholderpassword" class="alert-container p-0 text-center"></div>
        <div class="modal-footer passmod">
            <div class="container-fluid">You will be logged out after changing your password</div>
          <div class="container-fluid passbut"><button type="submit" name="submit_password" class="btn btn-primary">Change</button></div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Output JavaScript to handle the modal and alert -->
<?php if (!empty($error)): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const error = "<?php echo addslashes($error); ?>";
            if (error) {
                const alertPlaceholder = document.getElementById('liveAlertPlaceholderpassword');
                const exampleModal = new bootstrap.Modal(document.getElementById('editpassword'));

                // Show the modal
                exampleModal.show();

                // Display the alert with error message
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
<?php endif; ?>


