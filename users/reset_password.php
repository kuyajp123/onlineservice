<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <form action="" method="post">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Reset Password">
    </form>
</body>
</html>

<?php
require_once "../include/bootsrap.php";
require_once '../include/connect.php';  // Ensure correct path
require '../vendor/autoload.php';  // Load Composer's autoloader

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
            $expires_at = $reset['expires_at'];
            
            // Check if the token has expired
            $current_time = date("Y-m-d H:i:s");
            if ($expires_at < $current_time) {
                // Token has expired, delete it
                $sql = "DELETE FROM password_resets WHERE token = ?";
                $stmt = $con->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("s", $token);
                    $stmt->execute();
                    echo 'Token has expired. Please request a new password reset.';
                } else {
                    echo 'Error deleting expired token from database.';
                }
            } else {
                // Token is still valid, proceed with updating the password
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
                        echo 'Password has been reset.';
                    } else {
                        echo 'Error deleting token from database.';
                    }
                } else {
                    echo 'Error updating password.';
                }
            }
        } else {
            echo 'Invalid token.';
        }
    } else {
        echo 'Error checking token in database.';
    }
}

?>
