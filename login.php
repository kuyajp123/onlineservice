<?php
session_start();
require_once "./connect.php";
require_once './register.php';
require_once './functions/common_function.php';
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
    <div>
<form action="login.php" method="post">
            <div class="form-group">
                <label for="ums">Username</label>
                <input type="text" id="ums" name="ums"  class="form-control" required>
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
<?php

// $ums = $email_no_err = $general_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ums = $_POST['ums'];
    $user_password = $_POST['user_password'];
    
    $sql = "select * from user_registration where email = ? or user_ID = ? or student_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sss', $ums, $ums, $ums);
    $stmt->execute();
    $result = $stmt->get_result();

    if($row = $result->fetch_assoc()){
        if($result->num_rows > 0){
            if(password_verify($user_password, $row['user_password'])){
                $_SESSION['user'] = $row['fname'];
                echo "welcome " .$_SESSION['user']. "!";
            }else{
                echo "incorrect password";
            }
        }else{
            echo "theres no account existing in our recored";
        }
    }else{
        echo "error";
    }

}

?>