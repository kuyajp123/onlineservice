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
    <div>
<form action="login.php" method="post">
            <div class="form-group">
                <label for="user">Username</label>
                <input type="text" id="user" name="user" value="<?php echo isset($_POST['user']) ? htmlspecialchars($_POST['user']) : ''; ?>" class="form-control" required>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ums = $_POST['user'];
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
                echo "welcome " .$_SESSION['user'];
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
