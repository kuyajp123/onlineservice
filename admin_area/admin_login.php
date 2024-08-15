<?php
session_name('admin_session');
session_start();
require_once "../include/bootsrap.php";
require_once '../include/connect.php'; 
require_once '../functions/common_function.php';


if (isset($_POST['login'])) {
    $email_input = $_POST['admin'];
    $password_input = $_POST['admin_password'];

    $sql = "select * from admin";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    $admin_id = $row['admin_id'];
    $email = $row['username'];
    $password = $row['password_hash'];

    if($email_input == $email && $password_input == $password){
        $_SESSION['admin'] = $email_input;
        $_SESSION['admin_id'] = $admin_id;
        $_SESSION['admin_password'] = $password;
        echo "<script>window.open('list_of_users.php','_self')</script>";
    }else{
        print "email or password didnt match";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../users/login_style.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="bod2">
    <div class="container text-center">
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
                                    <!-- Alert container with fixed height -->
                                    <div id="liveAlertPlaceholder" class="alert-container"></div>
                                    
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <input type="text" id="user" name="admin" placeholder="admin ID" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="user_password" name="admin_password" placeholder="Password" class="form-control" required>
                                            <span class="toggle-password"><i class="fa-solid fa-eye"></i></span>
                                        </div>
                                        <div>
                                            <button style="margin-top:15px;" type="submit" name="login" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                   
                                </div>
                                <div class="line"></div>
                                <div class="container form-container3">
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
    <script src="../functions/JsFunction.js"></script>
</body>
</html>