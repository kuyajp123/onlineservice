<?php
$student_no = "";
$password = "";
$user_no = $_SESSION['user_no'];
$error = "";

if (isset($_POST["submit_std_no"])) {
    $student_no = $_POST["student_no"];
    $password = $_POST["user_password"];

    if (isset($user_no)) {
        if (validateStudentNo($student_no)) {
            $sql = "SELECT user_password FROM user_registration WHERE user_no = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $user_no);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $user_password = $row["user_password"];  
            if (password_verify($password, $user_password)) {
                $query = "UPDATE user_registration SET student_no = ? WHERE user_no = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param("ss", $student_no, $user_no);
                if ($stmt->execute()) {
                    $_SESSION['student_no'] = $student_no;
                    echo "<script>window.location.href = 'profile.php?editdetails';</script>";
                } else {
                    $error = "Update failed";
                }
            } else {
                $error = "Password didn't match";
            }
        } else {
            $error = "Please provide the correct format for student number";
        }
    } else {
        $error = "User number not set";
    }
}
?>


<!-- Modal -->
<div class="modal fade" id="editstdnum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Enter your new Student Number</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="row g-3 px-3 pt-2">
          <div class="col">
            <input type="text" name="student_no" class="form-control" placeholder="Student number" aria-label="Student number" value="<?php echo htmlspecialchars($student_no); ?>" required>
          </div>
        </div>
        <div class="mb-3 px-3">
          <label for="user_password" class="form-label" style="padding-top:10px;">Confirmation</label>
          <input type="password" class="form-control" name="user_password" id="editnamepass" placeholder="Enter your password" required>
        </div>
        <div id="liveAlertPlaceholderstd_num" class="alert-container p-0 text-center"></div>
        <div class="modal-footer">
          <button type="submit" name="submit_std_no" class="btn btn-primary">Change</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const error = "<?php echo addslashes($error); ?>";
    if (error) {
        const alertPlaceholder = document.getElementById('liveAlertPlaceholderstd_num');
        const exampleModal = new bootstrap.Modal(document.getElementById('editstdnum'));

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
