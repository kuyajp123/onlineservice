<?php
session_start();
require_once '../include/connect.php';
require_once './register.php';
require_once '../functions/common_function.php';



if (isset($_POST['login'])) {
    $ums = $_POST['user'];
    $user_password = $_POST['user_password'];

    
    $sql = "select * from user_registration where email = ? or user_ID = ? or student_no = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sss', $ums, $ums, $ums);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if($result->num_rows > 0){
        if(password_verify($user_password, $row['user_password'])){
            $_SESSION['ip'] = getIPAddress();
            $_SESSION['user'] = $row['fname'];
            echo "<script>window.open('../index.php','_self')</script>";
        }else{
            echo "incorrect password";
        }
    }else{
        echo "no users found";
    }
    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <?php require_once "../include/bootsrap.php"; ?>
</head>
<body>
    <div class="bod2">
        <div class="container  text-center">

            
            <div class="p-3 column1">
                <div class="container container2">
                    <div class="row row-form">
                            <div class="col col-form content1">
                            Column
                            </div>
                            <div class="col col-form">
                                <div class="container-fluid container-form">

                    <div class="container form-container1">
                            <div class="container form-container2">
<form action="login.php" method="post">
    <div class="form-group">
                    <input type="text" id="user" name="user" placeholder="Email/Username/Student number" value="<?php echo isset($_POST['user']) ? htmlspecialchars($_POST['user']) : ''; ?>" class="form-control" required>
    </div>
    <div class="form-group">
                    <input type="password" id="user_password" name="user_password" placeholder="Password" class="form-control" required>
                    <span class="toggle-password"><i class="fa-solid fa-eye"></i></span>
    </div>
    <div>
                <button style="margin-top:15px;" type="submit" name="login" class="btn btn-primary">Login</button>
    </div>
</form> 

        <!-- div here for "forgot password" here remove margin top from the button if lalagyan na ng forgot password-->
         
                            </div>
                            <div class="line"></div>
                        <div class="container form-container3">
        <!-- Button to Open the Register Modal -->
        <button type="button" id="btn-signup" class="btn btn-primary" onclick="openRegisterModal()" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Sign up</button>
                        </div>
                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="p-3 column2">Custom column padding</div>
            
        
        </div>
    </div>
    <!-- show password -->
    <?php show_hide_password_script(); ?>
</body>
</html>

