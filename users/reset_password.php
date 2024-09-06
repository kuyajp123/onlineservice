<?php
require_once "../include/bootsrap.php";
require_once '../include/connect.php';  // Ensure correct path
require '../vendor/autoload.php';  // Load Composer's autoloader

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the token is valid
    $sql = "SELECT user_no, expires_at FROM password_resets WHERE token = ?";
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $reset = $result->fetch_assoc();
        
        if ($reset) {
            $user_no = $reset['user_no'];
            
            // Check if the user exists
            $query = "SELECT user_password FROM user_registration WHERE user_no = ?";
            $stmt = $con->prepare($query); // Fix for using the correct query
            if ($stmt) {
                $stmt->bind_param("i", $user_no);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();

                if ($user) {
                    // Compare the new password with the old one
                    if (password_verify($_POST['password'], $user['user_password'])) {
                        $error = "Your password cannot be the same as your old password.";
                    } else {
                        // Token is valid and password is different, proceed with password reset
                        $expires_at = $reset['expires_at'];
                        $current_time = date("Y-m-d H:i:s");

                        // Check if the token has expired
                        if ($expires_at < $current_time) {
                            // Token has expired, delete it
                            $sql = "DELETE FROM password_resets WHERE token = ?";
                            $stmt = $con->prepare($sql);
                            if ($stmt) {
                                $stmt->bind_param("s", $token);
                                $stmt->execute();
                                $error = 'Token has expired. Please request a new password reset.';
                            } else {
                                $error = 'Error deleting expired token from database.';
                            }
                        } else {
                            // Update the user's password
                            $query = "UPDATE user_registration SET user_password = ? WHERE user_no = ?";
                            $stmt = $con->prepare($query);
                            if ($stmt) {
                                $stmt->bind_param("si", $newPassword, $user_no);
                                $stmt->execute();

                                // Delete the token from password_resets
                                $sql = "DELETE FROM password_resets WHERE token = ?";
                                $stmt = $con->prepare($sql);
                                if ($stmt) {
                                    $stmt->bind_param("s", $token);
                                    $stmt->execute();
                                    $success = 'Password has been reset.';
                                } else {
                                    $error = 'Error deleting token from database.';
                                }
                            } else {
                                $error = 'Error updating password.';
                            }
                        }
                    }
                } else {
                    $error = 'User not found.';
                }
            } else {
                $error = 'Error fetching user data.';
            }
        } else {
            $error = 'Invalid token. Please request a new password reset.';
        }
    } else {
        $error = 'Error checking token in database.';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<link rel="stylesheet" href="pass_reset.css?v=<?php echo time(); ?>">
<body>
    <div class="container-fluid bod2">
        <div class="container-fluid forms">
            <form action="" method="post">
                <div class="container-fluid lagyan">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                <div class="container-fluid inputpass" style="align-items:flex-end">
                <label for="password">New Password:</label>
                </div>
                    
                    <div class="container-fluid inputpass">
                    <input class="form-control" id="user_password" type="password" name="password" id="password" required>
                    <span class="toggle-password"><i class="fa-solid fa-eye"></i></span>
                    </div>
                    <?php if ($error == NULL && $success == NULL): ?>
                        <div class="container-fluid output">
 
                        </div>
                    <?php elseif ($error != NULL && $success == NULL): ?>
                        <div class="container-fluid text-danger output">
                            <p><?php echo htmlspecialchars($error); ?></p>
                        </div>
                    <?php elseif ($error == NULL && $success != NULL): ?>
                        <div class="container-fluid text-success output">
                            <p><?php echo htmlspecialchars($success ."\n". "You can now close this tab."); ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="container-fluid inputpass" style="align-items:flex-start">
                    <button type="submit" class="btn btn-success" value="Reset Password">Reset password</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- show password -->
    <script src="../functions/JsFunction.js"></script>
</body>
</html>
