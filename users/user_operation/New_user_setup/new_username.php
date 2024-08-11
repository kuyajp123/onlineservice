<?php
// session_start();
require_once "../../../include/bootsrap.php";
require_once '../../../include/connect.php';

// // $user_id = $_SESSION['user_ID'];
// // $user_no = $_SESSION['user_no'];
// $user_ID = "";
// $error = "";

// // SQL query to get the existing user_ID
// $query = "SELECT user_ID FROM user_registration";
// $execute = $con->query($query);
// $execute->fetch_assoc();

// if ($execute->num_rows > 0) {
//     $error = "This username is already exist";
// }else{
// // SQL query to get the current user_ID based on the session user_ID
// $sql = "SELECT user_ID FROM user_registration WHERE user_ID = ?";
// $stmt = $con->prepare($sql);
// $stmt->bind_param("s", $user_id); // 's' for string
// $stmt->execute();
// $result = $stmt->get_result();

// if ($result->num_rows > 0) {
//     if (isset($_POST['submit_username'])) { // Ensure the form submit button name is 'submit_username'
//         $input_user_ID = $_POST['username'];

//             // Clean and format the new username
//             $clean_input = preg_replace('/\s+/', ' ', $input_user_ID); // Replace multiple spaces with a single space
//             $clean_input = strtolower(trim($clean_input)); // Convert to lowercase and trim

//             // Replace single spaces with underscores and remove special characters except underscores
//             $formatted_user_ID = preg_replace('/[^a-z0-9\s_]/', '', $clean_input);
//             $formatted_user_ID = str_replace(' ', '_', $formatted_user_ID);

//             // Ensure only one "@" is present and at the start
//             $formatted_user_ID = preg_replace('/[^a-z0-9.@_]/', '', $formatted_user_ID);
//             if (substr_count($formatted_user_ID, '@') > 1) {
//                 $parts = explode('@', $formatted_user_ID);
//                 $formatted_user_ID = $parts[0] . '@' . implode('', array_slice($parts, 1));
//             }
//             if ($formatted_user_ID[0] !== '@') {
//                 $formatted_user_ID = '@' . $formatted_user_ID;
//             }

//             // Check if the new formatted user_ID is already taken
//             $sql = "SELECT user_ID FROM user_registration WHERE user_ID = ?";
//             $stmt = $con->prepare($sql);
//             $stmt->bind_param("s", $formatted_user_ID);
//             $stmt->execute();
//             $result = $stmt->get_result();

//             if ($result->num_rows === 0) { // No rows means the user_ID is available
//                 // Update the user_ID in the database
//                 $sql = "UPDATE user_registration SET user_ID = ? WHERE user_ID = ?";
//                 $stmt = $con->prepare($sql);
//                 $stmt->bind_param("ss", $formatted_user_ID, $user_id); // 'ss' for strings

//                 if ($stmt->execute()) {
//                     $_SESSION["user_ID"] = $formatted_user_ID; // Update session variable
//                     echo "<script>window.open('../../../users/profile.php','_self')</script>";
//                 } else {
//                     $error = "Update failed. Please try again.";
//                 }
//             } else {
//                 $error = "This username is already taken.";
//             }
//     }
// } else {
//     $error = "User not found.";
// }
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="../users/new_user_setup.css?v=<?php echo time(); ?>">
    <style>
    .username {
        height: 100%;
        width: 100%;
    }
    .col-md-4 {
        height: 100%;
        width: 100%;
    }
    </style>
</head>
<body>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Username</h1>
        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">Skip</button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        <div class="container-fluid username">
            <div class="col-md-4">
                <label for="validationServerUsername" class="form-label">You can edit your generated username</label>
                <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend3">@</span>
                <input type="text" name="username" class="form-control is-invalid" id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Please choose a username.
                </div>
                </div>
            </div>
        </div>
        <div class="container-fluid username">
            <!-- available username add here -->
            <!-- <label for="validationServer02" class="form-label">Last name</label>
            <input type="text" class="form-control is-valid" id="validationServer02" value="Otto" required>
            <div class="valid-feedback">
            Looks good!
            </div> -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="submit_username" class="btn btn-primary">Next</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- JavaScript to show the modal -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
    myModal.show();
  });
</script>
</body>
</html>

