<?php
$current_user_no = $_SESSION['user_no'];
$error = "";
$email = "";
$password = "";

if (isset($_POST["submit_email"])) {
    $email = $_POST['email'];
    $password = $_POST['user_password'];

    if (checkIfEmailExists($email)) {
        if (validateEmail($email)) {
            // Fetch the current hashed password from the database
            $sql = "SELECT user_password FROM user_registration WHERE user_no = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $user_no);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $user_password = $row['user_password'];

            if (password_verify($password, $user_password)) {
                $sql = "UPDATE user_registration SET email = ? WHERE user_no = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("si", $email, $current_user_no);

                if ($stmt->execute()) {
                    $_SESSION["email"] = $email;
                    echo "<script>window.open('../users/logout.php','_self')</script>";
                } else {
                    $error = "Update failed. Please try again.";
                }
            } else {
                $error = "Password didn't match.";
            }
        } else {
            $error = "Please provide a valid CVSU email.";
        }
    } else {
        $error = "This email is already in use.";
    }
}
?>
<!-- Modal -->
<div class="modal fade" id="editemail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Enter your new CVSU email</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="" method="post">
        <div class="mb-3 px-3">
          <label for="email" class="form-label">New CVSU Email</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="CVSU email" value="<?php echo htmlspecialchars($email); ?>" required>
          <label for="user_password" class="form-label" style="padding-top:10px;">Confirm your password</label>
          <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Enter your password" required>
        </div>
        <div id="liveAlertPlaceholderemail" class="alert-container p-0 text-center"></div>
        <div class="modal-footer">
        <div class="container-fluid">You will be logged out after changing your Email</div>
          <button type="submit" name="submit_email" class="btn btn-primary">Change</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const error = "<?php echo htmlspecialchars(addslashes($error), ENT_QUOTES, 'UTF-8'); ?>";
    if (error) {
        const alertPlaceholder = document.getElementById('liveAlertPlaceholderemail');
        const exampleModal = new bootstrap.Modal(document.getElementById('editemail'));

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
