<?php
session_start();
require_once "./connect.php";
require_once './register.php';


$ums = $email_no_err = $general_err = "";;


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $ums = $_POST['ums'];
    $user_password = $_POST['user_password'];   

    $query = "SELECT * FROM user_registration WHERE email = ?";
    $stmt = mysqli_prepare($con, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $ums);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            // Log the password values before verification
            echo "Entered Password: " . htmlspecialchars($user_password) . "<br>";

            // Verify the password
            if (password_verify($user_password, $user['user_password'])) {
                // Password is correct, set session variables
                $_SESSION['email'] = $user['email'];
                echo "Login successfully. Welcome, " . htmlspecialchars($user['fname']);
            } else {
                // Password is incorrect
                echo "The password is incorrect.";
            }
        } else {
            echo "No user found with that email address.";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the SQL statement.";
    }

    mysqli_close($con); // Close the connection
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php require_once "./include/bootsrap.php"; ?>
</head>
<body>
<?php if ($email_no_err): ?>
                    <div class="alert alert-danger"><?php echo $email_no_err; ?></div>
                <?php endif; ?>
                <?php if ($general_err): ?>
                    <div class="alert alert-danger"><?php echo $general_err; ?></div>
                <?php endif; ?>
<form action="login.php" method="post">
            <div class="form-group">
                <label for="ums">Username</label>
                <input type="text" id="ums" name="ums" value="<?php echo htmlspecialchars($ums); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="user_password">Password</label>
                <input type="password" id="user_password" name="user_password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
        <!-- Button to Open the Register Modal -->
        <button type="button" class="btn btn-primary" onclick="openRegisterModal()" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Open modal for @mdo</button>
    </div>
</body>
</html>