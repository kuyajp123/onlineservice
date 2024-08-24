<?php 

$error = "";
$lname = "";
$fname = "";
$current_user_no = $_SESSION['user_no'];

if (isset($current_user_no)) {
    if (isset($_POST['submit'])) {       
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $user_password = $_POST['user_password'];

        // Fetch the current hashed password from the database
        $sql = "SELECT user_password FROM user_registration WHERE user_no = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $current_user_no);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $password = $row['user_password'];

        // Check if the entered password matches the session password
        if (password_verify($user_password, $password)) {
            // Format names by removing special characters
            $formattedFirstName = formatName($fname);
            $formattedLastName = formatName($lname);

            // Check if formatted names contain at least one letter
            if (empty($formattedFirstName) || empty($formattedLastName)) {
                $error = "Names must contain at least one letter.";
            } else {
                // Update the database with formatted names
                $sql = "UPDATE user_registration SET fname = ?, lname = ? WHERE user_no = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ssi", $formattedFirstName, $formattedLastName, $current_user_no);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    $_SESSION['fname'] = $formattedFirstName;
                    $_SESSION['lname'] = $formattedLastName;
                    echo "<script>window.open('profile.php?editdetails','_self')</script>";
                } else {
                    $error = "No changes made";
                }
            }
        } else {
            $error = "Password didn't match";
        }
    }
} else {
    $error = "No user found";
}

// Output JavaScript to handle the modal and alert
if (!empty($error)): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alertPlaceholder = document.getElementById('liveAlertPlaceholdername');
            const exampleModal = new bootstrap.Modal(document.getElementById('editname'));

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

            // Show the modal if there's an error
            exampleModal.show();
        });
    </script>
<?php endif; ?>




<!-- Modal -->
<div class="modal fade" id="editname" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Enter your new name</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="row g-3 px-3 pt-2">
        <div class="col">
          <form id="editNameForm" action="" method="post">
            <input type="text" id="fname" name="fname" class="form-control" placeholder="First name" aria-label="First name" required="required" value="<?php echo htmlspecialchars($fname); ?>">
        </div>
        <div class="col">
            <input type="text" id="lname" name="lname" class="form-control" placeholder="Last name" aria-label="Last name" required="required" value="<?php echo htmlspecialchars($lname); ?>">
        </div>
        </div>
        <div class="mb-3 px-3">
        <label for="formGroupExampleInput2" class="form-label" style="padding-top:10px;">Confirmation</label>
        <input type="password" class="form-control" name="user_password" id="editnamepass" placeholder="Enter your password" required="required">
        </div>
        <div id="liveAlertPlaceholdername" class="alert-container p-0 text-center"></div>
        <div class="modal-footer p-0">
          <button type="submit" name="submit" class="btn btn-primary">Change</button>
          </form>
        </div>
    </div>
  </div>
</div>

<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     document.getElementById('editNameForm').addEventListener('submit', function(event) {
    //         const fname = document.getElementById('fname').value;
    //         const lname = document.getElementById('lname').value;

    //         // // Regex to check if the string contains invalid characters
    //         // const hasInvalidChars = /[^a-zA-Z]/;

    //         // if (hasInvalidChars.test(fname) || hasInvalidChars.test(lname)) {
    //         //     event.preventDefault(); // Prevent form submission

    //             // Display error message
    //             const alertPlaceholder = document.getElementById('liveAlertPlaceholdername');
    //             alertPlaceholder.innerHTML = `
                
    //             `;
                
    //             // Show alert
    //             const alertElement = alertPlaceholder.querySelector('.alert');
    //             setTimeout(() => {
    //                 alertElement.classList.add('show');
    //             }, 10);

    //             setTimeout(() => {
    //                 alertElement.classList.remove('show');
    //                 setTimeout(() => {
    //                     if (alertElement.parentElement) {
    //                         alertElement.parentElement.removeChild(alertElement);
    //                     }
    //                 }, 500);
    //             }, 5000);
    //         // }
    //     });
    // });
</script>