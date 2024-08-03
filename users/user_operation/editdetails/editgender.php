<?php

$user_id = $_SESSION['user_ID'];
$password = $_SESSION['user_password'];
$error = "";

if (isset($_POST['gender_submit'])) {
    $gender = $_POST['gender'];
    $customGender = isset($_POST['customGender']) ? $_POST['customGender'] : '';
    $user_password = $_POST['user_password'];

    // Verify if the provided password matches the session password
    if (password_verify($user_password, $password)) {
        if ($gender === 'Custom' && empty($customGender)) {
            $error = "Please specify your gender.";
        } else {
            // Use custom gender if 'Custom' is selected
            if ($gender === 'Custom') {
                $gender = $customGender;
            }

            // Update the user's gender in the database
            $sql = "UPDATE user_registration SET gender = ? WHERE user_ID = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ss", $gender, $user_id);

            if ($stmt->execute()) {
                $_SESSION["gender"] = $gender; // Update session variable
                echo "<script>window.open('profile.php?editdetails','_self')</script>";
            } else {
                $error = "Update failed. Please try again.";
            }
        }
    } else {
        $error = "Password didn't match.";
    }
}
?>


<!-- Modal -->
<div class="modal fade" id="editgender" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Enter your new Gender</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="editGenderForm" action="" method="post">
          <div class="mb-3">
            <label>&nbsp; &nbsp; Gender &nbsp; &nbsp;</label><br><br>
            &nbsp; &nbsp;&nbsp;<input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
            <label class="form-check-label" for="male">Male</label>
            &nbsp; &nbsp;
            <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required>
            <label class="form-check-label" for="female">Female</label>
            &nbsp; &nbsp;
            <input class="form-check-input" type="radio" name="gender" id="custom" value="Custom">
            <label class="form-check-label" for="custom">Custom</label>
            <br><br>
            <div class="mb-3 px-3" id="customGenderContainer" style="display: none;">
              <label for="customGender" class="form-label">Please specify your gender</label>
              <select class="form-select" name="customGender" id="customGender">
                <option value="">Select...</option>
                <option value="Non-binary">Non-binary</option>
                <option value="Other">Other</option>
                <option value="Other">prefered not to say</option>
              </select>
            </div>
          </div>

          <div class="mb-3 px-3">
            <label for="user_password" class="form-label" style="padding-top:10px;">Confirmation</label>
            <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Enter your password" required>
          </div>

          <div class="modal-footer">
            <button type="submit" name="gender_submit" class="btn btn-primary">Change</button>
          </div>
        </form>
        <div id="liveAlertPlaceholdergender" class="alert-container p-0 text-center"></div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle custom gender select visibility
    document.querySelectorAll('input[name="gender"]').forEach(input => {
        input.addEventListener('change', function() {
            const customGenderContainer = document.getElementById('customGenderContainer');
            if (this.value === 'Custom') {
                customGenderContainer.style.display = 'block';
            } else {
                customGenderContainer.style.display = 'none';
            }
        });
    });

    // Handle form submission and errors
    const error = "<?php echo addslashes($error); ?>";
    if (error) {
        const exampleModal = new bootstrap.Modal(document.getElementById('editgender'));
        exampleModal.show();

        const alertPlaceholder = document.getElementById('liveAlertPlaceholdergender');
        const wrapper = document.createElement('div');
        wrapper.innerHTML = [
            `<div class="alert alert-danger alert-dismissible fade show" role="alert">`,
            `   <div>${error}</div>`,
            '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            '</div>'
        ].join('');
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
});
</script>
