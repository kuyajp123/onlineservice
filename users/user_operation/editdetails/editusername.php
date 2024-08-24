<?php

$user_id = $_SESSION['user_ID'];
$user_no = $_SESSION['user_no'];
$user_ID = "";
$error = "";

// SQL query to get the current user_ID based on the session user_ID
$sql = "SELECT user_ID FROM user_registration WHERE user_ID = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $user_id); // 's' for string
$stmt->execute();
$result = $stmt->get_result();

 // Fetch the current hashed password from the database
 $sql = "SELECT user_password FROM user_registration WHERE user_no = ?";
 $stmt = $con->prepare($sql);
 $stmt->bind_param("s", $user_no);
 $stmt->execute();
 $result = $stmt->get_result();
 $row = $result->fetch_assoc();

 $password = $row['user_password'];

// Check if the user ID exists
if ($result->num_rows > 0) {
    if (isset($_POST['submit_username'])) { // Ensure the form submit button name is 'submit_username'
        $input_user_ID = $_POST['user_ID'];
        $user_password = $_POST['user_password'];

        // Verify if the provided password matches the session password
        if (password_verify($user_password, $password)) {
            // Clean and format the new username
            $clean_input = preg_replace('/\s+/', ' ', $input_user_ID); // Replace multiple spaces with a single space
            $clean_input = strtolower(trim($clean_input)); // Convert to lowercase and trim

            // Replace single spaces with underscores and remove special characters except underscores
            $formatted_user_ID = preg_replace('/[^a-z0-9\s_]/', '', $clean_input);
            $formatted_user_ID = str_replace(' ', '_', $formatted_user_ID);

            // Append a random number to the username
            $random_number = 10 + rand(0, 999);
            $formatted_user_ID .= $random_number;

            // Ensure only one "@" is present and at the start
            $formatted_user_ID = preg_replace('/[^a-z0-9.@_]/', '', $formatted_user_ID);
            if (substr_count($formatted_user_ID, '@') > 1) {
                $parts = explode('@', $formatted_user_ID);
                $formatted_user_ID = $parts[0] . '@' . implode('', array_slice($parts, 1));
            }
            if ($formatted_user_ID[0] !== '@') {
                $formatted_user_ID = '@' . $formatted_user_ID;
            }

            // Check if the new formatted user_ID is already taken
            $sql = "SELECT user_ID FROM user_registration WHERE user_ID = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $formatted_user_ID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) { // No rows means the user_ID is available
                // Update the user_ID in the database
                $sql = "UPDATE user_registration SET user_ID = ? WHERE user_ID = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ss", $formatted_user_ID, $user_id); // 'ss' for strings

                if ($stmt->execute()) {
                    $_SESSION["user_ID"] = $formatted_user_ID; // Update session variable
                    echo "<script>window.open('profile.php?editdetails','_self')</script>";
                } else {
                    $error = "Update failed. Please try again.";
                }
            } else {
                $error = "This username is already taken.";
            }
        } else {
            $error = "Password didn't match.";
        }
    }
} else {
    $error = "User not found.";
}

// Display error message if any
if ($error) {
    echo "<p>$error</p>";
}

// Output JavaScript to handle the modal and alert
if (!empty($error)): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alertPlaceholder = document.getElementById('liveAlertPlaceholder');
            const exampleModal = new bootstrap.Modal(document.getElementById('editusername'));

            // Show the modal
            exampleModal.show();

            // Display the alert with error message
            if (alertPlaceholder) {
                const wrapper = document.createElement('div');
                wrapper.innerHTML = [
                    `<div class="alert alert-danger alert-dismissible fade show" role="alert">`,
                    `   <div><?php echo addslashes($error); ?></div>`,
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
<?php endif; ?>










<!-- Modal -->
<div class="modal fade" id="editusername" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Enter your new Username</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="row g-3 px-3 pt-2">
        <div class="col">
          <form id="editNameForm" action="" method="post">
            <input type="text" id="User_ID" name="user_ID" class="form-control" placeholder="Username" aria-label="Username" value="<?php echo htmlspecialchars($user_ID); ?>" required>
        </div>
        
      </div>
      <div class="mb-3 px-3">
        <label for="formGroupExampleInput2" class="form-label" style="padding-top:10px;">Confirmation</label>
        <input type="password" class="form-control" name="user_password" id="editnamepass" placeholder="Enter your password" required>
      </div>
      <div id="liveAlertPlaceholder" class="alert-container p-0 text-center"></div>

      <div class="modal-footer">
        <button type="submit" name="submit_username" class="btn btn-primary">Change</button>
        </form>
      </div>
    </div>
  </div>
</div>